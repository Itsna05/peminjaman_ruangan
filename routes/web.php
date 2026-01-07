<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;

// =====================
// LOGIN
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// DASHBOARD (HARUS LOGIN)
// =====================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('cekLogin')
    ->name('dashboard');

// =====================
// SUPER ADMIN CRUD
// =====================
Route::get('/superadmin', [SuperAdminController::class, 'index'])
    ->middleware('cekLogin')
    ->name('Super Admin');

Route::get('/superadmin/create', [SuperAdminController::class, 'create'])
    ->middleware('cekLogin');

Route::post('/superadmin/store', [SuperAdminController::class, 'store'])
    ->middleware('cekLogin');

Route::get('/superadmin/edit/{id}', [SuperAdminController::class, 'edit'])
    ->middleware('cekLogin');

Route::post('/superadmin/update/{id}', [SuperAdminController::class, 'update'])
    ->middleware('cekLogin');

Route::get('/superadmin/delete/{id}', [SuperAdminController::class, 'destroy'])
    ->middleware('cekLogin');
