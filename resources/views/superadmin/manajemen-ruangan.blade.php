@extends('superadmin.layout')

@section('title', 'Manajemen Ruangan')

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
                Manajemen Ruangan
                <span class="line"></span>
            </h4>

            <p class="info-desc">
                Berikut merupakan Denah dan Data Ruangan Kantor DPU BMCK Jateng 
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
        <div class="status-card">

              {{-- SEARCH & TAMBAH RUANGAN --}}
              <div class="status-toolbar">
                  <div class="search-box">
                      <button type="button" class="search-btn">
                          <i class="bi bi-search"></i>
                      </button>
                      <input type="text" placeholder="Pencarian" id="searchInput">
                  </div>

                <div class="tambah-box">
                    <button class="tambah-btn" type="button" id="tambahToggle">
                        Tambah Ruangan
                        <span class="icon-plus">+</span>
                    </button>
                </div>


        </div>

        <div class="ruangan-slider">
            <div class="ruangan-track">

            {{-- ================= CARD 1 ================= --}}
            <div class="detail-card">

                <div class="detail-card-header">Ruang SKPD TP</div>

                <div class="detail-card-image">
                    <div id="foto-skpd-timur"
                         class="carousel slide foto-carousel"
                         data-bs-touch="false"
                         data-bs-interval="false">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/ruang_SKPD_TP1.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP2.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP3.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP4.png') }}">
                            </div>
                        </div>

                        <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#foto-skpd-timur"
                                data-bs-slide="prev"></button>

                        <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#foto-skpd-timur"
                                data-bs-slide="next"></button>
                    </div>
                    <button class="btn-lihat-detail">
                        Lihat Detail
                    </button>
                </div>
            </div>

            {{-- ================= CARD 2 ================= --}}
            <div class="detail-card">

                <div class="detail-card-header">Ruang Rapat A</div>

                <div class="detail-card-image">
                    <div id="foto-rapat-a"
                         class="carousel slide foto-carousel"
                         data-bs-touch="false"
                         data-bs-interval="false">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/ruang_SKPD_TP3.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP2.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP1.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP4.png') }}">
                            </div>
                        </div>

                        <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#foto-rapat-a"
                                data-bs-slide="prev"></button>

                        <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#foto-rapat-a"
                                data-bs-slide="next"></button>
                    </div>
                    <button class="btn-lihat-detail">
                        Lihat Detail
                    </button>
                </div>
            </div>

            {{-- ================= CARD 3 ================= --}}
            <div class="detail-card">

                <div class="detail-card-header">Aula Utama</div>

                <div class="detail-card-image">
                    <div id="foto-aula-utama"
                         class="carousel slide foto-carousel"
                         data-bs-touch="false"
                         data-bs-interval="false">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/ruang_SKPD_TP4.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP3.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP2.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/ruang_SKPD_TP1.png') }}">
                            </div>
                        </div>

                        <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#foto-aula-utama"
                                data-bs-slide="prev"></button>

                        <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#foto-aula-utama"
                                data-bs-slide="next"></button>
                    </div>
                    <button class="btn-lihat-detail">
                        Lihat Detail
                    </button>
                </div>
            </div>
            
            </div>
        </div>
    </div>

    <!-- ================= MODAL DETAIL RUANGAN ================= -->
<div class="modal-overlay" id="modalDetail">

    <div class="modal-detail">

        <!-- HEADER -->
        <div class="modal-header">
            <h5>DETAIL RUANGAN</h5>
            <button class="modal-close" id="closeModal">&times;</button>
        </div>

        <!-- FOTO / CAROUSEL -->
        <div class="modal-carousel">
            <img src="{{ asset('img/ruang_SKPD_TP1.png') }}" alt="">
            <button class="modal-nav prev">&#10094;</button>
            <button class="modal-nav next">&#10095;</button>
        </div>

        <!-- NAMA RUANGAN -->
        <h4 class="modal-room-title">Ruang Studio</h4>

        <!-- DETAIL FASILITAS -->
        <div class="modal-info">

            <div class="info-box">
                <h6>ELEKTRONIK</h6>
                <p>AC : 30</p>
                <p>Sound System : 4</p>
                <p>Layar LED : 1</p>
                <p>Alat Musik : 1</p>
            </div>

            <div class="info-box">
                <h6>NON ELEKTRONIK</h6>
                <p>Kursi : 85</p>
                <p>Meja : 4</p>
            </div>

        </div>

        <!-- ACTION BUTTON -->
        <div class="modal-action">
            <button class="btn-edit">Edit</button>
            <button class="btn-delete">Hapus Ruangan</button>
        </div>

    </div>
</div>

</section>
@endsection