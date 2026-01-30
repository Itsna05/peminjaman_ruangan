<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Ruangan;
use App\Models\BidangPegawai;

class ManajemenPeminjamanController extends Controller
{

public function index()
{
    $transaksi = DB::table('transaksi')
        ->join('ruangan', 'transaksi.id_ruangan', '=', 'ruangan.id_ruangan')
        ->leftJoin('bidang_pegawai', 'transaksi.id_bidang', '=', 'bidang_pegawai.id_bidang')
        ->select(
            'transaksi.id_peminjaman',
            'transaksi.acara',
            'transaksi.waktu_mulai',
            'transaksi.waktu_selesai',
            'transaksi.no_wa',
            'transaksi.status_peminjaman',
            'ruangan.nama_ruangan',
            'bidang_pegawai.bidang',
            'bidang_pegawai.sub_bidang'
        )
        ->orderByDesc('transaksi.id_peminjaman')
        ->get();

    $bidang = DB::table('bidang_pegawai')
        ->select('bidang')
        ->distinct()
        ->orderBy('bidang')
        ->get();

    $ruangan = DB::table('ruangan')
        ->orderBy('nama_ruangan')
        ->get();

    return view('superadmin.manajemen-peminjaman', compact(
        'transaksi',
        'bidang',
        'ruangan'
    ));
}

public function detail($id)
{
    $t = Transaksi::with(['ruangan', 'bidang'])
        ->findOrFail($id);

    return response()->json([
        'acara'          => $t->acara,
        'jumlah_peserta' => $t->jumlah_peserta,
        'tanggal'        => $t->waktu_mulai->translatedFormat('l, d F Y'),
        'waktu_mulai'    => $t->waktu_mulai->format('H:i'),
        'waktu_selesai'  => $t->waktu_selesai->format('H:i'),
        'bidang'         => $t->bidang->bidang ?? '-',
        'sub_bidang'     => $t->bidang->sub_bidang ?? '-',
        'ruangan'        => $t->ruangan->nama_ruangan ?? '-',
        'no_wa'          => $t->no_wa ?? '-',
        'catatan'        => $t->catatan ?: '-',
    ]);
}


}


