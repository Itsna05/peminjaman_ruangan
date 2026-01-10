<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // ⬇️ INI PALING PENTING
    protected $table = 'user';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    public $timestamps = false;
}
