<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        // =================================================
        // SUMMARY CARD (TIDAK DIUBAH)
        // =================================================

        $totalPeminjaman = Transaksi::count();

        $menunggu = Transaksi::where('status_peminjaman', 'menunggu')->count();

        $totalRuangan = \App\Models\Ruangan::count();

        $ruanganTerpakaiHariIni = Transaksi::whereDate('waktu_mulai', now())
            ->where('status_peminjaman', 'disetujui')
            ->distinct('id_ruangan')
            ->count('id_ruangan');

        $ruanganTersedia = $totalRuangan - $ruanganTerpakaiHariIni;

        // =================================================
        // STATISTIK BULANAN (TIDAK DIUBAH)
        // =================================================

        $statistikBulanan = Transaksi::select(
                DB::raw('MONTH(waktu_mulai) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('waktu_mulai', date('Y'))
            ->groupBy(DB::raw('MONTH(waktu_mulai)'))
            ->orderBy(DB::raw('MONTH(waktu_mulai)'))
            ->get();

        // =================================================
        // DATA TABEL (DITAMBAHKAN FILTER)
        // =================================================

        $query = Transaksi::with(['ruangan', 'bidang']);

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        // FILTER BULAN
        if ($request->filled('bulan')) {
            $query->whereMonth('waktu_mulai', $request->bulan);
        }

        // FILTER TAHUN
        if ($request->filled('tahun')) {
            $query->whereYear('waktu_mulai', $request->tahun);
        }

        $transaksi = $query
            ->orderBy('id_peminjaman', 'desc')
            ->get();

        return view('superadmin.dashboard', compact(
            'totalPeminjaman',
            'menunggu',
            'ruanganTersedia',
            'totalRuangan',
            'transaksi',
            'statistikBulanan'
        ));
    }

    // =================================================
    // MANAJEMEN USER (TIDAK DIUBAH)
    // =================================================

    public function manajemenuser()
    {
        $users = User::all();
        $bidangPegawai = DB::table('bidang_pegawai')->get();
        return view('superadmin.manajemen-user', compact('users', 'bidangPegawai'));
    }


    public function create()
    {
        return view('superadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/superadmin/manajemen-user')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = User::where('role', 'superadmin')->findOrFail($id);
        return view('superadmin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username,' . $id . ',id_user',
        ]);

        $admin = User::where('role', 'superadmin')->findOrFail($id);

        $data = [
            'nama'     => $request->nama,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect('/superadmin')
            ->with('success', 'Super Admin berhasil diubah');
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'superadmin')->findOrFail($id);
        $admin->delete();

        return redirect('/superadmin')
            ->with('success', 'Super Admin berhasil dihapus');
    }

    public function manajemenPeminjaman()
    {
        $transaksi = Transaksi::with(['ruangan','bidang'])
            ->orderBy('id_peminjaman','desc')
            ->get();

        return view('superadmin.manajemen-peminjaman', compact('transaksi'));
    }

    public function manajemenPeminjaman()
    {
        $transaksi = Transaksi::with(['ruangan','bidang'])
            ->orderBy('id_peminjaman','desc')
            ->get();

        return view('superadmin.manajemen-peminjaman', compact('transaksi'));
    }
}
