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
<section>
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

                    <div class="col-12">
                        <label class="form-label">Waktu Peminjaman</label>

                        <div class="d-flex gap-2">
                            <input type="date" id="tgl_mulai" class="form-control">
                            <input type="time" id="jam_mulai" class="form-control" style="max-width:140px">

                            <span class="align-self-center">~</span>

                            <input type="date" id="tgl_selesai" class="form-control">
                            <input type="time" id="jam_selesai" class="form-control" style="max-width:140px">
                        </div>
                    </div>

 

                    {{-- INPUT HIDDEN UNTUK MENGGABUNG WAKTU --}}
                    <input type="hidden" name="waktu_mulai" id="waktu_mulai">
                    <input type="hidden" name="waktu_selesai" id="waktu_selesai">

                    <script>
                    function gabungWaktu() {
                        const tglMulai = document.getElementById('tgl_mulai').value;
                        const jamMulai = document.getElementById('jam_mulai').value;
                        const tglSelesai = document.getElementById('tgl_selesai').value;
                        const jamSelesai = document.getElementById('jam_selesai').value;

                        if (tglMulai && jamMulai) {
                            document.getElementById('waktu_mulai').value =
                                tglMulai + ' ' + jamMulai + ':00';
                        }

                        if (tglSelesai && jamSelesai) {
                            document.getElementById('waktu_selesai').value =
                                tglSelesai + ' ' + jamSelesai + ':00';
                        }
                    }
                    </script>

                    @php
                        $bidang = \Illuminate\Support\Facades\DB::table('bidang_pegawai')
                                    ->select('bidang')
                                    ->distinct()
                                    ->get();
                    @endphp

                    <div class="col-md-6">
                        <label class="form-label">Pilih Bidang</label>
                        <select name="bidang" id="bidang" class="form-select">
                            <option value="">Please Select</option>
                            @foreach ($bidang as $b)
                                <option value="{{ $b->bidang }}">{{ $b->bidang }}</option>
                                <script>
                                document.getElementById('bidang').addEventListener('change', function () {
                                    let bidang = this.value;

                                    if (bidang === '') {
                                        document.getElementById('sub_bidang').innerHTML =
                                            "<option value=''>Please Select</option>";
                                        return;
                                    }

                                    fetch('/petugas/get-sub-bidang?bidang=' + encodeURIComponent(bidang))
                                        .then(res => res.text())
                                        .then(data => {
                                            document.getElementById('sub_bidang').innerHTML = data;
                                        })
                                        .catch(err => {
                                            console.error(err);
                                        });
                                });
                                </script>

                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Pilih Sub Bidang</label>
                        <select name="id_bidang" id="sub_bidang" class="form-select">
                            <option value="">Please Select</option>
                        </select>
                    </div>


                    @php
                        $ruangan = \Illuminate\Support\Facades\DB::table('ruangan')
                                    ->where('ketersediaan', 'Tersedia')
                                    ->get();
                    @endphp

                    <div class="col-md-6">
                        <label class="form-label">Pilih Ruangan</label>
                        <select name="id_ruangan" class="form-select">
                            <option value="">Please Select</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id_ruangan }}">
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
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
                        <button type="submit" class="btn-ajukan" onclick="gabungWaktu()">
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
                <div class="table-responsive table-scroll-x search-item ">
                    <table class="status-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Acara</th>
                                <th>Waktu</th>
                                <th>Bidang</th>
                                <th>No WhatsApp</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="tableBody">
                            @forelse ($transaksi as $item)
                                <tr data-status="{{ strtolower($item->status_peminjaman) }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_ruangan }}</td>
                                    <td>{{ $item->acara }}</td>
                                    <td>
                                        <div class="tanggal">
                                            {{ \Carbon\Carbon::parse($item->waktu_mulai)->translatedFormat('d F Y') }}
                                        </div>
                                        <div class="jam">
                                            {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }} WIB
                                        </div>
                                    </td>

                                    <td>
                                        <div class="bidang-nama">
                                            {{ $item->bidang }}
                                        </div>
                                        <div class="sub-bidang">
                                            {{ $item->sub_bidang ?? '-' }}
                                        </div>
                                    </td>
                                    
                                    <td>{{ $item->no_wa }}</td>

                                    <td class="text-center">
                                        <span class="badge-status {{ strtolower($item->status_peminjaman) }}">
                                            {{ $item->status_peminjaman }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        @if ($item->status_peminjaman === 'Menunggu')
                                            <button class="btn-aksi"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditPeminjaman"
                                                data-id="{{ $item->id_peminjaman }}">
                                                ✎
                                            </button>
                                        @else
                                            <button class="btn-aksi disabled" disabled>✎</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Data peminjaman belum ada
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

        <!-- {{-- STATUS PEMINJAMAN --}}
        <div class="status-wrapper">

            <h4 class="status-title text-center">
                Status Peminjaman Ruangan
            </h4>

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
                            <button class="filter-item" data-value="tampilkansemua">Tampilkan Semua</button>
                            <button class="filter-item" data-value="menunggu">Menunggu</button>
                            <button class="filter-item" data-value="disetujui">Disetujui</button>
                            <button class="filter-item" data-value="ditolak">Ditolak</button>
                            <button class="filter-item" data-value="dibatalkan">Dibatalkan</button>
                        </div>
                    </div>

                </div>
                <tbody id="tableBody">
                @foreach ($transaksi as $i => $t)
                <tr data-status="{{ strtolower($t->status_peminjaman) }}">
                    <td>{{ $i + 1 }}</td>

                    <td>{{ $t->nama_ruangan }}</td>

                    <td>{{ $t->acara }}</td>

                    <td>{{ $t->bidang }}</td>

                    {{-- STATUS --}}
                    <td class="text-center">
                        <span class="badge-status {{ strtolower($t->status_peminjaman) }}">
                            {{ $t->status_peminjaman }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        @if ($t->status_peminjaman === 'Menunggu')
                            <button
                                class="btn-aksi"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditPeminjaman"
                                data-id="{{ $t->id_peminjaman }}">
                                ✎
                            </button>
                        @else
                            <button class="btn-aksi disabled" disabled>✎</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>

                {{-- TABLE --}}
                <div class="table-responsive search-item">
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
                        <tbody id="tableBody">
                            @forelse ($transaksi as $item)
                                <tr data-status="{{ strtolower($item->status_peminjaman) }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_ruangan }}</td>
                                    <td>{{ $item->acara }}</td>
                                    <td>{{ $item->bidang }}</td>

                                    <td class="text-center">
                                        <span class="badge-status {{ strtolower($item->status_peminjaman) }}">
                                            {{ $item->status_peminjaman }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        @if ($item->status_peminjaman === 'Menunggu')
                                            <button class="btn-aksi"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditPeminjaman">
                                                ✎
                                            </button>
                                        @else
                                            <button class="btn-aksi disabled" disabled>✎</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Data peminjaman belum ada
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
    </div> -->
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

                <div class="modal-body">
                <form>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Acara</label>
                            <input type="text" class="form-control edit-field"
                                value="Hari Amal Bakti DPU" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control edit-field"
                                value="300" readonly>
                        </div>

                        {{-- WAKTU PEMINJAMAN --}}
                        <div class="col-12">
                            <label class="form-label">Waktu Peminjaman</label>

                            <div class="d-flex gap-2">
                                <input type="date" id="tgl_mulai"
                                    class="form-control edit-field"
                                    value="{{ $tglMulai ?? '' }}" readonly>

                                <input type="time" id="jam_mulai"
                                    class="form-control edit-field"
                                    value="{{ $jamMulai ?? '' }}"
                                    style="max-width:140px" readonly>

                                <span class="align-self-center">~</span>

                                <input type="date" id="tgl_selesai"
                                    class="form-control edit-field"
                                    value="{{ $tglSelesai ?? '' }}" readonly>

                                <input type="time" id="jam_selesai"
                                    class="form-control edit-field"
                                    value="{{ $jamSelesai ?? '' }}"
                                    style="max-width:140px" readonly>
                            </div>
                        </div>

                        {{-- HIDDEN DATETIME --}}
                        <input type="hidden" name="waktu_mulai" id="waktu_mulai">
                        <input type="hidden" name="waktu_selesai" id="waktu_selesai">

                        <div class="col-md-6">
                            <label class="form-label">Pilih Bidang</label>
                            <select class="form-select edit-field" readonly>
                                <option>Bidang Rancang Bangun dan Pengawasan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pilih Sub Bidang</label>
                            <select class="form-select edit-field" readonly>
                                <option>Kasi Perancang Bangunan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pilih Ruangan</label>
                            <select class="form-select edit-field" readonly>
                                <option>Ruang Studio</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="text" class="form-control edit-field"
                                value="083239242938" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control edit-field" readonly>
                                Butuh sound
                            </textarea>
                        </div>

                    </div>
                </form>
            </div>



                <!-- {{-- BODY --}}
                <div class="modal-body">
                    <form>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Acara</label>
                                <input type="text" class="form-control edit-field" value="Hari Amal Bakti DPU" disabled>

                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jumlah Peserta</label>
                                <input type="number" class="form-control edit-field" value="300" disabled>

                            </div>

                            <div class="col-12">
                                <label class="form-label">Waktu Peminjaman</label>

                                <div class="d-flex gap-2">
                                    <input type="date" id="tgl_mulai" class="form-control"
                                        value="{{ $tglMulai ?? '' }}" readonly>

                                    <input type="time" id="jam_mulai" class="form-control"
                                        value="{{ $jamMulai ?? '' }}" style="max-width:140px" readonly>

                                    <span class="align-self-center">~</span>

                                    <input type="date" id="tgl_selesai" class="form-control"
                                        value="{{ $tglSelesai ?? '' }}" readonly>

                                    <input type="time" id="jam_selesai" class="form-control"
                                        value="{{ $jamSelesai ?? '' }}" style="max-width:140px" readonly>
                                </div>
                            </div>

                            <input type="hidden" name="waktu_mulai" id="waktu_mulai">
                            <input type="hidden" name="waktu_selesai" id="waktu_selesai">

                            <script>
                            function gabungWaktu() {
                                const tglMulai = document.getElementById('tgl_mulai').value;
                                const jamMulai = document.getElementById('jam_mulai').value;
                                const tglSelesai = document.getElementById('tgl_selesai').value;
                                const jamSelesai = document.getElementById('jam_selesai').value;

                                if (tglMulai && jamMulai) {
                                    document.getElementById('waktu_mulai').value =
                                        tglMulai + ' ' + jamMulai + ':00';
                                }

                                if (tglSelesai && jamSelesai) {
                                    document.getElementById('waktu_selesai').value =
                                        tglSelesai + ' ' + jamSelesai + ':00';
                                }
                            }
                            </script>



                            <div class="col-md-6">
                                <label class="form-label">Waktu Mulai</label>
                                <select class="form-select edit-field" disabled>

                                    <option>08.00 WIB</option>
                                    <option>09.00 WIB</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Waktu Selesai</label>
                                <select class="form-select edit-field" disabled>

                                    <option>14.00 WIB</option>
                                    <option>15.00 WIB</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Bidang</label>
                                <select class="form-select edit-field" disabled>

                                    <option>Bidang Rancang Bangun dan Pengawasan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Sub Bidang</label>
                                <select class="form-select edit-field" disabled>

                                    <option>Kasi Perancang Bangunan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pilih Ruangan</label>
                                <select class="form-select edit-field" disabled>

                                    <option>Ruang Studio</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control edit-field" value="083239242938" disabled>

                            </div>

                            <div class="col-12">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control edit-field" disabled>Butuh sound</textarea>

                            </div>

                        </div>
                    </form>
                </div> -->

                {{-- FOOTER --}}
                <div class="modal-footer border-0 modal-footer-custom">

                    {{-- MODE AWAL --}}
                    <div id="footerView" class="footer-actions">
                        <button class="btn btn-primary px-4" id="btnEdit">
                            Edit
                        </button>

                        <button class="btn btn-danger px-4" id="btnBatalkanPeminjaman">
                            Batalkan Peminjaman
                        </button>

                    </div>

                    {{-- MODE EDIT --}}
                    <div id="footerEdit" class="footer-actions d-none">
                        <button class="btn btn-success px-4" id="btnSimpan" onclick="gabungWaktu()">
                            Simpan
                        </button>

                        <button class="btn btn-danger px-4" id="btnBatal">
                            Batal
                        </button>
                    </div>

                    {{-- MODE DIBATALKAN --}}
                    <div id="footerCanceled" class="footer-canceled d-none">
                        Acara dibatalkan oleh pihak terkait
                    </div>


                </div>




            </div>
        </div>
    </div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const btnEdit   = document.getElementById('btnEdit');
    const btnBatal  = document.getElementById('btnBatal');
    const btnBatalkan = document.getElementById('btnBatalkanPeminjaman'); // ⬅️ BARU

    const footerView = document.getElementById('footerView');
    const footerEdit = document.getElementById('footerEdit');
    const footerCanceled = document.getElementById('footerCanceled'); // ⬅️ BARU

    const fields = document.querySelectorAll('.edit-field');

    // KLIK EDIT
    btnEdit.addEventListener('click', function () {

        // Aktifkan semua input
        fields.forEach(field => {
            field.disabled = false;
        });

        // Ganti footer
        footerView.classList.add('d-none');
        footerEdit.classList.remove('d-none');
    });

    // KLIK BATAL (MODE EDIT)
    btnBatal.addEventListener('click', function () {
        location.reload();
    });

    // KLIK BATALKAN PEMINJAMAN (MODE AWAL)
    btnBatalkan.addEventListener('click', function () {

        // Pastikan semua field terkunci
        fields.forEach(field => {
            field.disabled = true;
        });

        // Sembunyikan semua footer tombol
        footerView.classList.add('d-none');
        footerEdit.classList.add('d-none');

        // Tampilkan pesan dibatalkan
        footerCanceled.classList.remove('d-none');
    });


});
</script>
{{-- SCRIPT GABUNG WAKTU --}}
<script>
function gabungWaktu() {
    document.getElementById('waktu_mulai').value =
        document.getElementById('tgl_mulai').value + ' ' +
        document.getElementById('jam_mulai').value + ':00';

    document.getElementById('waktu_selesai').value =
        document.getElementById('tgl_selesai').value + ' ' +
        document.getElementById('jam_selesai').value + ':00';
}
</script>

@endsection
