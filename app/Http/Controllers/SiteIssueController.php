<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteIssueRequest;
use App\Http\Requests\UpdateSiteIssueRequest;
use App\Models\SiteIssue;
use App\Services\SiteIssueService;

class SiteIssueController extends Controller
{
    public function __construct(protected SiteIssueService $siteIssues)
    {
    }

    public function index()
    {
        $siteIssues = $this->siteIssues->paginate();

        return view('site_issues.index', compact('siteIssues'));
    }

    public function create()
    {
        $netSites = $this->siteIssues->netSitesForForm();
        $netIssues = $this->siteIssues->netIssuesForForm();
        $employees = $this->siteIssues->employeesForForm();

        return view('site_issues.create', compact(
            'netSites',
            'netIssues',
            'employees'
        ));
    }

    public function store(StoreSiteIssueRequest $request)
    {
        $siteIssue = $this->siteIssues->create($request->validated());

        $emailSent = $this->siteIssues->notifyVendor($siteIssue);

        $message = $emailSent
            ? 'Laporan issue berhasil dibuat (status: Pending) dan email notifikasi sudah dikirim.'
            : 'Laporan issue berhasil dibuat, tetapi email notifikasi gagal dikirim. Periksa pengaturan email di file .env.';

        return redirect()
            ->route('site-issues.index')
            ->with('success', $message);
    }

    public function edit(SiteIssue $siteIssue)
    {
        $siteIssue->loadMissing(['currentStatusLog', 'netSite']);

        $netSites = $this->siteIssues->netSitesForForm($siteIssue->netSite);
        $netIssues = $this->siteIssues->netIssuesForForm();
        $employees = $this->siteIssues->employeesForForm();
        $statuses = $this->siteIssues->statusesForForm();

        return view('site_issues.edit', compact(
            'siteIssue',
            'netSites',
            'netIssues',
            'employees',
            'statuses'
        ));
    }

    public function update(UpdateSiteIssueRequest $request, SiteIssue $siteIssue)
    {
        $this->siteIssues->update($siteIssue, $request->validated());

        return redirect()
            ->route('site-issues.index')
            ->with('success', 'Laporan issue berhasil diperbarui.');
    }

    public function destroy(SiteIssue $siteIssue)
    {
        $this->siteIssues->delete($siteIssue);

        return redirect()
            ->route('site-issues.index')
            ->with('success', 'Laporan issue berhasil dihapus.');
    }
}