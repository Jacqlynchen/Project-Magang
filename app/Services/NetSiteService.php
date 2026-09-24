<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\NetSite;
use App\Models\Status;
use App\Models\Vendor;
use Illuminate\Pagination\LengthAwarePaginator;

class NetSiteService
{
    /**
     * Get a paginated list of net sites.
     */
    public function paginate(): LengthAwarePaginator
    {
        return NetSite::with([
            'branch',
            'primaryVendor',
            'secondaryVendor',
            'currentStatusLog.status',
        ])
            ->latest()
            ->paginate(5);
    }

    /**
     * Branches for the Branch dropdown — with address eager loaded
     * so the create/edit form can auto-fill the address fields.
     */
    public function branchesForForm()
    {
        return Branch::with('address')->orderBy('name')->get();
    }

    public function vendorsForForm()
    {
        return Vendor::orderBy('id')->get();
    }

    public function statusesForForm()
    {
        return Status::orderBy('name')->get();
    }

    /**
     * Create a net site (plus its initial status, if given).
     */
    public function create(array $data): NetSite
    {
        $netSite = NetSite::create(
            collect($data)->except(['status_id', 'status_remark'])->toArray()
        );

        if (!empty($data['status_id'])) {
            $netSite->applyStatus($data['status_id'], $data['status_remark'] ?? null);
        }

        return $netSite;
    }

    /**
     * Update a net site (plus its status, if given).
     */
    public function update(NetSite $netSite, array $data): NetSite
    {
        $netSite->update(
            collect($data)->except(['status_id', 'status_remark'])->toArray()
        );

        if (!empty($data['status_id'])) {
            $netSite->applyStatus($data['status_id'], $data['status_remark'] ?? null);
        }

        return $netSite;
    }

    public function delete(NetSite $netSite): void
    {
        $netSite->delete();
    }
}