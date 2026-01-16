<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DenahRuanganController extends Controller
{
  public function index()
  {
    return view('petugas.denah_ruangan');
  }
}
