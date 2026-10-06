<?php

namespace App\Services;

use App\Mail\SiteIssueReportMail;
use App\Models\Employee;
use App\Models\NetIssue;
use App\Models\NetSite;
use App\Models\SiteIssue;
use App\Models\Status;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SiteIssueService
{
    public function paginate(): LengthAwarePaginator
    {
        return SiteIssue::with([
            'netSite.branch',
            'netIssue',
            'employee',
            'currentStatusLog.status',
        ])
            ->latest()
            ->paginate(10);
    }

    /**
     * Net sites eligible to be reported on: must have a primary vendor
     * with an email (so the notification has somewhere to go) AND must
     * currently be Active.
     *
     * $include: when editing an existing report, the net site already
     * assigned to it is always kept in the list even if it no longer
     * matches those rules — so the edit form never "loses" the current
     * value out from under the user.
     */
    public function netSitesForForm(?NetSite $include = null)
    {
        $netSites = NetSite::with(['branch', 'primaryVendor'])
            ->whereHas('primaryVendor', function ($query) {
                $query->whereNotNull('email')->where('email', '!=', '');
            })
            ->whereHas('currentStatusLog.status', function ($query) {
                $query->where('code', 'active');
            })
            ->orderBy('name')
            ->get();

        if ($include && !$netSites->contains('id', $include->id)) {
            $netSites->push($include->loadMissing(['branch', 'primaryVendor']));
        }

        return $netSites;
    }

    public function netIssuesForForm()
    {
        return NetIssue::orderBy('name')->get();
    }

    public function employeesForForm()
    {
        return Employee::orderBy('name')->get();
    }

    public function statusesForForm()
    {
        return Status::orderBy('name')->get();
    }

    /**
     * Setiap laporan baru otomatis diberi status "Pending" — pengguna
     * cukup lapor tanpa perlu memilih status secara manual. Status
     * hanya bisa diubah lewat halaman Edit.
     */
    public function create(array $data): SiteIssue
    {
        $siteIssue = SiteIssue::create(
            collect($data)->except(['status_id', 'status_remark'])->toArray()
        );

        $pendingStatusId = Status::where('code', 'pending')->value('id');

        if ($pendingStatusId) {
            $siteIssue->applyStatus($pendingStatusId, $data['status_remark'] ?? null);
        }

        return $siteIssue;
    }

    public function update(SiteIssue $siteIssue, array $data): SiteIssue
    {
        $siteIssue->update(
            collect($data)->except(['status_id', 'status_remark'])->toArray()
        );

        if (!empty($data['status_id'])) {
            $siteIssue->applyStatus($data['status_id'], $data['status_remark'] ?? null);
        }

        return $siteIssue;
    }

    public function delete(SiteIssue $siteIssue): void
    {
        $siteIssue->delete();
    }

    public function notifyVendor(SiteIssue $siteIssue): bool
    {
        $siteIssue->loadMissing(['netSite.primaryVendor', 'netSite.branch', 'netIssue', 'employee']);

        $recipient = config('issue.test_recipient')
            ?: ($siteIssue->netSite->primaryVendor->email ?? null)
            ?: config('issue.fallback_recipient');

        try {
            Mail::to($recipient)->send(new SiteIssueReportMail($siteIssue));

            return true;
        } catch (Throwable $e) {
            Log::error('Gagal mengirim email laporan issue: ' . $e->getMessage());

            return false;
        }
    }
}