<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function store(array $data): Role
    {
        return Role::create($data);
    }

    public function update(Role $role, array $data): Role
    {
        $role->update($data);

        return $role;
    }

    public function delete(Role $role): bool
    {
        return $role->delete();
    }
}