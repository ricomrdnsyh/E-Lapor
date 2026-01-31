<div class="bg-primary">
    <div class="container py-2 d-flex align-items-center justify-content-between">
        <div class="text-white fs-8 opacity-90">
            Kanal resmi pengaduan & aspirasi civitas akademika •
            <span class="opacity-75">Respon awal ≤ 1×24 jam*</span>
        </div>
        <a href="{{ route('faq') }}" class="text-white fs-8 text-decoration-none opacity-90 text-hover-white">Baca
            FAQ</a>
    </div>
</div>

<header class="elapor-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between py-4">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-icon btn-active-color-primary d-flex d-lg-none" id="kt_landing_menu_toggle"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu"
                    aria-label="Buka menu">
                    <i class="ki-duotone ki-abstract-14 fs-2hx">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </button>

                <a href="{{ route('beranda') }}" class="d-flex align-items-center text-decoration-none">
                    <span class="symbol symbol-40px symbol-circle bg-light-primary">
                        <span class="symbol-label">
                            <img src="{{ asset('assets/media/logos/unuja.png') }}" alt="Logo" class="h-45px w-45px"
                                style="object-fit: contain;">
                        </span>
                    </span>

                    <div class="ms-3">
                        <div class="fw-bold text-gray-900 lh-1 fs-5">E-Lapor</div>
                        <div class="text-muted fs-8">Universitas Nurul Jadid</div>
                    </div>
                </a>
            </div>

            <nav id="kt_landing_menu" class="d-none d-lg-flex align-items-center gap-6">
                <a href="{{ route('beranda') }}"
                    class="elapor-nav-link {{ request()->routeIs('beranda') ? 'is-active' : '' }}"
                    @if (request()->routeIs('beranda')) aria-current="page" @endif>
                    Beranda
                </a>

                <a href="{{ route('kategori') }}"
                    class="elapor-nav-link {{ request()->routeIs('kategori*') ? 'is-active' : '' }}"
                    @if (request()->routeIs('kategori*')) aria-current="page" @endif>
                    Kategori Laporan
                </a>

                <a href="{{ route('alur') }}"
                    class="elapor-nav-link {{ request()->routeIs('alur*') ? 'is-active' : '' }}"
                    @if (request()->routeIs('alur*')) aria-current="page" @endif>
                    Alur Penanganan
                </a>

                <a href="{{ route('faq') }}"
                    class="elapor-nav-link {{ request()->routeIs('faq*') ? 'is-active' : '' }}"
                    @if (request()->routeIs('faq*')) aria-current="page" @endif>
                    FAQ
                </a>
            </nav>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('lapor') }}" class="btn btn-sm btn-primary">
                    <i class="ki-duotone ki-pencil fs-5 me-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    Buat Laporan
                </a>
            </div>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header mobile-header">
        <div class="d-flex align-items-center">
            <span class="symbol symbol-35px symbol-circle bg-light-primary">
                <span class="symbol-label">
                    <img src="{{ asset('assets/media/logos/unuja.png') }}" alt="Logo" class="h-40px w-40px"
                        style="object-fit: contain;">
                </span>
            </span>

            <div class="ms-3">
                <div class="fw-bold" id="mobileMenuLabel">E-Lapor</div>
                <div class="text-muted fs-8">Universitas Nurul Jadid</div>
            </div>
        </div>

        <button type="button" class="btn btn-icon btn-sm btn-light mobile-close" data-bs-dismiss="offcanvas"
            aria-label="Tutup">
            <i class="ki-duotone ki-cross fs-2">
                <span class="path1"></span><span class="path2"></span>
            </i>
        </button>
    </div>

    <div class="offcanvas-body">
        <div class="d-grid gap-2">
            <a href="{{ route('beranda') }}"
                class="btn {{ request()->routeIs('beranda') ? 'btn-primary' : 'btn-light' }}">
                Beranda
            </a>

            <a href="{{ route('kategori') }}"
                class="btn {{ request()->routeIs('kategori*') ? 'btn-primary' : 'btn-light' }}">
                Kategori Laporan
            </a>

            <a href="{{ route('alur') }}" class="btn {{ request()->routeIs('alur*') ? 'btn-primary' : 'btn-light' }}">
                Alur Penanganan
            </a>

            <a href="{{ route('faq') }}" class="btn {{ request()->routeIs('faq*') ? 'btn-primary' : 'btn-light' }}">
                FAQ
            </a>

            <div class="separator my-4"></div>

            <a href="{{ route('lapor') }}" class="btn btn-primary">Buat Laporan</a>
        </div>
    </div>
</div>
