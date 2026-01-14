<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dari query
        $today = $request->month
            ? Carbon::createFromFormat('Y-m', $request->month)->startOfMonth()
            : now()->startOfMonth();

        // Ambil semua transaksi di bulan tsb
        $eventsMonth = Transaksi::whereYear('waktu_mulai', $today->year)
            ->whereMonth('waktu_mulai', $today->month)
            ->get();

        // Ambil kegiatan hari ini
        $eventsToday = Transaksi::whereDate('waktu_mulai', now()->toDateString())
            ->get();

        return view('petugas.dashboard', compact(
            'today',
            'eventsMonth',
            'eventsToday'
        ));
    }
}
