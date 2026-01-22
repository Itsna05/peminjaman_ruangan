@extends('monitor.layout')

@section('title', 'Landing Page Monitor')

@section('content')

<main class="monitor-main">

    {{-- KIRI --}}
    <section class="monitor-card-harian">
        <h5 class="section-title">Jadwal Pemakaian Ruangan Hari Ini</h5>

        <div class="today-slider" id="todaySlider">
            <div class="today-card">
                <span class="badge-status red">SEDANG DIGUNAKAN</span>
                <h6>RUANG STUDIO</h6>
                <p>🕒 08.00 - 10.00</p>
                <strong>Rapat Perencanaan Jalan</strong>
                <small>Bidang Pembangunan Jalan</small>
            </div>

            <div class="today-card">
                <span class="badge-status red">SEDANG DIGUNAKAN</span>
                <h6>RUANG STUDIO</h6>
                <p>🕒 10.00 - 12.00</p>
                <strong>Rapat Koordinasi</strong>
                <small>Bidang Pengawasan</small>
            </div>
        </div>
    </section>

    {{-- KANAN --}}
    <section class="monitor-card-mendatang">
        <h5 class="section-title">Jadwal Pemakaian Ruangan Mendatang</h5>

        <div class="table-wrapper table-scroll">
            <table class="monitor-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>Nama Acara</th>
                        <th>Bidang</th>
                    </tr>
                </thead>
                <tbody id="autoScrollTable">
                    <tr>
                        <td>15 Jan 2026<br>10.00–13.00</td>
                        <td>R. Rapat Barat II</td>
                        <td><strong>Rapat Bendungan</strong></td>
                        <td>Bidang Prancangan Jalan</td>
                    </tr>
                    <tr>
                        <td>16 Jan 2026<br>08.00–11.00</td>
                        <td>R. Rapat Barat II</td>
                        <td><strong>Evaluasi Proyek</strong></td>
                        <td>Bidang Prancangan Jalan</td>
                    </tr>
                    {{-- dst --}}
                </tbody>
            </table>
        </div>
    </section>

</main>



{{-- GALERI --}}
<section class="monitor-gallery">
    <h3>RUANGAN STUDIO</h3>

    <div class="room-slider">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
        <img src="{{ asset('img/ruang_studio.png') }}">
    </div>
</section>
@endsection
