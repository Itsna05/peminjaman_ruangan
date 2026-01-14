<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_peminjaman';
    public $timestamps = false;

    protected $fillable = [
        'waktu_mulai',
        'waktu_selesai',
        'acara',
        'catatan',
        'status_peminjaman',
        'jumlah_peserta',
        'id_bidang',
        'id_ruangan',
        'id_user',
        'no_wa'
    ];

    protected $casts = [
        'waktu_mulai'   => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
}
