@extends('pages.app')

@php
    $akdSvgs = [
        'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
        'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
    ];
    $akdGrads = [['#f59e0b', '#f97316'], ['#3b82f6', '#6366f1'], ['#10b981', '#14b8a6'], ['#06b6d4', '#0ea5e9']];
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

@section('content')
    <section class="py-16 lg:py-20 relative overflow-hidden"
        style="background: linear-gradient(160deg, #eef6ff 0%, #f5f9ff 35%, #ffffff 65%, #f0f7ff 100%);">

        <div class="absolute -top-28 -left-28 w-[500px] h-[500px] rounded-full bg-blue-200/35 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/4 -right-32 w-[550px] h-[550px] rounded-full bg-indigo-200/25 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 left-1/4 w-[520px] h-[520px] rounded-full bg-sky-200/30 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 -right-24 w-[420px] h-[420px] rounded-full bg-emerald-100/35 blur-3xl pointer-events-none"></div>

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
            <path d="M0,460 C380,340 760,580 1140,440 C1280,390 1380,410 1440,450 L1440,860 C1080,960 680,740 280,860 C140,900 50,870 0,840 Z" fill="url(#katWaveMid)" />
            <path d="M0,920 C360,820 740,1040 1140,900 C1290,850 1380,880 1440,910 L1440,1200 L0,1200 Z" fill="url(#katWaveBot)" />
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-14">
                <h2 class="font-black text-primary-darker text-2xl lg:text-3xl">Kategori Laporan</h2>
                <p class="text-slate-500 mt-2">Pilih kategori yang sesuai agar laporan Anda cepat ditangani oleh unit
                    berwenang.</p>
            </div>

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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $akdSvgs[$i] }}" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $nonSvgs[$i] }}" />
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
@endsection
