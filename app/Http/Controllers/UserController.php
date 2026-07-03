<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Menampilkan semua data user.
     */
    public function index()
    {
        $users = $this->userService->getAll();

        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    /**
     * Menyimpan data user baru.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $this->userService->store($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Mengupdate data user.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->userService->update($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus data user.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        
        $this->userService->delete($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
}