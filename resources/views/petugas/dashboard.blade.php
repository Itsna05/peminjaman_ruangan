@extends('petugas.layout')

@section('title', 'Dashboard Petugas')

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
                Informasi Peminjaman Ruangan
                <span class="line"></span>
            </h4>

            <p class="info-desc">
                Peminjaman ruangan hanya dapat digunakan apabila telah memperoleh persetujuan resmi
                dari pihak terkait sesuai alur yang ditetapkan oleh Dinas Pekerjaan Umum Bina Marga
                dan Cipta Karya (DPU BMCK) Provinsi Jawa Tengah. Penggunaan ruangan wajib mematuhi
                ketentuan jam operasional, kapasitas ruangan, serta menjaga kebersihan, ketertiban,
                dan keamanan fasilitas selama kegiatan berlangsung.
            </p>

        </div>
    </div>
</section>


{{-- =======================
   RUNNING TEXT
   ======================= --}}
<div class="running-text">
    <marquee>
        @foreach ($eventsMonth as $event)
            {{ strtoupper($event->acara) }} &nbsp; • &nbsp;
        @endforeach
    </marquee>
</div>

{{-- =======================
   KALENDER & DATA KEGIATAN
   ======================= --}}
<section class="dashboard-content">
    <div class="container">
        <div class="row g-4">

            {{-- =======================
            KALENDER DASHBOARD PETUGAS
            ======================= --}}
            <div class="col-lg-8">
                <div class="calendar-card">

                    {{-- Header Kalender --}}
                    <div class="calendar-header">
                        <a href="{{ route('petugas.dashboard', [
                            'month' => $today->copy()->subMonth()->format('Y-m')
                        ]) }}" class="btn btn-sm btn-primary">
                            &lt;
                        </a>

                        <span class="calendar-title">
                            {{ strtoupper($today->translatedFormat('F Y')) }}
                        </span>

                        <a href="{{ route('petugas.dashboard', [
                            'month' => $today->copy()->addMonth()->format('Y-m')
                        ]) }}" class="btn btn-sm btn-primary">
                            &gt;
                        </a>
                    </div>

                    {{-- Grid Kalender --}}
                    <div class="calendar-grid">

                        {{-- Nama Hari --}}
                        @foreach (['Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu'] as $day)
                            <div class="calendar-day">{{ $day }}</div>
                        @endforeach

                        @php
                            $startOfMonth = $today->copy()->startOfMonth();
                            $daysInMonth  = $today->daysInMonth;
                            $startDay     = $startOfMonth->dayOfWeekIso; // Senin = 1
                        @endphp

                        {{-- Cell kosong sebelum tanggal 1 --}}
                        @for ($i = 1; $i < $startDay; $i++)
                            <div class="calendar-date empty"></div>
                        @endfor

                        {{-- Tanggal --}}
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $currentDate = $startOfMonth->copy()->addDays($day - 1);
                                $eventsOnDate = $eventsMonth->filter(function ($event) use ($currentDate) {
                                    return $event->waktu_mulai->toDateString()
                                        === $currentDate->toDateString();
                                });
                            @endphp

                            <div class="calendar-date {{ $eventsOnDate->count() ? 'active-event' : '' }}">
                                <span class="date-number">{{ $day }}</span>

                                @foreach ($eventsOnDate as $event)
                                    <div class="event">
                                        • {{ $event->acara }}<br>
                                        {{ $event->waktu_mulai->format('H:i') }} -
                                        {{ $event->waktu_selesai->format('H:i') }}
                                    </div>
                                @endforeach
                            </div>
                        @endfor

                    </div>
                </div>
            </div>


            {{-- DATA KEGIATAN HARI INI --}}
            <div class="col-lg-4">
                <div class="event-info-card">
                    <h6 class="event-info-title">
                        Data kegiatan berlangsung hari ini
                    </h6>

                    @if ($eventsToday->count())
                        @foreach ($eventsToday as $event)

                            <div class="event-info-item">
                                <strong>Nama Acara</strong>
                                <p>{{ $event->acara }}</p>
                            </div>

                            <div class="event-info-item">
                                <strong>Jumlah Peserta</strong>
                                <p>{{ $event->jumlah_peserta }} orang</p>
                            </div>

                            <div class="event-info-item">
                                <strong>Waktu</strong>
                                <p>
                                    {{ $event->waktu_mulai->format('H:i') }} -
                                    {{ $event->waktu_selesai->format('H:i') }}
                                </p>
                            </div>

                            <div class="event-info-item">
                                <strong>Status</strong>
                                <p>{{ $event->status_peminjaman }}</p>
                            </div>

                            <div class="event-info-item">
                                <strong>Catatan</strong>
                                <p>{{ $event->catatan ?? '-' }}</p>
                            </div>

                            <hr>

                        @endforeach
                    @else
                        <p class="text-muted">
                            Tidak ada kegiatan yang berlangsung hari ini
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
