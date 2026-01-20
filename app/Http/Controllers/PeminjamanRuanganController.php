<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi')
            ->join('ruangan', 'transaksi.id_ruangan', '=', 'ruangan.id_ruangan')
            ->join('bidang_pegawai', 'transaksi.id_bidang', '=', 'bidang_pegawai.id_bidang')
            ->select(
                'transaksi.id_peminjaman',
                'ruangan.nama_ruangan',
                'transaksi.acara',
                'bidang_pegawai.bidang',
                'bidang_pegawai.sub_bidang',
                'transaksi.status_peminjaman',
                'transaksi.waktu_mulai',
                'transaksi.waktu_selesai',
                'transaksi.no_wa'
            )
            ->orderBy('transaksi.id_peminjaman', 'desc')
            ->get();

        // ⬅️ INI PENTING
        return view('petugas.form-peminjaman', compact('transaksi'));
    }
}
