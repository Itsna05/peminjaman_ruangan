<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // 🔍 CARI USER BERDASARKAN USERNAME
        $user = User::where('username', $request->username)->first();

        // ❌ Kalau user tidak ada atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Username atau password salah!'
            ]);
        }

        // ✅ LOGIN BERHASIL
        session([
            'user_id' => $user->id_user,
            'username' => $user->username,
            'role' => $user->role
        ]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
