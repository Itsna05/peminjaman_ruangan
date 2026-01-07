<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // =====================
    // TAMPILKAN DATA PETUGAS
    // =====================
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas'));
    }

    // =====================
    // FORM TAMBAH PETUGAS
    // =====================
    public function create()
    {
        return view('petugas.create');
    }

    // =====================
    // SIMPAN PETUGAS BARU
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:6',
        ]);

        Petugas::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            // langsung bcrypt (JANGAN MD5)
            'password' => Hash::make($request->password),
        ]);

        return redirect('/petugas')->with('success', 'Petugas berhasil ditambahkan');
    }

    // =====================
    // FORM EDIT PETUGAS
    // =====================
    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    // =====================
    // UPDATE PETUGAS
    // =====================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:petugas,username,' . $id . ',id_petugas',
        ]);

        $petugas = Petugas::findOrFail($id);

        $data = [
            'nama'     => $request->nama,
            'username' => $request->username,
        ];

        // password opsional
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect('/petugas')->with('success', 'Data petugas berhasil diubah');
    }

    // =====================
    // HAPUS PETUGAS
    // =====================
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect('/petugas')->with('success', 'Petugas berhasil dihapus');
    }
}
