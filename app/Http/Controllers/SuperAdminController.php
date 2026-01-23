<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        // HANYA ambil user role superadmin
        $admins = User::where('role', 'superadmin')->get();
        return view('superadmin.dashboard', compact('admins'));
    }

    public function manajemenuser()
    {
        $users = User::all();
        return view('superadmin.manajemen-user', compact('users'));
    }


    public function create()
    {
        return view('superadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'superadmin', // 🔑 DIPAKSA
        ]);

        return redirect('/superadmin')->with('success', 'Super Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = User::where('role', 'superadmin')->findOrFail($id);
        return view('superadmin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username,' . $id . ',id_user',
        ]);

        $admin = User::where('role', 'superadmin')->findOrFail($id);

        $data = [
            'nama'     => $request->nama,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect('/superadmin')->with('success', 'Super Admin berhasil diubah');
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'superadmin')->findOrFail($id);
        $admin->delete();

        return redirect('/superadmin')->with('success', 'Super Admin berhasil dihapus');
    }
}
