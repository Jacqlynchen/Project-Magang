<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DatatableController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::resource('users', UserController::class)
    ->except(['create', 'edit'])
    ->middleware(['auth', 'check.date']);

Route::get('/roles-data', [UserController::class, 'getRoles'])
    ->middleware(['auth', 'check.date']);

Route::resource('roles', RoleController::class)
    ->except(['create', 'edit'])
    ->middleware(['auth', 'check.date']);

Route::get('datatables/{table}', DatatableController::class)
    ->name('datatables');