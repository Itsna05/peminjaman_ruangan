<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // DETAIL PEMINJAMAN (POPUP)
    Route::get('/transaksi/{id}', [DashboardController::class, 'show'])
        ->name('transaksi.show');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('superadmin')->name('superadmin.')->group(function () {

    Route::get('/', [SuperAdminController::class, 'index'])
        ->name('index');

    Route::get('/create', [SuperAdminController::class, 'create'])
        ->name('create');

    Route::post('/store', [SuperAdminController::class, 'store'])
        ->name('store');

    Route::get('/edit/{id}', [SuperAdminController::class, 'edit'])
        ->name('edit');

    Route::post('/update/{id}', [SuperAdminController::class, 'update'])
        ->name('update');

    Route::get('/delete/{id}', [SuperAdminController::class, 'destroy'])
        ->name('delete');
});
