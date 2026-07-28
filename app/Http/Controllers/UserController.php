<?php

namespace App\Http\Controllers;

use App\Traits\HasTransaction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    use HasTransaction;

    public function index()
    {
        return view('users.index');
    }

    public function store(
        StoreUserRequest $request,
        UserService $service
    ) {
        $this->authorize('create', User::class);

        return $this->handle(
            fn() => $service->store($request->validated()),
            action: 'store'
        );
    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => $user->load('role')
        ]);
    }

    public function update(
        UpdateUserRequest $request,
        User $user,
        UserService $service
    ) {
        $this->authorize('update', $user);

        return $this->handle(
            fn() => $service->update($user, $request->validated()),
            action: 'update'
        );
    }

    public function destroy(
        User $user,
        UserService $service
    ) {
        $this->authorize('delete', $user);

        return $this->handle(
            fn() => $service->delete($user),
            action: 'destroy'
        );
    }
}