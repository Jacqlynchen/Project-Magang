<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BranchService
{
    protected array $addressKeys = ['addr_1', 'addr_2', 'addr_3', 'lat', 'long'];

    /**
     * Get a paginated, filtered list of branches.
     */
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Branch::query()
            ->with(['address', 'currentStatusLog.status'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('area', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('area'), function ($query) use ($request) {
                $query->where('area', $request->area);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Distinct list of areas, for the filter dropdown.
     */
    public function areas()
    {
        return Branch::whereNotNull('area')
            ->where('area', '!=', '')
            ->distinct()
            ->orderBy('area')
            ->pluck('area');
    }

    /**
     * Create a branch (plus its address and initial status, if given).
     */
    public function create(array $data): Branch
    {
        $addressData = collect($data)->only($this->addressKeys)->toArray();

        $branchData = collect($data)
            ->except(array_merge($this->addressKeys, ['status_id', 'status_remark']))
            ->toArray();

        // The primary key is a string and not typed by the user —
        // generate it here so it's always unique.
        $branchData['id'] = (string) Str::uuid();

        $branch = Branch::create($branchData);

        if (array_filter($addressData)) {
            $branch->address()->create($addressData);
        }

        if (!empty($data['status_id'])) {
            $branch->applyStatus($data['status_id'], $data['status_remark'] ?? null);
        }

        return $branch;
    }

    /**
     * Update a branch (plus its address and status, if given).
     */
    public function update(Branch $branch, array $data): Branch
    {
        $addressData = collect($data)->only($this->addressKeys)->toArray();

        $branch->update(
            collect($data)
                ->except(array_merge($this->addressKeys, ['status_id', 'status_remark']))
                ->toArray()
        );

        if (array_filter($addressData)) {
            $branch->address()->updateOrCreate([], $addressData);
        }

        if (!empty($data['status_id'])) {
            $branch->applyStatus($data['status_id'], $data['status_remark'] ?? null);
        }

        return $branch;
    }

    /**
     * Delete a branch along with its address.
     */
    public function delete(Branch $branch): void
    {
        optional($branch->address)->delete();

        $branch->delete();
    }
}