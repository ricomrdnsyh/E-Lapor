@extends('pages.app')

@section('content')

    <section class="relative overflow-hidden py-10 sm:py-16 lg:py-28 bg-slate-100">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{ asset('assets/media/gedung-unuja.png') }}" alt="Gedung Universitas Nurul Jadid"
                class="w-full h-full object-cover object-center scale-105 transition-transform duration-1000 ease-out"
                style="filter: contrast(1.05) saturate(1.1);" />

            <div class="absolute inset-0"
                style="background: linear-gradient(180deg, rgba(255, 255, 255, 0.42) 0%, rgba(255, 255, 255, 0.22) 48%, rgba(255, 255, 255, 0.48) 80%, #ffffff 100%);">
            </div>

            <div class="absolute inset-0 pointer-events-none"
                style="background: radial-gradient(ellipse 75% 52% at 50% 36%, rgba(255, 255, 255, 0.94) 0%, rgba(255, 255, 255, 0.65) 55%, transparent 100%);">
            </div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 sm:gap-2.5 p-1 pr-3 sm:p-1.5 sm:pr-4 rounded-full bg-white/90 backdrop-blur-md border border-white shadow-[0_4px_20px_rgba(15,23,42,0.07)] mb-5 sm:mb-7 animate-slide-up max-w-full">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 sm:px-3 sm:py-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-[10px] sm:text-[11px] font-extrabold tracking-wider uppercase shadow-xs shrink-0 whitespace-nowrap">
                        <span class="relative flex h-1.5 w-1.5 sm:h-2 sm:w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 sm:h-2 sm:w-2 bg-emerald-400"></span>
                        </span>
                        E-Lapor UNUJA
                    </span>
                    <span class="font-semibold text-blue-900 text-[11px] sm:text-xs tracking-wide truncate">
                        Kanal Resmi Pengaduan <span class="hidden sm:inline">& Aspirasi Civitas Akademika</span><span
                            class="sm:hidden">Civitas</span>
                    </span>
                </div>

                <h1 class="font-black text-primary-darker mb-4 sm:mb-5 animate-slide-up-delay-1 tracking-tight text-[1.55rem] min-[400px]:text-[1.75rem] sm:text-4xl lg:text-[3.35rem]"
                    style="line-height: 1.16;">
                    <span class="block" style="text-shadow: 0 2px 20px rgba(255,255,255,0.98);">Laporkan Masalah
                        Kampus</span>
                    <span class="relative inline-block mt-0.5 sm:mt-1">
                        <span
                            class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-indigo-600 to-blue-900"
                            style="filter: drop-shadow(0 2px 12px rgba(255,255,255,0.95));">Cepat,
                            Aman & Terpantau</span>
                    </span>
                </h1>

                <p class="text-slate-600 text-[13.5px] sm:text-[1.08rem] max-w-2xl mx-auto mb-6 sm:mb-9 px-1 sm:px-0 animate-slide-up-delay-2 leading-relaxed font-medium"
                    style="text-shadow: 0 1px 14px rgba(255,255,255,0.98), 0 0 6px rgba(255,255,255,0.95);">
                    <strong class="text-primary-darker font-extrabold">E-Lapor Universitas Nurul Jadid</strong> membantu
                    mahasiswa & civitas menyampaikan laporan <span class="text-slate-800 font-semibold">(fasilitas,
                        akademik, TIK, keamanan, maupun etik)</span> lengkap dengan bukti pendukung, lalu memantau
                    progresnya hingga tuntas.
                </p>

                <div class="flex flex-wrap gap-2.5 sm:gap-3.5 justify-center items-center animate-slide-up-delay-3">
                    <a href="{{ route('lapor') }}"
                        class="group inline-flex items-center justify-center gap-2.5 px-6 py-3.5 sm:px-8 sm:py-3.5 rounded-2xl bg-[#1e3a5f] hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-xl shadow-[#1e3a5f]/25 transition-all duration-300 hover:-translate-y-0.5 active:-translate-y-0.5 no-underline active:scale-[0.98]">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform duration-300 group-hover:rotate-90 shrink-0"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Laporan Sekarang
                    </a>

                    @if (isset($panduans) && $panduans->count() > 0)
                        <a href="{{ asset('storage/' . $panduans->first()->file) }}" target="_blank"
                            class="group inline-flex items-center justify-center gap-2 px-4 py-3.5 sm:px-7 sm:py-4 rounded-xl sm:rounded-2xl bg-white/90 backdrop-blur-md border border-white text-primary-darker font-bold text-xs sm:text-sm shadow-[0_8px_24px_rgba(15,23,42,0.1)] hover:bg-blue-700 hover:text-white hover:border-blue-700 transition-all duration-300 hover:-translate-y-0.5 no-underline active:scale-[0.98]">
                            <svg class="w-4 h-4 text-blue-700 group-hover:text-white transition-colors duration-300 shrink-0"
                                fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Panduan Sistem
                        </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 sm:gap-3.5 mt-7 sm:mt-11 max-w-3xl mx-auto animate-slide-up-delay-3">
                <div
                    class="group flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-3.5 p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/80 hover:bg-white/95 backdrop-blur-md border border-white/90 shadow-[0_8px_24px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-0.5 cursor-default">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg sm:rounded-xl bg-blue-50 text-blue-600 border border-blue-100/80 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0110 0v4" />
                        </svg>
                    </div>
                    <div>
                        <div
                            class="font-bold text-slate-800 text-[11px] sm:text-xs leading-tight group-hover:text-blue-600 transition-colors">
                            Privasi Terjamin</div>
                        <div
                            class="text-slate-500 text-[10px] sm:text-[11px] leading-tight mt-0.5 hidden min-[380px]:block">
                            Opsi anonim</div>
                    </div>
                </div>

                <div
                    class="group flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-3.5 p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/80 hover:bg-white/95 backdrop-blur-md border border-white/90 shadow-[0_8px_24px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-0.5 cursor-default">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg sm:rounded-xl bg-amber-50 text-amber-600 border border-amber-100/80 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <div
                            class="font-bold text-slate-800 text-[11px] sm:text-xs leading-tight group-hover:text-amber-600 transition-colors">
                            Notifikasi Aktif</div>
                        <div
                            class="text-slate-500 text-[10px] sm:text-[11px] leading-tight mt-0.5 hidden min-[380px]:block">
                            Via chat/email</div>
                    </div>
                </div>

                <div
                    class="group flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-3.5 p-2.5 sm:p-3.5 rounded-xl sm:rounded-2xl bg-white/80 hover:bg-white/95 backdrop-blur-md border border-white/90 shadow-[0_8px_24px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-0.5 cursor-default">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg sm:rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/80 flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div
                            class="font-bold text-slate-800 text-[11px] sm:text-xs leading-tight group-hover:text-emerald-600 transition-colors">
                            Proses Transparan</div>
                        <div
                            class="text-slate-500 text-[10px] sm:text-[11px] leading-tight mt-0.5 hidden min-[380px]:block">
                            Riwayat terekam</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-20 py-10 sm:py-14 lg:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div
                class="p-5 sm:p-7 lg:p-8 rounded-[2rem] bg-white border border-slate-200/90 shadow-[0_20px_55px_-15px_rgba(15,39,68,0.09)]">

                <div class="relative overflow-hidden rounded-2xl p-7 sm:p-9 flex flex-col items-center justify-center text-center shadow-md shadow-blue-900/15 group"
                    style="background: radial-gradient(circle at 88% 18%, rgba(59, 95, 209, 0.45) 0%, transparent 55%), radial-gradient(circle at 12% 85%, rgba(29, 78, 216, 0.35) 0%, transparent 55%), linear-gradient(135deg, #0f2744 0%, #1e3a5f 52%, #1d4ed8 100%);">

                    <svg class="absolute bottom-0 left-0 w-full h-24 sm:h-28 pointer-events-none" viewBox="0 0 800 120"
                        preserveAspectRatio="none">
                        <path d="M0,65 C220,115 520,10 800,70 L800,120 L0,120 Z" fill="rgba(255,255,255,0.07)"></path>
                        <path d="M0,85 C280,35 560,110 800,50 L800,120 L0,120 Z" fill="rgba(255,255,255,0.05)"></path>
                    </svg>

                    <svg class="absolute -right-4 -bottom-6 w-40 h-40 sm:w-48 sm:h-48 text-white/[0.07] -rotate-12 pointer-events-none transition-transform duration-500 group-hover:scale-105"
                        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>

                    <div class="relative z-10">
                        <span class="inline-block text-sky-100 font-bold text-xs sm:text-sm tracking-[0.15em] uppercase">
                            Jumlah Laporan Sekarang
                        </span>
                    </div>

                    <div class="relative z-10 my-3 sm:my-4">
                        <div class="counter-value font-black text-white tracking-tight leading-none drop-shadow-xs"
                            style="font-size: clamp(3.5rem, 6vw, 4.75rem);" data-target="{{ $totalLaporan }}">0
                        </div>
                    </div>

                    <div class="relative z-10 mt-1">
                        <a href="{{ route('statistik') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-white text-[#1e3a5f] hover:bg-blue-700 hover:text-white text-xs sm:text-[13px] font-extrabold transition-all duration-300 no-underline group/btn shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            Lihat Selengkapnya
                            <svg class="w-3.5 h-3.5 text-blue-700 group-hover/btn:text-white transition-all duration-300 group-hover/btn:translate-x-1"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="mt-7 sm:mt-8 pt-1">
                    <div class="flex items-center justify-center sm:justify-start gap-2.5 mb-5">
                        <span
                            class="hidden sm:inline-block w-1.5 h-6 rounded-full bg-gradient-to-b from-primary to-primary-light"></span>
                        <h3 class="font-black text-primary-darker text-xl sm:text-2xl tracking-tight">
                            Detail Laporan
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                        @foreach ([
            'menunggu' => [
                'label' => 'Menunggu',
                'surface' => 'from-amber-50/95 via-white to-amber-50/40 border-amber-200/80 hover:border-amber-300 shadow-amber-500/5',
                'icon_box' => 'bg-white border-amber-200/70 text-amber-500 shadow-amber-500/10',
                'label_color' => 'text-amber-600',
                'num_color' => 'text-amber-500',
                'watermark' => 'text-amber-500/[0.07]',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            'diproses' => [
                'label' => 'Diproses',
                'surface' => 'from-blue-50/95 via-white to-blue-50/40 border-blue-200/80 hover:border-blue-300 shadow-blue-500/5',
                'icon_box' => 'bg-white border-blue-200/70 text-blue-600 shadow-blue-500/10',
                'label_color' => 'text-blue-600',
                'num_color' => 'text-blue-600',
                'watermark' => 'text-blue-500/[0.07]',
                'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>',
            ],
            'selesai' => [
                'label' => 'Selesai',
                'surface' => 'from-emerald-50/95 via-white to-emerald-50/40 border-emerald-200/80 hover:border-emerald-300 shadow-emerald-500/5',
                'icon_box' => 'bg-white border-emerald-200/70 text-emerald-600 shadow-emerald-500/10',
                'label_color' => 'text-emerald-600',
                'num_color' => 'text-emerald-600',
                'watermark' => 'text-emerald-500/[0.07]',
                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            'ditolak' => [
                'label' => 'Ditolak',
                'surface' => 'from-rose-50/95 via-white to-rose-50/40 border-rose-200/80 hover:border-rose-300 shadow-rose-500/5',
                'icon_box' => 'bg-white border-rose-200/70 text-rose-500 shadow-rose-500/10',
                'label_color' => 'text-rose-600',
                'num_color' => 'text-rose-500',
                'watermark' => 'text-rose-500/[0.07]',
                'icon' => 'M6 18L18 6M6 6l12 12',
            ],
        ] as $key => $info)
                            <div
                                class="group relative overflow-hidden p-5 sm:p-6 rounded-2xl bg-gradient-to-br {{ $info['surface'] }} border shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <svg class="absolute -right-3 -bottom-3 w-20 h-20 {{ $info['watermark'] }} pointer-events-none transition-transform duration-300 group-hover:scale-110"
                                    fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{!! $info['icon'] !!}" />
                                </svg>

                                <div class="relative z-10 flex items-center gap-3 mb-4">
                                    <div
                                        class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl border shadow-xs {{ $info['icon_box'] }} flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                            stroke-width="2.2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{!! $info['icon'] !!}" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-xs sm:text-[13px] font-extrabold uppercase tracking-wider {{ $info['label_color'] }}">
                                        {{ $info['label'] }}
                                    </span>
                                </div>

                                <div class="relative z-10 flex items-baseline gap-1.5">
                                    <div class="counter-value font-black tracking-tight leading-none {{ $info['num_color'] }}"
                                        style="font-size: clamp(2.1rem, 3.2vw, 2.75rem);"
                                        data-target="{{ $stats[$key] ?? 0 }}">
                                        {{ $stats[$key] ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="relative overflow-hidden py-20 lg:py-28 border-y border-white/10"
        style="background: linear-gradient(160deg, #0f2744 0%, #163356 50%, #1e3a5f 100%);">

        <div class="absolute -top-32 -left-32 w-[520px] h-[520px] rounded-full pointer-events-none"
            style="background: radial-gradient(circle, rgba(37, 99, 235, 0.28) 0%, transparent 68%);"></div>
        <div class="absolute -bottom-40 -right-24 w-[600px] h-[600px] rounded-full pointer-events-none"
            style="background: radial-gradient(circle, rgba(6, 182, 212, 0.2) 0%, transparent 65%);"></div>
        <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[380px] h-[380px] rounded-full pointer-events-none"
            style="background: radial-gradient(circle, rgba(250, 204, 21, 0.08) 0%, transparent 65%);"></div>

        <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 600" fill="none"
            preserveAspectRatio="none">
            <path d="M-100,420 C320,560 720,260 1540,440 L1540,600 L-100,600 Z" fill="rgba(255, 255, 255, 0.025)" />
            <path d="M-100,490 C420,340 960,580 1540,390 L1540,600 L-100,600 Z" fill="rgba(56, 189, 248, 0.035)" />
            <path d="M-50,120 C400,280 900,-40 1490,180" stroke="rgba(255, 255, 255, 0.05)" stroke-width="1.5" />
            <path d="M-50,160 C420,320 920,0 1490,220" stroke="rgba(56, 189, 248, 0.06)" stroke-width="1" />
            <path d="M-50,460 C460,300 940,560 1490,360" stroke="rgba(255, 255, 255, 0.04)" stroke-width="1.5" />
            <circle cx="1360" cy="90" r="140" stroke="rgba(255, 255, 255, 0.04)" stroke-width="1.5" />
            <circle cx="1360" cy="90" r="200" stroke="rgba(255, 255, 255, 0.025)" stroke-width="1"
                stroke-dasharray="6 6" />
            <circle cx="80" cy="520" r="160" stroke="rgba(56, 189, 248, 0.05)" stroke-width="1.5" />
        </svg>

        <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-sky-300/25 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">

                <div class="lg:col-span-5 flex justify-center lg:justify-start">
                    <div class="relative">
                        <div
                            class="absolute inset-4 rounded-full bg-gradient-to-tr from-blue-500/25 via-cyan-400/15 to-yellow-400/15 blur-2xl pointer-events-none">
                        </div>
                        <img src="{{ asset('assets/media/illustrations/elapor-karakter.png') }}?v=3"
                            class="relative max-w-[300px] sm:max-w-[380px] lg:max-w-full h-auto animate-float drop-shadow-[0_20px_40px_rgba(7,18,36,0.4)]"
                            alt="Ilustrasi Karakter E-Lapor UNUJA" />
                    </div>
                </div>

                <div class="lg:col-span-7 text-center lg:text-left">
                    <h2 class="font-black text-white text-3xl lg:text-4xl mb-6 tracking-tight">
                        Apa Itu <span class="text-yellow-400">E-LAPOR </span>?
                    </h2>
                    <div class="space-y-4 text-white/75 text-base lg:text-lg leading-relaxed text-justify">
                        <p>
                            <span class="font-semibold text-white">E-Lapor</span> adalah kanal resmi pengaduan dan
                            aspirasi
                            di Universitas Nurul Jadid. Layanan ini dibuat agar setiap keluhan, temuan, atau masukan dari
                            civitas akademika atau masyarakat umum dapat disampaikan secara <span
                                class="font-semibold text-white">terstruktur</span>,
                            diproses oleh unit yang tepat, serta <span class="font-semibold text-white">terpantau</span>
                            hingga selesai.
                        </p>
                        <p>
                            Saat membuat laporan, pelapor dapat memilih kategori, menuliskan kronologi secara singkat-jelas,
                            mencantumkan lokasi dan waktu, serta melampirkan bukti (foto/screenshot/dokumen) bila
                            diperlukan.
                            Laporan diverifikasi terlebih dahulu, diteruskan ke unit terkait, dan status penanganannya
                            diperbarui sampai ditutup. Untuk menjaga kenyamanan, tersedia opsi
                            <span class="font-semibold text-white">anonim/rahasia</span> serta pembatasan akses petugas
                            sesuai kewenangan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 relative overflow-hidden"
        style="background: linear-gradient(160deg, #eef6ff 0%, #f5f9ff 35%, #ffffff 65%, #f0f7ff 100%);">

        <div
            class="absolute -top-28 -left-28 w-[500px] h-[500px] rounded-full bg-blue-200/35 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute top-1/4 -right-32 w-[550px] h-[550px] rounded-full bg-indigo-200/25 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-32 left-1/4 w-[520px] h-[520px] rounded-full bg-sky-200/30 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-10 -right-24 w-[420px] h-[420px] rounded-full bg-emerald-100/35 blur-3xl pointer-events-none">
        </div>

        <div class="absolute inset-0 pointer-events-none"
            style="background-image: radial-gradient(rgba(30, 58, 95, 0.065) 1px, transparent 1px); background-size: 28px 28px; -webkit-mask-image: radial-gradient(ellipse 85% 80% at 50% 50%, #000 30%, transparent 100%); mask-image: radial-gradient(ellipse 85% 80% at 50% 50%, #000 30%, transparent 100%);">
        </div>

        <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 1200" fill="none"
            preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="katWaveTop" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#dbeafe" stop-opacity="0.55" />
                    <stop offset="50%" stop-color="#e0e7ff" stop-opacity="0.30" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <linearGradient id="katWaveMid" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#e0f2fe" stop-opacity="0.45" />
                    <stop offset="60%" stop-color="#dbeafe" stop-opacity="0.20" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <linearGradient id="katWaveBot" x1="0%" y1="100%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#d1fae5" stop-opacity="0.35" />
                    <stop offset="50%" stop-color="#e0f2fe" stop-opacity="0.35" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path d="M0,0 L1440,0 L1440,340 C1120,420 820,210 460,310 C220,375 90,290 0,330 Z" fill="url(#katWaveTop)" />
            <path
                d="M0,460 C380,340 760,580 1140,440 C1280,390 1380,410 1440,450 L1440,860 C1080,960 680,740 280,860 C140,900 50,870 0,840 Z"
                fill="url(#katWaveMid)" />
            <path d="M0,920 C360,820 740,1040 1140,900 C1290,850 1380,880 1440,910 L1440,1200 L0,1200 Z"
                fill="url(#katWaveBot)" />
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-14">
                <h2 class="font-black text-primary-darker text-2xl lg:text-3xl">Kategori Laporan</h2>
                <p class="text-slate-500 mt-2">Pilih kategori yang sesuai agar laporan Anda cepat ditangani oleh unit
                    berwenang.</p>
            </div>

            @php
                $akdSvgs = [
                    'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                    'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
                ];
                $akdGrads = [
                    ['#f59e0b', '#f97316'],
                    ['#3b82f6', '#6366f1'],
                    ['#10b981', '#14b8a6'],
                    ['#06b6d4', '#0ea5e9'],
                ];
                $nonSvgs = [
                    'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                    'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                    'M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1zM4 22v-7m12-12v7',
                    'M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z',
                    'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z',
                    'M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z',
                    'M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11h4M10 15h4M10 19h4',
                    'M21 8V6a2 2 0 00-2-2H5a2 2 0 00-2 2v2m18 0v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8m18 0H3',
                ];
                $nonColors = [
                    ['#10b981', '#14b8a6'],
                    ['#06b6d4', '#0ea5e9'],
                    ['#f59e0b', '#f97316'],
                    ['#64748b', '#475569'],
                    ['#ef4444', '#f43f5e'],
                    ['#3b82f6', '#6366f1'],
                    ['#06b6d4', '#0ea5e9'],
                    ['#10b981', '#14b8a6'],
                    ['#ef4444', '#f43f5e'],
                    ['#f59e0b', '#f97316'],
                    ['#3b82f6', '#6366f1'],
                    ['#64748b', '#475569'],
                ];
                $nonBgs = [
                    'bg-emerald-50',
                    'bg-sky-50',
                    'bg-amber-50',
                    'bg-slate-100',
                    'bg-red-50',
                    'bg-blue-50',
                    'bg-sky-50',
                    'bg-emerald-50',
                    'bg-red-50',
                    'bg-amber-50',
                    'bg-blue-50',
                    'bg-slate-100',
                ];
                $nonTxt = [
                    'text-emerald-600',
                    'text-sky-600',
                    'text-amber-600',
                    'text-slate-600',
                    'text-red-500',
                    'text-blue-600',
                    'text-sky-600',
                    'text-emerald-600',
                    'text-red-500',
                    'text-amber-600',
                    'text-blue-600',
                    'text-slate-600',
                ];
            @endphp

            @if ($kategoriAkademikUnik->isNotEmpty())
                <div class="mb-12">
                    <div class="flex items-center gap-4 pb-6 border-b border-slate-200/60">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-xl tracking-tight">Bidang Akademik</h3>
                            <p class="text-slate-500 text-sm mt-1">Layanan pengaduan dan aspirasi bidang akademik</p>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-16">
                    @foreach ($kategoriAkademikUnik as $k)
                        @php $i = $loop->index % 4; @endphp
                        <a href="{{ route('lapor') }}" class="group block h-full no-underline">
                            <div
                                class="relative h-full bg-white rounded-[2rem] p-6 sm:p-7 transition-all duration-500 hover:-translate-y-2 active:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] active:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 overflow-hidden z-10 flex flex-col group-hover:border-transparent group-active:border-transparent active:scale-[0.98]">

                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 pointer-events-none -z-10 active:scale-[0.98]">
                                    <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full blur-[50px]"
                                        style="background-color: {{ $akdGrads[$i][0] }}30;"></div>
                                </div>

                                <div class="absolute top-0 left-0 right-0 h-1 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 active:scale-[0.98]"
                                    style="background: linear-gradient(to right, {{ $akdGrads[$i][0] }}, {{ $akdGrads[$i][1] }});">
                                </div>

                                <div class="flex items-start gap-4 mb-5">
                                    <div class="relative w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 transition-transform duration-500 group-hover:scale-110 group-active:scale-110 group-hover:-rotate-6 group-active:-rotate-6 shadow-sm"
                                        style="background: linear-gradient(135deg, {{ $akdGrads[$i][0] }}15, {{ $akdGrads[$i][1] }}20); color: {{ $akdGrads[$i][0] }};">
                                        <div
                                            class="absolute inset-0 rounded-2xl border border-white/60 bg-white/10 backdrop-blur-[2px]">
                                        </div>
                                        <svg class="relative w-8 h-8 z-10 drop-shadow-sm" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $akdSvgs[$i] }}" />
                                        </svg>
                                    </div>
                                    <div class="pt-1.5 flex-1">
                                        <h4
                                            class="font-extrabold text-slate-800 text-[1.1rem] leading-tight mb-1.5 group-hover:text-primary group-active:text-primary transition-colors duration-300 active:scale-[0.98]">
                                            {{ $k->nama_kategori }}</h4>
                                        <div class="inline-flex items-center text-[10px] font-bold uppercase tracking-widest opacity-0 -translate-x-4 group-hover:opacity-100 group-active:opacity-100 group-hover:translate-x-0 group-active:translate-x-0 transition-all duration-300 active:scale-[0.98]"
                                            style="color: {{ $akdGrads[$i][0] }};">
                                            Buat Laporan <span
                                                class="ml-1 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 delay-100 active:scale-[0.98]">&rarr;</span>
                                        </div>
                                    </div>
                                </div>

                                <p
                                    class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-2 transition-colors duration-300 group-hover:text-slate-600 group-active:text-slate-600 active:scale-[0.98]">
                                    Layanan
                                    pengaduan dan aspirasi terkait {{ strtolower($k->nama_kategori) }}.</p>

                                <div
                                    class="flex flex-wrap gap-2 mt-auto pt-5 border-t border-slate-100/80 transition-colors duration-300 group-hover:border-slate-200 group-active:border-slate-200 active:scale-[0.98]">
                                    @foreach ($unitAkademik as $u)
                                        <span
                                            class="inline-flex items-center text-[10px] font-bold px-3 py-1.5 rounded-xl bg-slate-50 text-slate-500 border border-slate-100 transition-all duration-300 group-hover:bg-white group-active:bg-white group-hover:shadow-sm group-active:shadow-sm group-hover:border-slate-200/60 group-active:border-slate-200/60 active:scale-[0.98]"
                                            style="group-hover:color: {{ $akdGrads[$i][0] }};">
                                            {{ $u->singkatan }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($kategoriNonAkademik->isNotEmpty())
                <div class="mb-12 mt-8">
                    <div class="flex items-center gap-4 pb-6 border-b border-slate-200/60">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13v9m4-9v9" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-xl tracking-tight">Bidang Non Akademik</h3>
                            <p class="text-slate-500 text-sm mt-1">Layanan pengaduan dan aspirasi bidang non akademik</p>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($kategoriNonAkademik as $k)
                        @php $i = $loop->index % 12; @endphp
                        <a href="{{ route('lapor') }}" class="group block h-full no-underline">
                            <div
                                class="relative h-full bg-white rounded-[2rem] p-6 sm:p-7 transition-all duration-500 hover:-translate-y-2 active:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] active:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 overflow-hidden z-10 flex flex-col group-hover:border-transparent group-active:border-transparent active:scale-[0.98]">

                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 pointer-events-none -z-10 active:scale-[0.98]">
                                    <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full blur-[50px]"
                                        style="background-color: {{ $nonColors[$i][0] }}30;"></div>
                                </div>

                                <div class="absolute top-0 left-0 right-0 h-1 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 active:scale-[0.98]"
                                    style="background: linear-gradient(to right, {{ $nonColors[$i][0] }}, {{ $nonColors[$i][1] }});">
                                </div>

                                <div class="flex items-start gap-4 mb-5">
                                    <div class="relative w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 transition-transform duration-500 group-hover:scale-110 group-active:scale-110 group-hover:-rotate-6 group-active:-rotate-6 shadow-sm"
                                        style="background: linear-gradient(135deg, {{ $nonColors[$i][0] }}15, {{ $nonColors[$i][1] }}20); color: {{ $nonColors[$i][0] }};">
                                        <div
                                            class="absolute inset-0 rounded-2xl border border-white/60 bg-white/10 backdrop-blur-[2px]">
                                        </div>
                                        <svg class="relative w-8 h-8 z-10 drop-shadow-sm" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $nonSvgs[$i] }}" />
                                        </svg>
                                    </div>
                                    <div class="pt-1.5 flex-1">
                                        <h4
                                            class="font-extrabold text-slate-800 text-[1.1rem] leading-tight mb-1.5 group-hover:text-primary group-active:text-primary transition-colors duration-300 active:scale-[0.98]">
                                            {{ $k->nama_kategori }}</h4>
                                        <div class="inline-flex items-center text-[10px] font-bold uppercase tracking-widest opacity-0 -translate-x-4 group-hover:opacity-100 group-active:opacity-100 group-hover:translate-x-0 group-active:translate-x-0 transition-all duration-300 active:scale-[0.98]"
                                            style="color: {{ $nonColors[$i][0] }};">
                                            Buat Laporan <span
                                                class="ml-1 opacity-0 group-hover:opacity-100 group-active:opacity-100 transition-opacity duration-500 delay-100 active:scale-[0.98]">&rarr;</span>
                                        </div>
                                    </div>
                                </div>

                                <p
                                    class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-2 transition-colors duration-300 group-hover:text-slate-600 group-active:text-slate-600 active:scale-[0.98]">
                                    Layanan
                                    pengaduan dan aspirasi terkait {{ strtolower($k->nama_kategori) }}.</p>

                                <div
                                    class="mt-auto pt-5 border-t border-slate-100/80 transition-colors duration-300 group-hover:border-slate-200 group-active:border-slate-200 active:scale-[0.98]">
                                    <span
                                        class="inline-flex items-center text-[10px] font-bold px-3 py-1.5 rounded-xl bg-slate-50 text-slate-500 border border-slate-100 transition-all duration-300 group-hover:bg-white group-active:bg-white group-hover:shadow-sm group-active:shadow-sm group-hover:border-slate-200/60 group-active:border-slate-200/60 active:scale-[0.98]"
                                        style="group-hover:color: {{ $nonColors[$i][0] }};">
                                        {{ $k->unit?->singkatan ?? ($k->unit?->nama_unit ?? '-') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 lg:py-24 relative overflow-hidden"
        style="background: linear-gradient(160deg, #0f2744, #1e3a5f);">

        <div class="absolute inset-0 opacity-[0.04]"
            style="background-image: radial-gradient(circle at 2px 2px, white 2px, transparent 0); background-size: 32px 32px;">
        </div>
        <div
            class="absolute w-[600px] h-[600px] -top-40 -left-40 bg-blue-500/30 rounded-full blur-[100px] opacity-40 pointer-events-none">
        </div>
        <div
            class="absolute w-[500px] h-[500px] -bottom-40 -right-20 bg-cyan-400/20 rounded-full blur-[100px] opacity-30 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-16 relative">
                <h2 class="font-black text-white text-2xl lg:text-3xl">Alur Penanganan Laporan</h2>
            </div>

            <div class="relative w-full mx-auto">
                <div class="hidden md:block absolute top-[2.5rem] left-[12.5%] right-[12.5%] h-[3px] bg-white/10 z-0">
                </div>
                <div
                    class="hidden md:block absolute top-[2.5rem] left-[12.5%] w-[25%] h-[3px] bg-gradient-to-r from-blue-500 to-white/10 z-0">
                </div>

                <?php
                $alurSteps = [
                    [
                        'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        'title' => 'Submit Laporan',
                        'desc' => 'Isi kategori, kronologi, lokasi, dan lampiran bukti pendukung.',
                    ],
                    [
                        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'title' => 'Verifikasi ULT',
                        'desc' => 'Validasi data & bukti. Penanganan maksimal <strong class="text-white">1×24 jam kerja</strong>.',
                    ],
                    [
                        'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>',
                        'title' => 'Diproses Unit Terkait',
                        'desc' => 'Ditindaklanjuti instansi. Proses maksimal <strong class="text-white">2×24 jam kerja</strong>.',
                    ],
                    [
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'title' => 'Selesai & Penutupan',
                        'desc' => 'Hasil dicatat dan pelapor menerima ringkasan penyelesaian.',
                    ],
                ];
                ?>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-4 relative z-10">
                    @foreach ($alurSteps as $index => $step)
                        <div class="flex flex-col items-center text-center relative group">
                            <div
                                class="w-20 h-20 rounded-full {{ $index === 0 ? 'bg-blue-500 text-white shadow-xl shadow-blue-500/40 ring-4 ring-blue-500/30' : 'bg-white/5 text-white/50 border-[3px] border-white/20 backdrop-blur-sm' }} flex items-center justify-center mb-6 shrink-0 z-10 transition-transform duration-300 group-hover:-translate-y-1 group-active:-translate-y-1 group-hover:scale-105 group-active:scale-105">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{!! $step['icon'] !!}">
                                    </path>
                                </svg>
                            </div>
                            <h4
                                class="font-bold text-white text-lg mb-3 transition-colors {{ $index === 0 ? 'text-blue-400' : 'group-hover:text-blue-300' }}">
                                {{ $step['title'] }}</h4>
                            <p class="text-white/60 text-sm leading-relaxed px-2 max-w-xs">{!! $step['desc'] !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-28 bg-slate-50/50 relative overflow-hidden">

        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100/40 rounded-full blur-[100px] opacity-60 pointer-events-none translate-x-1/3 -translate-y-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-amber-100/30 rounded-full blur-[80px] opacity-60 pointer-events-none -translate-x-1/3 translate-y-1/3">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-10 items-start">

                <div class="lg:col-span-4 lg:sticky lg:top-32 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-primary-surface border border-primary-mist text-primary text-xs font-bold uppercase tracking-widest mb-4">FAQ</span>
                    <h2 class="font-black text-slate-800 text-3xl lg:text-4xl mb-4 leading-tight">Pertanyaan Umum</h2>
                    <p class="text-slate-500 leading-relaxed mb-8 max-w-lg mx-auto lg:mx-0">Punya pertanyaan seputar
                        layanan E-Lapor? Temukan jawaban untuk pertanyaan yang paling sering diajukan oleh pengguna di bawah
                        ini.</p>

                    <div
                        class="hidden lg:flex flex-col gap-1 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full opacity-50">
                        </div>
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110 group-active:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg">Masih butuh bantuan?</h4>
                        <p class="text-sm text-slate-500 leading-relaxed mb-5 relative z-10">Jika jawaban yang Anda cari
                            tidak ada, silakan hubungi tim kami untuk bantuan lebih lanjut.</p>
                        <a href="#"
                            class="inline-flex justify-center items-center px-5 py-2.5 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-primary active:bg-primary hover:shadow-lg active:shadow-lg hover:shadow-primary/30 active:shadow-primary/30 transition-all duration-300 relative z-10 w-fit active:scale-[0.98]">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <?php $faqs = [
                        [
                            'q' => 'Siapa yang dapat melapor?',
                            'a' => 'Seluruh civitas akademika (Tenaga Kependidikan, Dosen, Mahasiswa) Universitas Nurul Jadid atau masyarakat umum yang memiliki informasi disertai dengan barang bukti atas dugaan terjadinya Pelanggaran.',
                        ],
                        [
                            'q' => 'Apakah kerahasiaan identitas pelapor aman?',
                            'a' => 'Anda memiliki pilihan untuk melaporkan pengaduan tanpa mencantumkan nama atau informasi kontak pribadi (Anonim). UNUJA menjamin dan memastikan adanya perlindungan kerahasian pelapor yang menyampaikan laporan indikasi pelanggaran.',
                        ],
                        [
                            'q' => 'Berapa lama laporan ditangani?',
                            'a' => 'Respon awal ditargetkan paling lambat 1 (satu) hari kerja terhitung sejak pelaporan diterima. Durasi penyelesaian tergantung kategori & kompleksitas.',
                        ],
                        [
                            'q' => 'Apa yang membuat laporan diproses lebih cepat?',
                            'a' => 'Pilih kategori tepat, isi kronologi singkat-jelas, sertakan lokasi/waktu, dan unggah bukti (foto/screenshot).',
                        ],
                        [
                            'q' => 'Bagaimana cara saya memantau status laporan yang telah dikirim?',
                            'a' => '<p class="mb-3">Anda dapat memantau perkembangan laporan Anda secara real-time melalui fitur pelacakan kami dengan langkah-langkah berikut:</p><ul class="list-disc ps-5 space-y-2"><li>Masuk ke menu utama dan pilih halaman <span class="font-bold">"Pelacakan"</span>.</li><li>Masukkan nomor unik (Kode Tiket) yang Anda dapatkan sesaat setelah Anda berhasil mengirimkan laporan atau cek email Anda.</li><li>Sistem akan menampilkan status terkini laporan Anda, mulai dari tahap verifikasi hingga tahap penyelesaian.</li></ul>',
                        ],
                    ]; ?>

                    @foreach ($faqs as $i => $faq)
                        <div
                            class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden transition-all duration-300 hover:border-primary-light/50 active:border-primary-light/50 hover:shadow-lg active:shadow-lg hover:shadow-primary/5 active:shadow-primary/5 active:scale-[0.98]">
                            <h3 class="m-0">
                                <button
                                    class="accordion-btn cursor-pointer w-full flex items-center justify-between gap-4 p-5 lg:p-6 text-left transition-colors collapsed group focus:outline-none"
                                    type="button" data-target="faq{{ $i }}">
                                    <span
                                        class="font-bold text-slate-800 text-[15px] lg:text-base group-hover:text-primary group-active:text-primary transition-colors pr-4 active:scale-[0.98]">{{ $faq['q'] }}</span>
                                    <span
                                        class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 text-slate-400 group-hover:bg-primary-surface group-active:bg-primary-surface group-hover:text-primary group-active:text-primary group-hover:border-primary-mist group-active:border-primary-mist transition-all duration-300 active:scale-[0.98]">
                                        <svg class="w-4 h-4 accordion-arrow transition-transform duration-300"
                                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div id="faq{{ $i }}" class="hidden">
                                <div
                                    class="px-5 pb-5 lg:px-6 lg:pb-6 text-slate-500 text-sm lg:text-[15px] leading-relaxed border-t border-slate-50 pt-4">
                                    {!! $faq['a'] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.accordion-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var target = document.getElementById(this.dataset.target);
                    if (!target) return;
                    var isHidden = target.classList.contains('hidden');
                    document.querySelectorAll('.accordion-btn').forEach(function(b) {
                        var t = document.getElementById(b.dataset.target);
                        if (t && t !== target) {
                            t.classList.add('hidden');
                            b.classList.add('collapsed');
                            b.querySelector('svg').classList.remove('rotate-180');
                        }
                    });
                    if (!isHidden) {
                        target.classList.add('hidden');
                        this.classList.add('collapsed');
                        this.querySelector('svg').classList.remove('rotate-180');
                    } else {
                        target.classList.remove('hidden');
                        this.classList.remove('collapsed');
                        this.querySelector('svg').classList.add('rotate-180');
                    }
                });
            });
        });
    </script>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function animateCounter(el, target, duration) {
                var start = 0;
                var startTime = performance.now();
                var formatter = new Intl.NumberFormat('id-ID');

                function update(currentTime) {
                    var elapsed = currentTime - startTime;
                    var progress = Math.min(elapsed / duration, 1);
                    var eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    el.textContent = formatter.format(Math.floor(eased * target));
                    if (progress < 1) requestAnimationFrame(update);
                }
                requestAnimationFrame(update);
            }

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var el = entry.target;
                        var target = parseInt(el.getAttribute('data-target'), 10) || 0;
                        animateCounter(el, target, 2000);
                        observer.unobserve(el);
                    }
                });
            }, {
                threshold: 0.3
            });

            document.querySelectorAll('.counter-value').forEach(function(el) {
                observer.observe(el);
            });
        });
    </script>
@endsection
