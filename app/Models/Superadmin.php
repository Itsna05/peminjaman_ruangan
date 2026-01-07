<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $table = 'super_admin';
    protected $primaryKey = 'id_super_admin';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
    ];
}
