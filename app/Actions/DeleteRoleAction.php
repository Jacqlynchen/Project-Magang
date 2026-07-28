<?php

namespace App\Actions;

use App\Models\Role;

class DeleteRoleAction
{
    public function execute(Role $role): void
    {
        $role->delete();
    }
}