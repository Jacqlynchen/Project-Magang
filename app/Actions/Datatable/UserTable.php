<?php

namespace App\Actions\Datatable;

use App\Models\User;

class UserTable
{
    public function handle(array $filters = [])
    {
        return datatables(
            User::query()->with('role')
        )
        ->addIndexColumn()

        ->addColumn('role_name', function ($user) {
            return $user->role?->name;
        })

        ->addColumn('action', function ($user) {
            return view('datatables.users.action', compact('user'))->render();
        })

        ->rawColumns(['action'])

        ->toJson();
    }
}