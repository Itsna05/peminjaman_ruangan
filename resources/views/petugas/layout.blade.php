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
    if (!slider) return;

    const cards = Array.from(slider.children);
    const gap = 30;
    const cardWidth = cards[0].offsetWidth + gap;

    // clone card untuk infinite loop
    cards.forEach(card => {
        slider.appendChild(card.cloneNode(true));
        slider.insertBefore(card.cloneNode(true), slider.firstChild);
    });

    slider.scrollLeft = cardWidth * cards.length;

    function updateActiveCard() {
        const center = slider.scrollLeft + slider.offsetWidth / 2;
        slider.querySelectorAll('.detail-card').forEach(card => {
            const pos = card.offsetLeft + card.offsetWidth / 2;
            card.classList.toggle('is-active', Math.abs(center - pos) < cardWidth / 2);
        });
    }

    slider.addEventListener('scroll', () => {
        if (slider.scrollLeft <= cardWidth) {
            slider.scrollLeft += cardWidth * cards.length;
        }
        if (slider.scrollLeft >= cardWidth * (cards.length * 2)) {
            slider.scrollLeft -= cardWidth * cards.length;
        }
        requestAnimationFrame(updateActiveCard);
    });

    updateActiveCard();
});
</script>

</body>
</html>
