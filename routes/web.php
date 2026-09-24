<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\NetSiteController;
use App\Http\Controllers\VendorController;
use App\Models\Branch;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::middleware('auth')->group(function () {

    // =========================
    // DASHBOARD
    // =========================

    Route::get('/dashboard', function () {

        $totalBranches = Branch::count();

        return view('dashboard', [
            'totalBranches' => $totalBranches,
            'totalNetSites' => 0,
            'totalVendors' => 0,
        ]);

    })->name('dashboard');


    // =========================
    // PROFILE
    // =========================

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');


    // =========================
    // LOGOUT
    // =========================

    Route::post('/logout', function () {

        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');

    })->name('logout');


    // =========================
    // BRANCHES
    // =========================

    Route::get('/branches', [BranchController::class, 'index'])
        ->name('branches.index');

    Route::get('/branches/create', [BranchController::class, 'create'])
        ->name('branches.create');

    Route::post('/branches', [BranchController::class, 'store'])
        ->name('branches.store');

    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])
        ->name('branches.edit');

    Route::put('/branches/{branch}', [BranchController::class, 'update'])
        ->name('branches.update');

    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])
        ->name('branches.destroy');


    // =========================
    // NET SITES
    // =========================

    Route::get('/net-sites', [NetSiteController::class, 'index'])
        ->name('net-sites.index');

    Route::get('/net-sites/create', [NetSiteController::class, 'create'])
        ->name('net-sites.create');

    Route::post('/net-sites', [NetSiteController::class, 'store'])
        ->name('net-sites.store');

    Route::get('/net-sites/{netSite}/edit', [NetSiteController::class, 'edit'])
        ->name('net-sites.edit');

    Route::put('/net-sites/{netSite}', [NetSiteController::class, 'update'])
        ->name('net-sites.update');

    Route::delete('/net-sites/{netSite}', [NetSiteController::class, 'destroy'])
        ->name('net-sites.destroy');

    // =========================================================
    // VENDORS
    // =========================================================

    Route::get('/vendors', [VendorController::class, 'index'])
        ->name('vendors.index');

    Route::get('/vendors/create', [VendorController::class, 'create'])
        ->name('vendors.create');

    Route::post('/vendors', [VendorController::class, 'store'])
        ->name('vendors.store');

    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])
        ->name('vendors.edit');

    Route::put('/vendors/{vendor}', [VendorController::class, 'update'])
        ->name('vendors.update');

    Route::delete('/vendors/{vendor}', [VendorController::class, 'destroy'])
        ->name('vendors.destroy');

});