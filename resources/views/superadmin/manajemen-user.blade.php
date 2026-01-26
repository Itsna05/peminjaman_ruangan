@extends('superadmin.layout')

@section('title', 'Manajemen User')

@section('content')

{{-- =======================
   HEADER BACKGROUND
   ======================= --}}
<section class="dashboard-hero"></section>

{{-- =======================
   HEADER INFO BOX
   ======================= --}}
<section class="dashboard-info">
    <div class="container">
        <div class="info-box text-center">

            <h4 class="info-title">
                <span class="line"></span>
                Bidang Pegawai
                <span class="line"></span>
            </h4>

            <p class="info-desc">
                 Daftar bidang dan sub bidang pegawai pada Dinas Pekerjaan Umum Bina Marga dan Cipta Karya.
            </p>

        </div>
    </div>
</section>

{{-- =======================
   BIDANG PEGAWAI (STATIS)
   ======================= --}}
<section class="container my-5 status-wrapper">
        <div class="d-flex justify-content-between mb-3">
            <div class="input-group w-50">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Pencarian">
            </div>

            <button class="btn btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahBidang">
                    Tambah
            </button>
        </div>

            <div class="table-responsive search-item">
                <table class="approval-table status-card">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Bidang</th>
                            <th>Sub Bidang</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Sekretariat</td>
                            <td>Sekretaris</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Sekretariat</td>
                            <td>Kasubbag Umpeg</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Sekretariat</td>
                            <td>Kasubbag Keuangan</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</section>

{{-- =======================
   USER (DINAMIS)
   ======================= --}}
<section class="dashboard-info">
    <div class="container">
        <div class="info-box text-center">

            <h4 class="info-title">
                <span class="line"></span>
                User
                <span class="line"></span>
            </h4>

            <p class="info-desc">
                Daftar akun Super Admin dan Petugas yang terdaftar dalam sistem.
            </p>

        </div>
    </div>
</section>

<section class="container mb-5 status wrapper">

    <div class="card shadow-sm border-0">

            <div class="d-flex justify-content-between mb-3">
                <div class="input-group w-50">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Pencarian">
                </div>

                <div class="d-flex gap-2">
                    <select class="form-select">
                        <option>Filter</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>

                    <button class="btn btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambahUser">
                        Tambah
                    </button>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Peran</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Data user belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>

</section>

{{-- =======================
   MODAL TAMBAH PENGGUNA
   ======================= --}}
<div class="modal fade" id="modalTambahBidang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- FORM --}}
            <form action="{{ route('superadmin.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Masukkan nama lengkap"
                               required>
                    </div>
                    
                    {{-- BIDANG --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bidang</label>
                        <select name="bidang_id" class="form-select" required>
                            <option value="">Pilih bidang</option>
                            <option value="1">Sekretariat</option>
                            <option value="2">Bina Marga</option>
                            <option value="3">Cipta Karya</option>
                        </select>
                    </div>

                    {{-- SUB BIDANG --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sub Bidang</label>
                        <select name="sub_bidang_id" class="form-select" required>
                            <option value="">Pilih sub bidang</option>
                            <option value="1">Sekretaris</option>
                            <option value="2">Kasubbag Umpeg</option>
                            <option value="3">Kasubbag Keuangan</option>
                        </select>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer d-flex justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- =======================
   MODAL TAMBAH USER
   ======================= --}}
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Tambah Pengguna</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            {{-- FORM --}}
            <form action="{{ route('superadmin.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Masukkan nama lengkap"
                               required>
                    </div>

                    {{-- USERNAME --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username"
                               required>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>
                    </div>

                    {{-- PERAN --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Peran</label>
                        <select name="role" class="form-select" required>
                            <option value="">Pilih peran</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-top d-flex justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-danger px-4"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-success px-4">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
