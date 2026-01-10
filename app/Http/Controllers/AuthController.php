<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // =====================
        // CEK SUPER ADMIN
        // =====================
        $admin = SuperAdmin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'user_id' => $admin->id_user,
                'role'    => $admin->role,
            ]);

            return redirect()->route('dashboard');
        }

        // =====================
        // CEK PETUGAS
        // =====================
        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas && Hash::check($request->password, $petugas->password)) {
            session([
                'user_id' => $petugas->id_user,
                'role'    => $petugas->role,
            ]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah!'
        ]);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
