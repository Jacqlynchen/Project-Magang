<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(User $authUser): bool
    {
        return optional($authUser->role)->name === 'admin';
    }

    public function update(User $authUser, User $user): bool
    {
        return optional($authUser->role)->name === 'admin';
    }

    public function delete(User $authUser, User $user): bool
    {
        return optional($authUser->role)->name === 'admin';
    }
}