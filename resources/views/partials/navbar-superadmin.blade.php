<nav class="navbar navbar-expand-lg navbar-dark navbar-superadmin px-4">
    <div class="container-fluid">

        {{-- Logo & Instansi --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <img src="{{ asset('img/logo_nav.png') }}" alt="Logo" height="38">
        </a>

        {{-- Toggle Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPetugas">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse justify-content-end" id="navPetugas">

            <ul class="nav nav-underline align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link text-white active" aria-current="page" href="#">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        Manajemen Ruangan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        Manajemen Peminjaman
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        Manajemen User
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shared.kontak') ? 'active' : '' }}"
                        href="{{ route('shared.kontak') }}">Kontak</a>
                </li>
            </ul>

            {{-- Logout Button --}}
            <a href="#"
               class="btn btn-outline-light btn-logout d-flex align-items-center justify-content-center">
               <i class="bi bi-arrow-right-circle"></i>
            </a>

        </div>
    </div>
</nav>
