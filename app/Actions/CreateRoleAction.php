<?php

namespace App\Actions;

use App\Models\Role;

class CreateRoleAction
{
    public function execute(array $data): Role
    {
        return Role::create([
            'name' => $data['name'],
        ]);
    }
}