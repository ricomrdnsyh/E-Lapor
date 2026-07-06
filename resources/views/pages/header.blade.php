<div class="relative z-50" style="background: linear-gradient(135deg, #1e40af, #1e3a5f);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-9">
        <span class="text-white/75 text-[11px] sm:text-xs font-medium tracking-wide">Kanal resmi pengaduan & aspirasi
            civitas akademika</span>
        <a href="{{ route('faq') }}"
            class="text-white/75 hover:text-white no-underline text-[11px] sm:text-xs font-medium transition-colors flex items-center gap-1.5">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
            </svg>
            FAQ
        </a>
    </div>
</div>

<header class="site-header sticky top-0 z-40 transition-all duration-300"
    style="background: rgba(255,255,255,0.88); backdrop-filter: blur(16px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <div class="flex items-center gap-3">
                <button id="mobileMenuToggle"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-primary-mist/50 transition-colors"
                    type="button" aria-label="Buka menu">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="{{ route('beranda') }}" class="flex items-center no-underline group py-1">
                    <img src="{{ asset('assets/media/logos/logo-elapor-dark.png') }}" alt="Logo E-Lapor"
                        class="h-10 lg:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                </a>
            </div>

            <nav class="hidden lg:flex items-center gap-1">
                @php $navs = [['route' => 'beranda', 'label' => 'Beranda'], ['route' => 'kategori*', 'label' => 'Kategori'], ['route' => 'alur*', 'label' => 'Alur'], ['route' => 'faq*', 'label' => 'FAQ'], ['route' => 'statistik*', 'label' => 'Statistik'], ['route' => 'lacak*', 'label' => 'Pelacakan']]; @endphp
                @foreach ($navs as $n)
                    @php $active = request()->routeIs($n['route']); @endphp
                    <a href="{{ route(str_replace('*', '', $n['route'])) }}"
                        class="relative px-3.5 py-2 rounded-xl text-sm font-semibold no-underline transition-all duration-200
                        {{ $active ? 'text-white' : 'text-slate-600 hover:text-primary hover:bg-primary-surface' }}"
                        @if ($active) aria-current="page" @endif>
                        @if ($active)
                            <span class="absolute inset-0 rounded-xl"
                                style="background: linear-gradient(135deg, #1e40af, #3b82f6);"></span>
                        @endif
                        <span class="relative z-10">{{ $n['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <a href="{{ route('lapor') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white font-bold text-sm no-underline shadow-lg transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5"
                style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan
            </a>
        </div>
    </div>
</header>

<div id="mobileMenu" class="offcanvas offcanvas-start w-[280px] sm:w-80 bg-white shadow-2xl z-50 border-none"
    tabindex="-1" aria-labelledby="mobileMenuLabel">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100"
        style="background: linear-gradient(135deg, #eff6ff, #ffffff);">
        <img src="{{ asset('assets/media/logos/logo-elapor-dark.png') }}" alt="Logo"
            class="h-8 lg:h-9 w-auto object-contain">
        <button id="mobileMenuClose" type="button"
            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100 transition-colors text-slate-500"
            aria-label="Tutup">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="p-4 overflow-y-auto">
        <div class="flex flex-col gap-1.5">
            @foreach ($navs as $n)
                @php $active = request()->routeIs($n['route']); @endphp
                <a href="{{ route(str_replace('*', '', $n['route'])) }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold no-underline transition-all
                    {{ $active ? 'text-white shadow-md' : 'text-slate-600 hover:bg-primary-surface hover:text-primary' }}"
                    style="{{ $active ? 'background: linear-gradient(135deg, #1e40af, #3b82f6);' : '' }}">
                    {{ $n['label'] }}
                </a>
            @endforeach
            <hr class="my-4 border-slate-100">
            <a href="{{ route('lapor') }}"
                class="flex items-center justify-center gap-2 px-4 py-3.5 rounded-xl text-white font-bold text-sm no-underline shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 mt-2"
                style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan
            </a>
        </div>
    </div>
</div>
