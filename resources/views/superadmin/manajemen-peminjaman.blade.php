
@extends('superadmin.layout')

@section('title', 'Manajemen Peminjaman')

@section('content')

{{-- TENTUKAN TAB DARI URL--}}
@php
    $tab = request('tab', 'persetujuan');
@endphp


{{-- =======================
   HEADER BACKGROUND
   ======================= --}}
<section class="dashboard-hero"></section>

{{-- ================= HEADER CONTAINER CLICKABLE ================= --}}
<section class="dual-header-section">
    <div class="container">

        <div class="dual-header-wrapper">

            {{-- KIRI - AKTIF --}}
            <a href="{{ route('superadmin.manajemen-peminjaman') }}"
                class="dual-header {{ $tab == 'persetujuan' ? 'active' : '' }}">


                <h4 class="dual-header-title">
                    <span class="line"></span>
                    Persetujuan Peminjaman
                    <span class="line"></span>
                </h4>

                <p class="dual-header-desc">
                    Kelola dan verifikasi setiap pengajuan peminjaman
                    ruangan yang diajukan oleh pemohon.
                </p>

            </a>

            {{-- KANAN --}}
            <a href="{{ route('superadmin.manajemen-peminjaman', ['tab' => 'form']) }}"
                class="dual-header {{ $tab == 'form' ? 'active' : '' }}">


                <h4 class="dual-header-title">
                    <span class="line muted"></span>
                    Peminjaman Ruangan
                    <span class="line muted"></span>
                </h4>

                <p class="dual-header-desc">
                    Lengkapi formulir untuk melakukan peminjaman
                    ruangan sesuai kebutuhan.
                </p>

            </a>

        </div>

    </div>
</section>


{{-- =======================
   PERSETUJUAN PEMINJAMAN RUANGAN
   ======================= --}}

@if ($tab == 'persetujuan')
<section class="manajemen-peminjaman">
    <div class="container"> 
        <div class="status-wrapper">
            <div class="status-card">


            {{-- SEARCH & FILTER --}}
            <div class="status-toolbar">
                <div class="search-box">
                    <button type="button" class="search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                    <input type="text" placeholder="Pencarian" id="searchInput">
                </div>

                <div class="filter-box">
                    <button class="filter-btn" type="button" id="filterToggle">
                        Filter <span class="arrow">▾</span>
                    </button>

                    <div class="filter-dropdown" id="filterDropdown">
                        <button class="filter-item" data-value="tampilkansemua">Tampilkan Semua</button>
                        <button class="filter-item" data-value="menunggu">Menunggu</button>
                        <button class="filter-item" data-value="disetujui">Disetujui</button>
                        <button class="filter-item" data-value="ditolak">Ditolak</button>
                        <button class="filter-item" data-value="dibatalkan">Dibatalkan</button>
                    </div>
                </div>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive search-item">
                <table class="approval-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Sub Bidang</th>
                            <th>Bidang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        @forelse ($transaksi as $t)
                        <tr data-status="{{ strtolower($t->status_peminjaman) }}">

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $t->ruangan->nama_ruangan ?? '-' }}</td>

                            <td>{{ $t->bidang->sub_bidang ?? '-' }}</td>

                            <td>{{ $t->bidang->bidang ?? '-' }}</td>

                            <td class="text-center">
                                <span class="badge-status {{ strtolower($t->status_peminjaman) }}">
                                    {{ $t->status_peminjaman }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if ($t->status_peminjaman === 'Menunggu')
                                    <button class="btn-edit btn-open-modal"
                                            data-id="{{ $t->id_peminjaman }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @else
                                    <button class="btn-edit disabled" disabled>
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada pengajuan peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                            
            </div>

            {{-- FOOTER --}}    
            <div class="status-footer">
                <div class="rows-info">
                    Jumlah Baris :
                    <select id="rowsPerPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </div>


                <div class="pagination" id="pagination"></div>
            </div>
            </div>

        </div>
    </div>
</section>
@endif

@if ($tab == 'form')
{{-- FORM PEMINJAMAN --}}
<div class="form-wrapper">
    <h4 class="form-title text-center">
        Form Peminjaman Ruangan
    </h4>

    <form>
        <div class="row g-4">

            <div class="col-md-6">
                <label class="form-label">Nama Acara</label>
                <input type="text" class="form-control" placeholder="Masukkan Nama Acara">
            </div>

            <div class="col-md-6">
                <label class="form-label">Jumlah Peserta</label>
                <input type="number" class="form-control" placeholder="Masukkan Jumlah Peserta">
            </div>

            <div class="col-12">
                <label class="form-label">Waktu Peminjaman</label>

                <div class="waktu-wrapper">
                    <input type="date" class="form-control">
                    <input type="time" class="form-control waktu-jam">

                    <span class="separator">~</span>

                    <input type="date" class="form-control">
                    <input type="time" class="form-control waktu-jam">
                </div>
            </div>


            <div class="col-md-6">
                <label class="form-label">Pilih Bidang</label>
                <select class="form-select">
                    <option>Please Select</option>
                    <option value="">Please Select</option>
                    <option value="kasubag">Kepala Sub Bagian</option>
                    <option value="kasi">Kepala Seksi</option>
                    <option value="staff">Staff</option>
                    <option value="perencana">Perencana</option>
                    <option value="pengawas">Pengawas</option>
                    <option value="teknis">Teknis Lapangan</option>

                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Pilih Sub Bidang</label>
                <select class="form-select">
                    <option>Please Select</option>
                    <option value="">Please Select</option>
                    <option value="kasubag">Kepala Sub Bagian</option>
                    <option value="kasi">Kepala Seksi</option>
                    <option value="staff">Staff</option>
                    <option value="perencana">Perencana</option>
                    <option value="pengawas">Pengawas</option>
                    <option value="teknis">Teknis Lapangan</option>

                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Pilih Ruangan</label>
                <select class="form-select">
                    <option>Please Select</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" class="form-control" placeholder="Masukkan Nomor WhatsApp">
            </div>

            <div class="col-12">
                <label class="form-label">Catatan</label>
                <textarea class="form-control textarea-catatan"
                    placeholder="Tambahkan Catatan Internal Jika diperlukan"></textarea>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn-ajukan">
                    Ajukan Peminjaman
                </button>
            </div>

        </div>
    </form>
</div>

@endif

<!-- ================= MODAL DETAIL PEMINJAMAN ================= -->
<div class="modal-overlay" id="detailModal">

    <div class="modal-card">

        <!-- HEADER -->
        <div class="modal-header">
            <h4>Detail Pengajuan Peminjaman</h4>
            <button class="modal-close">&times;</button>
        </div>

        <!-- BODY -->
        <div class="modal-body">

            <div class="modal-row">
                <label>Nama Acara</label>
                <span>:</span>
                <input type="text" value="Rapat Koordinasi Pembangunan Jalan Tol" readonly>
            </div>

            <div class="modal-row">
                <label>Jumlah Peserta</label>
                <span>:</span>
                <input type="text" value="60 Orang" readonly>
            </div>

            <div class="modal-row">
                <label>Waktu Mulai</label>
                <span>:</span>
                <input type="text" value="07.00" readonly>
            </div>

            <div class="modal-row">
                <label>Waktu Selesai</label>
                <span>:</span>
                <input type="text" value="13.00" readonly>
            </div>

            <div class="modal-row">
                <label>Bidang</label>
                <span>:</span>
                <input type="text" value="Teknologi Informasi" readonly>
            </div>

            <div class="modal-row">
                <label>Sub Bidang</label>
                <span>:</span>
                <input type="text" value="Kabid" readonly>
            </div>

            <div class="modal-row">
                <label>Ruangan</label>
                <span>:</span>
                <input type="text" value="Ruang Rapat" readonly>
            </div>

            <div class="modal-row">
                <label>No Whatsapp</label>
                <span>:</span>
                <input type="text" value="08 berapa ka??" readonly>
            </div>

            <div class="modal-row textarea">
                <label>Catatan</label>
                <span>:</span>
                <textarea readonly>Tambahkan Mic 2 pcs</textarea>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="modal-footer">
            <button class="btn-approve">Setujui</button>
            <button class="btn-reject">Tolak</button>
        </div>

    </div>
</div>

<!-- ================= MODAL KONFIRMASI ================= -->
<div class="modal-overlay" id="confirmModal">

    <div class="modal-card modal-confirm">

        <!-- HEADER -->
        <div class="modal-header confirm-header">
            <h4>KONFIRMASI</h4>
        </div>

        <!-- BODY -->
        <div class="confirm-body">
            <p>Anda yakin dengan jawaban anda?</p>
        </div>

        <!-- FOOTER -->
        <div class="confirm-footer">
            <button class="btn-confirm-yes">Benar</button>
            <button class="btn-confirm-no">Batal</button>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const tableBody  = document.getElementById('tableBody');
    const rows       = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();

        Array.from(rows).forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });

});
</script>


@endsection