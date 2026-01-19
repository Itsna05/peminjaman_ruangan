<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\DenahRuanganController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

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
Route::middleware(['CekLogin:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/denah-ruangan', [DenahRuanganController::class, 'index'])
            ->name('denah');

        // PEMINJAMAN RUANGAN
        Route::get('/peminjaman-ruangan', function () {
            return view('petugas.form-peminjaman');
        })->name('peminjaman');
    });


/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['CekLogin:superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [SuperAdminController::class, 'index'])
            ->name('dashboard');

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

/*
|--------------------------------------------------------------------------
| KONTAK (SHARED)
|--------------------------------------------------------------------------
*/
Route::get('/kontak', function () {
    return view('shared.kontak');
})->name('shared.kontak');


