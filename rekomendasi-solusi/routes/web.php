<?php

use App\Http\Controllers\RekomendasiController;

Route::get('/', [RekomendasiController::class, 'index']);
Route::post('/cari', [RekomendasiController::class, 'cari']);
Route::get('/kasus/create', [RekomendasiController::class, 'create']);
Route::post('/kasus', [RekomendasiController::class, 'store']);
