<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admins = SuperAdmin::all();
        return view('superadmin.index', compact('admins'));
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
            'role'     => 'required|in:superadmin,petugas',
        ]);

        SuperAdmin::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/superadmin')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = SuperAdmin::findOrFail($id);
        return view('superadmin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username,' . $id . ',id_user',
        ]);

        $admin = SuperAdmin::findOrFail($id);

        $data = [
            'nama'     => $request->nama,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect('/superadmin')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $admin = SuperAdmin::findOrFail($id);
        $admin->delete();

        return redirect('/superadmin')->with('success', 'Data berhasil dihapus');
    }
}
