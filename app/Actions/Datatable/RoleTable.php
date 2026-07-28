<?php

namespace App\Actions\Datatable;

use App\Models\Role;

class RoleTable
{
    public function handle(array $filters = [])
    {
        return datatables(
            Role::query()
        )
        ->addIndexColumn()
        ->addColumn('action', function ($role) {
            return view('datatables.roles.action', compact('role'))->render();
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}