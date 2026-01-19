@extends('petugas.layout')

@section('title', 'Peminjaman Ruangan')

@section('content')


{{-- =======================
   HERO
   ======================= --}}
<section class="dashboard-hero"></section>

{{-- =======================
   JUDUL HALAMAN
   ======================= --}}
<section class="dashboard-info">
    <div class="container">
        <div class="info-box text-center">

            <h4 class="info-title">
                <span class="line"></span>
                Peminjaman Ruangan
                <span class="line"></span>
            </h4>

            <p class="info-desc">
                Halaman ini digunakan untuk mengajukan peminjaman ruangan
                dan melihat status pengajuan peminjaman.
            </p>

        </div>
    </div>
</section>

{{-- =======================
   ISI PEMINJAMAN
   ======================= --}}
<section class="dashboard-content">
    <div class="container">

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

                    <div class="col-md-6">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pilih Bidang</label>
                        <select class="form-select">
                            <option>Please Select</option>
                            <option>Sekretariat</option>
                            <option>Bina Marga</option>
                            <option>Cipta Karya</option>
                            <option>Teknologi Informasi</option>
                            <option>Perencanaan dan Keuangan</option>
                            <option>Kepegawaian</option>
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pilih Sub Bidang</label>
                        <select class="form-select">
                            <option>Please Select</option>
                            <option>Pembangunan Jalan</option>
                            <option>Preservasi Jalan</option>
                            <option>Bangunan Gedung</option>
                            <option>Air Minum</option>
                            <option>Sanitasi</option>
                            <option>Umum dan Kepegawaian</option>
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pilih Ruangan</label>
                        <select class="form-select">
                            <option>Please Select</option>
                            <option>RUANG SEKDIN</option>
                            <option>RUANG SKPD TP 2</option>
                            <option>RUANG RAPAT KADINAS</option>
                            <option>RUANG BIDANG SPPBG</option>
                            <option>RUANG BIDANG BARAT</option>
                            <option>RUANG BIDANG TIMUR</option>
                            <option>RUANG STUDIO</option>
                            <option>RUANG DHARMA WANITA</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor WhatsApp">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control textarea-catatan" rows="3"
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

        
        {{-- STATUS PEMINJAMAN --}}
        <div class="status-wrapper">

            <h4 class="status-title text-center">
                Status Peminjaman Ruangan
            </h4>

            <div class="status-card">

                {{-- SEARCH & FILTER --}}
                <div class="status-toolbar">
                    <div class="search-box">
                        <span class="search-icon">🔍</span>
                        <input type="text" placeholder="Pencarian">
                    </div>

                    <div class="filter-box">
                        <button class="filter-btn">
                            Filter <span>▾</span>
                        </button>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="table-responsive">
                    <table class="status-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Acara</th>
                                <th>Bidang</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ruang Studio</td>
                                <td>Hari Amal Bakti DPU</td>
                                <td>Teknologi Informasi</td>
                                <td class="text-center">
                                    <span class="badge-status menunggu">Menunggu</span>
                                </td>
                                <td class="text-center">
                                    <button 
                                        class="btn-aksi"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPeminjaman">
                                        ✎
                                    </button>

                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Ruang Bond</td>
                                <td>Perencanaan Masjid At-Taqwa</td>
                                <td>Bidang Rancang Bangun</td>
                                <td class="text-center">
                                    <span class="badge-status disetujui">Disetujui</span>
                                </td>
                               <td class="text-center">
                                    <button class="btn-aksi disabled" disabled>
                                        ✎
                                    </button>
                                </td>

                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Ruang Olahraga</td>
                                <td>Rapat Preservasi Jalan</td>
                                <td>Bidang Pelaksanaan Jalan</td>
                                <td class="text-center">
                                    <span class="badge-status ditolak">Ditolak</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn-aksi disabled">✎</button>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Ruang Dharma Wanita</td>
                                <td>Pelatihan Kepenulisan</td>
                                <td>Dharma Wanita Persatuan</td>
                                <td class="text-center">
                                    <span class="badge-status dibatalkan">Dibatalkan</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn-aksi disabled">✎</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER --}}    
                <div class="status-footer">
                    <div class="rows-info">
                        Jumlah Baris :
                        <select>
                            <option>5</option>
                            <option>10</option>
                        </select>
                    </div>

                    <div class="pagination">
                        <button>‹</button>
                        <button class="active">1</button>
                        <button>2</button>
                        <button>…</button>
                        <button>5</button>
                        <button>›</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
        {{-- =======================
    MODAL EDIT PEMINJAMAN
    ======================= --}}
    <div class="modal fade" id="modalEditPeminjaman" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-custom">

                {{-- HEADER --}}
                <div class="modal-header modal-header-blue">
                    <h5 class="modal-title mx-auto text-white fw-bold">
                        Form Peminjaman Ruangan
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-custom"
                            data-bs-dismiss="modal">
                    </button>
                </div>


                {{-- BODY --}}
                <div class="modal-body">
                    <form>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Acara</label>
                                <input type="text" class="form-control" value="Hari Amal Bakti DPU">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jumlah Peserta</label>
                                <input type="number" class="form-control" value="300">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Waktu Mulai</label>
                                <select class="form-select">
                                    <option>08.00 WIB</option>
                                    <option>09.00 WIB</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Waktu Selesai</label>
                                <select class="form-select">
                                    <option>14.00 WIB</option>
                                    <option>15.00 WIB</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Bidang</label>
                                <select class="form-select">
                                    <option>Bidang Rancang Bangun dan Pengawasan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Sub Bidang</label>
                                <select class="form-select">
                                    <option>Kasi Perancang Bangunan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Ruangan</label>
                                <select class="form-select">
                                    <option>Ruang Studio</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control" value="083239242938">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control">Butuh sound</textarea>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 justify-content-center gap-3">
                    <button class="btn btn-primary px-4">
                        Edit
                    </button>
                    <button class="btn btn-danger px-4">
                        Batalkan Peminjaman
                    </button>
                </div>

            </div>
        </div>
    </div>

</section>

@endsection
