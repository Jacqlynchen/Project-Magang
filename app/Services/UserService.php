<?php

namespace App\Services;

use App\Actions\CreateUserAction;
use App\Actions\UpdateUserAction;
use App\Actions\DeleteUserAction;
use App\Models\User;

class UserService
{
    public function __construct(
        protected CreateUserAction $createUserAction,
        protected UpdateUserAction $updateUserAction,
        protected DeleteUserAction $deleteUserAction
    ) {}

    /**
     * Menampilkan semua user.
     */
    public function getAll()
    {
        return User::latest()->get();
    }

    /**
     * Menyimpan user baru.
     */
    public function store(array $data): User
    {
        return $this->createUserAction->execute($data);
    }

    /**
     * Mengubah data user.
     */
    public function update(User $user, array $data): User
    {
        return $this->updateUserAction->execute($user, $data);
    }

    /**
     * Menghapus user.
     */
    public function delete(User $user): void
    {
        $this->deleteUserAction->execute($user);
    }
}