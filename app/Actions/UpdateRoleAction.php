<?php

namespace App\Actions;

use App\Models\Role;

class UpdateRoleAction
{
    public function execute(Role $role, array $data): Role
    {
        $role->update([
            'name' => $data['name'],
        ]);

        return $role;
    }
}