<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\DenahRuanganController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PETUGAS (TANPA MIDDLEWARE DULU)
|--------------------------------------------------------------------------
*/
Route::get('/petugas/dashboard', [DashboardController::class, 'index'])
    ->name('petugas.dashboard');

Route::get('/petugas/denah-ruangan', [DenahRuanganController::class, 'index'])
    ->name('petugas.denah');
/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/superadmin', [SuperAdminController::class, 'index'])
    ->name('superadmin.index');

Route::get('/superadmin/create', [SuperAdminController::class, 'create'])
    ->name('superadmin.create');

Route::post('/superadmin/store', [SuperAdminController::class, 'store'])
    ->name('superadmin.store');

Route::get('/superadmin/edit/{id}', [SuperAdminController::class, 'edit'])
    ->name('superadmin.edit');

Route::post('/superadmin/update/{id}', [SuperAdminController::class, 'update'])
    ->name('superadmin.update');

Route::get('/superadmin/delete/{id}', [SuperAdminController::class, 'destroy'])
    ->name('superadmin.delete');
