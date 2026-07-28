<?php

namespace App\Http\Controllers;

use App\Traits\HasTransaction;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    use HasTransaction;

    public function index()
    {
        return view('roles.index');
    }

    public function show(Role $role)
    {
        return response()->json([
            'success' => true,
            'data' => $role
        ]);
    }

    public function store(
        StoreRoleRequest $request,
        RoleService $service
    ) {
        $this->authorize('create', Role::class);

        return $this->handle(
            fn() => $service->store($request->validated()),
            action: 'store'
        );
    }

    public function update(
        UpdateRoleRequest $request,
        Role $role,
        RoleService $service
    ) {
        $this->authorize('update', $role);

        return $this->handle(
            fn() => $service->update($role, $request->validated()),
            action: 'update'
        );
    }

    public function destroy(
        Role $role,
        RoleService $service
    ) {
        $this->authorize('delete', $role);

        return $this->handle(
            fn() => $service->delete($role),
            action: 'destroy'
        );
    }
}