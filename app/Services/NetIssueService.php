<?php

namespace App\Services;

use App\Models\NetIssue;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NetIssueService
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return NetIssue::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function create(array $data): NetIssue
    {
        return NetIssue::create($data);
    }

    public function update(NetIssue $netIssue, array $data): NetIssue
    {
        $netIssue->update($data);

        return $netIssue;
    }

    public function delete(NetIssue $netIssue): void
    {
        $netIssue->delete();
    }
}