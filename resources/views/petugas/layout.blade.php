<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    {{-- PETUGAS --}}
    <link rel="stylesheet" href="{{ asset('css/petugas.css') }}">

    {{-- JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard-calendar.js') }}"></script>

</head>
<body>

{{-- Navbar --}}
@include('partials.navbar-petugas')

<main>
    @yield('content')
</main>

{{-- Footer --}}
@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const slider = document.querySelector('.ruangan-slider');
    const track  = document.querySelector('.ruangan-track');
    if (!slider || !track) return;

    /* =========================================
       HANYA FUNGSI SPOTLIGHT CARD TENGAH
       (tanpa clone, tanpa infinite)
       ========================================= */

    function updateActiveCard(){
        const sliderRect = slider.getBoundingClientRect();
        const sliderCenter = sliderRect.left + sliderRect.width / 2;

        document.querySelectorAll('.detail-card').forEach(card => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + cardRect.width / 2;
            const distance = Math.abs(sliderCenter - cardCenter);

            card.classList.toggle(
                'is-active',
                distance < cardRect.width * 0.45
            );
        });
    }

    slider.addEventListener('scroll', () => {
        requestAnimationFrame(updateActiveCard);
    });

    /* Lindungi tombol carousel supaya tidak ikut geser slider */
    document.querySelectorAll('.foto-carousel button').forEach(btn => {
        btn.addEventListener('mousedown', e => e.stopPropagation());
        btn.addEventListener('touchstart', e => e.stopPropagation());
        btn.addEventListener('click', e => e.stopPropagation());
    });

    updateActiveCard();
});
</script>

</body>
</html>
