<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman'; // SESUAI NAMA TABEL

    protected $primaryKey = 'id_peminjaman'; // SESUAI PUNYAMU

    protected $fillable = [
        'nama_ruangan',
        'acara',
        'bidang',
        'sub_bidang',
        'waktu_mulai',
        'waktu_selesai',
        'no_wa',
        'status_peminjaman'
    ];
}
