<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // TAMPILKAN HALAMAN LOGIN
    // =====================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =====================
    // PROSES LOGIN SUPER ADMIN
    // =====================
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari super admin berdasarkan username
        $admin = SuperAdmin::where('username', $request->username)->first();

        // Jika user tidak ditemukan atau password salah
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'login' => 'Username atau password salah!'
            ]);
        }

        // Simpan ke session
        session([
            'super_admin' => $admin
        ]);

        // Redirect ke dashboard super admin
        return redirect()->route('dashboard');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout()
    {
        session()->forget('super_admin');
        session()->flush();

        return redirect('/login');
    }
}
