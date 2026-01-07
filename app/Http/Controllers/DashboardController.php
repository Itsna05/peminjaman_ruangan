<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Models\Ruangan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'total_super_admin' => SuperAdmin::count(),
        ]);
    }
}
