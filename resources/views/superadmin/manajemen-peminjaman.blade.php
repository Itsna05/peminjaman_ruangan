@extends('superadmin.layout')

@section('title', 'Manajemen Peminjaman')

@section('content')

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
               class="dual-header active">

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
            <a href="#"
               class="dual-header">

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
<section>
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
                        Filter
                        <span class="arrow">▾</span>
                    </button>

                    <div class="filter-dropdown" id="filterDropdown">
                        <button class="filter-item" data-value="tampilkan-semua">Tampilkan Semua</button>
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
                        <tr>
                            <td>1</td>
                            <td>Ruang Studio</td>
                            <td>Kasubag</td>
                            <td>Teknologi Informasi</td>
                            <td class="text-center">
                                <span class="badge-status menunggu">Menunggu</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit btn-open-modal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Ruang Bond</td>
                            <td>Kasubag</td>
                            <td>Bidang Rancang Bangun dan Pengawasan</td>
                            <td class="text-center">
                                <span class="badge-status disetujui">Disetujui</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit disabled" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ruang Studio</td>
                            <td>Kasubag</td>
                            <td>Teknologi Informasi</td>
                            <td class="text-center">
                                <span class="badge-status ditolak">Ditolak</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Ruang Bond</td>
                            <td>Kasubag</td>
                            <td>Bidang Rancang Bangun dan Pengawasan</td>
                            <td class="text-center">
                                <span class="badge-status dibatalkan">Dibatalkan</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit disabled" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Ruang Studio</td>
                            <td>Kasubag</td>
                            <td>Teknologi Informasi</td>
                            <td class="text-center">
                                <span class="badge-status menunggu">Menunggu</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Ruang Bond</td>
                            <td>Kasubag</td>
                            <td>Bidang Rancang Bangun dan Pengawasan</td>
                            <td class="text-center">
                                <span class="badge-status disetujui">Disetujui</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit disabled" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Ruang Studio</td>
                            <td>Kasubag</td>
                            <td>Teknologi Informasi</td>
                            <td class="text-center">
                                <span class="badge-status menunggu">Menunggu</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>Ruang Bond</td>
                            <td>Kasubag</td>
                            <td>Bidang Rancang Bangun dan Pengawasan</td>
                            <td class="text-center">
                                <span class="badge-status disetujui">Disetujui</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit disabled" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Ruang Studio</td>
                            <td>Kasubag</td>
                            <td>Teknologi Informasi</td>
                            <td class="text-center">
                                <span class="badge-status menunggu">Menunggu</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>10</td>
                            <td>Ruang Bond</td>
                            <td>Kasubag</td>
                            <td>Bidang Rancang Bangun dan Pengawasan</td>
                            <td class="text-center">
                                <span class="badge-status disetujui">Disetujui</span>
                            </td>
                            <td class="text-center">
                                <button class="btn-edit disabled" disabled>
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                                           
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

            <div class="form-row">
                <label>Nama Acara</label>
                <input type="text" value="Rapat Koordinasi Pembangunan Jalan Tol" readonly>
            </div>

            <div class="form-row">
                <label>Jumlah Peserta</label>
                <input type="text" value="60 Orang" readonly>
            </div>

            <div class="form-row">
                <label>Waktu Mulai</label>
                <input type="text" value="07.00" readonly>
            </div>

            <div class="form-row">
                <label>Waktu Selesai</label>
                <input type="text" value="13.00" readonly>
            </div>

            <div class="form-row">
                <label>Bidang</label>
                <input type="text" value="Teknologi Informasi" readonly>
            </div>

            <div class="form-row">
                <label>Sub Bidang</label>
                <input type="text" value="Kabid" readonly>
            </div>

            <div class="form-row">
                <label>Ruangan</label>
                <input type="text" value="Ruang Rapat" readonly>
            </div>

            <div class="form-row">
                <label>No Whatsapp</label>
                <input type="text" value="08 berapa ka??" readonly>
            </div>

            <div class="form-row">
                <label>Catatan</label>
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


<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/filter-item.js') }}"></script>
<script src="{{ asset('js/pagination.js') }}"></script>
<script src="{{ asset('js/modal-detail.js') }}"></script>


@endsection