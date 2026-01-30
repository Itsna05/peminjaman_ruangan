<?php

use App\Http\Controllers\ExportPeminjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\DenahRuanganController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\PeminjamanRuanganController;
use App\Http\Controllers\ManajemenRuanganController;
use Illuminate\Support\Facades\DB;

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

        Route::get(
            '/peminjaman-ruangan',
            [PeminjamanRuanganController::class, 'index']
        )->name('peminjaman');

        Route::get('/get-sub-bidang', function () {
            $bidang = request('bidang');

            $data = DB::table('bidang_pegawai')
                ->where('bidang', $bidang)
                ->get();

            $html = "<option value=''>Please Select</option>";
            foreach ($data as $d) {
                $html .= "<option value='{$d->id_bidang}'>{$d->sub_bidang}</option>";
            }

            return $html;
        });
    });

/*
|--------------------------------------------------------------------------
| SUPER ADMIN (DASHBOARD + EXPORT)
|--------------------------------------------------------------------------
*/
Route::middleware(['CekLogin:superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [SuperAdminController::class, 'index'])
            ->name('dashboard');

        // =============================
        // EXPORT PEMINJAMAN
        // =============================
        Route::get(
            '/peminjaman/export/pdf',
            [ExportPeminjamanController::class, 'exportPdf']
        )->name('peminjaman.export.pdf');

        Route::get(
            '/peminjaman/export/excel',
            [ExportPeminjamanController::class, 'exportExcel']
        )->name('peminjaman.export.excel');

        // =============================
        // MANAJEMEN USER
        // =============================
        Route::get('/manajemen-user', [SuperAdminController::class, 'manajemenuser'])
            ->name('manajemenuser');

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
| LANDING PAGE MONITOR
|--------------------------------------------------------------------------
*/
Route::get('/monitor', function () {
    return view('monitor.landingpage');
})->name('monitor.landingpage');

/*
|--------------------------------------------------------------------------
| KONTAK (SHARED)
|--------------------------------------------------------------------------
*/
Route::middleware(['CekLogin:petugas,superadmin'])
    ->get('/kontak', function () {
        return view('shared.kontak');
    })
    ->name('shared.kontak');

/*
|--------------------------------------------------------------------------
| MANAJEMEN PEMINJAMAN (SUPERADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['CekLogin:superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/manajemen-peminjaman', function () {
            return view('superadmin.manajemen-peminjaman');
        })->name('manajemen-peminjaman');

        Route::get('/manajemen-ruangan', function () {
            return view('superadmin.manajemen-ruangan');
        })->name('manajemen-ruangan');
    });
