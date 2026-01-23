<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenRuanganController extends Controller
{
  public function index()
  {
    return view('superadmin.manajemen-ruangan.index');
  }
}
