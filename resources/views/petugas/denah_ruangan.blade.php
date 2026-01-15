@extends('petugas.layout')

@section('title', 'Denah Ruangan')

@section('content')

{{-- HEADER BACKGROUND --}}
<section class="dashboard-hero"></section>

{{-- HEADER INFO --}}
<section class="dashboard-info">
    <div class="container">
        <div class="info-box text-center">
            <h4 class="info-title">
                <span class="line"></span>
                Denah Ruangan
                <span class="line"></span>
            </h4>
            <p class="info-desc">
                Berikut merupakan data Denah Ruangan Kantor DPU BMCK Jateng
            </p>
        </div>
    </div>
</section>

{{-- DENAH EKSISTING --}}
<section class="denah-section">
    <div class="container">
        <div class="denah-card text-center">
            <h3 class="denah-title">Denah Eksisting Lantai 1</h3>
            <img src="{{ asset('img/denah_lantai1.png') }}" class="img-fluid">
        </div>
    </div>
</section>

{{-- DETAIL RUANGAN --}}
<section class="detail-ruangan-section">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">Detail Ruangan</h3>

        <div class="ruangan-slider">

            {{-- ================= CARD 1 ================= --}}
            <div class="detail-card">

                <div class="detail-card-header">DETAIL RUANGAN</div>

                <div class="detail-card-image">
                    <div id="foto1" class="carousel slide foto-carousel" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/ruang_SKPD_TP1.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP2.png') }}">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#foto1" data-bs-slide="prev"></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#foto1" data-bs-slide="next"></button>
                    </div>
                </div>

                <div class="detail-card-body">
                    <h5 class="detail-card-title">Ruang SKPD Timur</h5>

                    <div class="detail-card-info">
                        <div class="info-box">
                            <h6>Elektronik</h6>
                            <ul>
                                <li>AC : 2</li>
                                <li>Sound System : 1</li>
                                <li>Layar LED : 1</li>
                            </ul>
                        </div>
                        <div class="info-box">
                            <h6>Non Elektronik</h6>
                            <ul>
                                <li>Kursi : 20</li>
                                <li>Meja : 5</li>
                            </ul>
                        </div>
                    </div>

                    <div class="detail-card-footer">
                        <button class="btn btn-warning">TUTUP</button>
                    </div>
                </div>
            </div>

            {{-- ================= CARD 2 ================= --}}
            <div class="detail-card">
                <div class="detail-card-header">DETAIL RUANGAN</div>
                <div class="detail-card-image">
                    <img src="{{ asset('img/ruang_SKPD_TP3.png') }}">
                </div>
                <div class="detail-card-body">
                    <h5 class="detail-card-title">Ruang Rapat A</h5>
                    <div class="detail-card-info">
                        <div class="info-box">
                            <h6>Elektronik</h6>
                            <ul><li>AC : 4</li><li>Sound System : 2</li></ul>
                        </div>
                        <div class="info-box">
                            <h6>Non Elektronik</h6>
                            <ul><li>Kursi : 40</li><li>Meja : 10</li></ul>
                        </div>
                    </div>
                    <div class="detail-card-footer">
                        <button class="btn btn-warning">TUTUP</button>
                    </div>
                </div>
            </div>

            {{-- ================= CARD 3 ================= --}}
            <div class="detail-card">
                <div class="detail-card-header">DETAIL RUANGAN</div>
                <div class="detail-card-image">
                    <img src="{{ asset('img/ruang_SKPD_TP4.png') }}">
                </div>
                <div class="detail-card-body">
                    <h5 class="detail-card-title">Aula Utama</h5>
                    <div class="detail-card-info">
                        <div class="info-box">
                            <h6>Elektronik</h6>
                            <ul><li>AC : 10</li><li>Sound System : 4</li></ul>
                        </div>
                        <div class="info-box">
                            <h6>Non Elektronik</h6>
                            <ul><li>Kursi : 120</li><li>Meja : 20</li></ul>
                        </div>
                    </div>
                    <div class="detail-card-footer">
                        <button class="btn btn-warning">TUTUP</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection