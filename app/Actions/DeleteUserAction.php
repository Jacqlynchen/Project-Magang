<?php

namespace App\Actions;

use App\Models\User;

class DeleteUserAction
{
    /**
     * Menghapus data user.
     */
    public function execute(User $user): void
    {
        $user->delete();
    }
}