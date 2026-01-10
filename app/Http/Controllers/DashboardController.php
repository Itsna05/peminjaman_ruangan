<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Transaksi;
use App\Models\SuperAdmin;
use App\Models\Petugas;

class DashboardController extends Controller
{
        public function index()
    {
        $role = session('role');

        if ($role === 'superadmin') {
            return view('dashboard.superadmin');
        }

        if ($role === 'petugas') {
            return view('dashboard.petugas');
        }

        abort(403);
    }

}
