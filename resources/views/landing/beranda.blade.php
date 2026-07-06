@extends('pages.app')

@section('content')

    <section class="relative overflow-hidden pt-16 pb-24 lg:pt-24 lg:pb-32"
        style="background: linear-gradient(160deg, #eff6ff 0%, #f0f7ff 35%, #ffffff 70%, #f0f7ff 100%);">
        <div class="hero-glow w-[600px] h-[600px] -top-40 -left-32 opacity-20"
            style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
        <div class="hero-glow w-[400px] h-[400px] -bottom-20 -right-20 opacity-15"
            style="background: radial-gradient(circle, #06b6d4, transparent);"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-7 text-center lg:text-left">
                    <div
                        class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white/80 backdrop-blur border border-slate-200/80 shadow-sm mb-7 animate-slide-up">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <span class="font-bold text-slate-700 text-xs tracking-wide">Kanal resmi pengaduan & aspirasi
                            civitas akademika</span>
                    </div>

                    <h1 class="font-extrabold text-slate-900 mb-5 animate-slide-up-delay-1 tracking-tight"
                        style="font-size: clamp(1.8rem, 3.8vw, 3rem); line-height: 1.15;">
                        Laporkan Masalah Kampus <br class="hidden sm:block">
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-primary to-cyan-500">Cepat,
                            Aman & Terpantau</span>
                    </h1>

                    <p
                        class="text-slate-500 text-[1.05rem] sm:text-lg max-w-xl mx-auto lg:mx-0 mb-9 animate-slide-up-delay-2 leading-relaxed">
                        <strong class="text-slate-700 font-bold">E-Lapor</strong> membantu mahasiswa & civitas menyampaikan
                        laporan (fasilitas, akademik, TIK, keamanan, etik) lengkap dengan bukti, lalu memantau statusnya
                        sampai selesai.
                    </p>

                    <div class="flex flex-wrap gap-3 justify-center lg:justify-start animate-slide-up-delay-3">
                        <a href="{{ route('lapor') }}"
                            class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl text-white font-bold text-sm shadow-xl transition-all duration-200 hover:shadow-2xl active:shadow-2xl hover:-translate-y-0.5 active:-translate-y-0.5 no-underline active:scale-[0.98]"
                            style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Laporan
                        </a>
                        @if (isset($panduans) && $panduans->count() > 0)
                            <a href="{{ asset('storage/' . $panduans->first()->file) }}" target="_blank"
                                class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl border-2 border-primary-light/30 text-primary font-bold text-sm hover:bg-primary active:bg-primary hover:text-white active:text-white transition-all no-underline active:scale-[0.98]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Panduan Sistem
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-10 animate-slide-up-delay-3 w-full">
                        <div
                            class="flex-1 group flex items-center gap-2.5 p-3.5 rounded-2xl bg-white/80 backdrop-blur-md border border-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg hover:bg-white active:bg-white cursor-default active:scale-[0.98]">
                            <div
                                class="w-9 h-9 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-active:scale-110 group-hover:rotate-3 group-active:rotate-3">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0110 0v4" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="font-bold text-slate-800 text-xs transition-colors group-hover:text-blue-600 group-active:text-blue-600 active:scale-[0.98]">
                                    Privasi Terjamin</div>
                                <div class="text-slate-500 text-[11px] leading-tight mt-0.5">Opsi pelaporan anonim</div>
                            </div>
                        </div>
                        <div
                            class="flex-1 group flex items-center gap-2.5 p-3.5 rounded-2xl bg-white/80 backdrop-blur-md border border-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg hover:bg-white active:bg-white cursor-default active:scale-[0.98]">
                            <div
                                class="w-9 h-9 shrink-0 rounded-xl bg-amber-50 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-active:scale-110 group-hover:-rotate-3 group-active:-rotate-3">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="font-bold text-slate-800 text-xs transition-colors group-hover:text-amber-600 group-active:text-amber-600 active:scale-[0.98]">
                                    Notifikasi Aktif</div>
                                <div class="text-slate-500 text-[11px] leading-tight mt-0.5">Update via chat/email</div>
                            </div>
                        </div>
                        <div
                            class="flex-1 group flex items-center gap-2.5 p-3.5 rounded-2xl bg-white/80 backdrop-blur-md border border-white/60 shadow-sm transition-all duration-300 hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg hover:bg-white active:bg-white cursor-default active:scale-[0.98]">
                            <div
                                class="w-9 h-9 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-active:scale-110 group-hover:rotate-3 group-active:rotate-3">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <div
                                    class="font-bold text-slate-800 text-xs transition-colors group-hover:text-emerald-600 group-active:text-emerald-600 active:scale-[0.98]">
                                    Proses Transparan</div>
                                <div class="text-slate-500 text-[11px] leading-tight mt-0.5">Riwayat laporan terekam</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 hidden lg:block animate-slide-up">
                    <div class="relative">
                        <div class="hero-glow w-[300px] h-[300px] -top-20 -right-20 opacity-30"
                            style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
                        <div
                            class="relative bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200 shadow-sm p-5 lg:p-6 transition-all duration-500 hover:-translate-y-1 active:-translate-y-1 hover:shadow-xl active:shadow-xl group/card active:scale-[0.98]">
                            <div
                                class="flex items-center justify-between gap-3 mb-5 pb-4 border-b border-slate-100 transition-colors duration-500 group-hover/card:border-slate-200">
                                <div>
                                    <h3
                                        class="font-bold text-slate-800 text-base tracking-tight transition-colors duration-300 group-hover/card:text-primary-dark">
                                        Cara Membuat Laporan</h3>
                                    <p class="text-slate-400 text-xs mt-0.5">4 langkah mudah</p>
                                </div>
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100 transition-all duration-500 group-hover/card:rotate-12 group-hover/card:bg-primary-surface group-hover/card:text-primary group-hover/card:border-primary-mist">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                            @php
                                $steps = [
                                    [
                                        'icon' =>
                                            'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                                        'bg' => 'bg-amber-50',
                                        'text' => 'text-amber-500',
                                        'hover_text' => 'group-hover:text-amber-600',
                                        'title' => 'Pilih kategori',
                                        'desc' => 'Agar laporan tepat sasaran.',
                                    ],
                                    [
                                        'icon' =>
                                            'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                                        'bg' => 'bg-blue-50',
                                        'text' => 'text-blue-500',
                                        'hover_text' => 'group-hover:text-blue-600',
                                        'title' => 'Tulis kronologi',
                                        'desc' => 'Deskripsikan secara jelas.',
                                    ],
                                    [
                                        'icon' =>
                                            'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                                        'bg' => 'bg-emerald-50',
                                        'text' => 'text-emerald-500',
                                        'hover_text' => 'group-hover:text-emerald-600',
                                        'title' => 'Upload bukti',
                                        'desc' => 'Foto atau dokumen valid.',
                                    ],
                                    [
                                        'icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8',
                                        'bg' => 'bg-indigo-50',
                                        'text' => 'text-indigo-500',
                                        'hover_text' => 'group-hover:text-indigo-600',
                                        'title' => 'Pantau laporan',
                                        'desc' => 'Dapatkan update progres.',
                                    ],
                                ];
                            @endphp
                            <div class="space-y-0">
                                @foreach ($steps as $i => $s)
                                    <div class="flex gap-4 group cursor-default">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110 group-active:scale-110 group-hover:shadow-sm group-active:shadow-sm {{ $s['bg'] }} {{ $s['text'] }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="{{ $s['icon'] }}" />
                                                </svg>
                                            </div>
                                            @if (!$loop->last)
                                                <div
                                                    class="w-px flex-1 bg-slate-100 my-1 transition-colors duration-500 group-hover/card:bg-slate-200/80">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pb-5 pt-0.5">
                                            <div
                                                class="font-bold text-slate-700 text-[13px] transition-colors duration-300 {{ $s['hover_text'] }}">
                                                {{ $s['title'] }}</div>
                                            <div class="text-slate-400 text-[11px] mt-0.5 leading-relaxed">
                                                {{ $s['desc'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden py-16 lg:py-24"
        style="background: linear-gradient(135deg, #0f2744, #1e3a5f, #1e40af);">
        <div class="absolute inset-0"
            style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M29.5 29.5h-5v1h5v5h1v-5h5v-1h-5v-5h-1v5z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E&quot;);">
        </div>
        <div class="hero-glow w-[500px] h-[500px] -top-32 -left-32 opacity-10"
            style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
        <div class="hero-glow w-[400px] h-[400px] -bottom-20 -right-20 opacity-10"
            style="background: radial-gradient(circle, #06b6d4, transparent);"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-white font-bold text-sm lg:text-2xl tracking-[0.15em] uppercase mb-4">Jumlah Laporan Sekarang
            </h2>
            <div class="counter-value font-bold text-white tracking-tight leading-none"
                style="font-size: clamp(4rem, 8vw, 6rem);" data-target="{{ $totalLaporan }}">0</div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-10">
                <h2 class="font-black text-primary-darker text-2xl lg:text-3xl">Detail Laporan</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-12">
                @foreach ([
            'menunggu' => ['Menunggu', '#f59e0b', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            'diproses' => ['Diproses', '#3b82f6', 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>'],
            'selesai' => ['Selesai', '#10b981', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            'ditolak' => ['Ditolak', '#ef4444', 'M6 18L18 6M6 6l12 12'],
        ] as $key => $info)
                    <div class="group relative overflow-hidden p-6 rounded-2xl border transition-all duration-300 hover:-translate-y-1 active:-translate-y-1 hover:shadow-xl active:shadow-xl active:scale-[0.98]"
                        style="border-color: {{ $info[1] }}20; background: linear-gradient(135deg, {{ $info[1] }}06, {{ $info[1] }}02);">
                        <div class="absolute top-0 right-0 w-24 h-24 -mt-8 -mr-8 rounded-full opacity-[0.06] group-hover:opacity-[0.10] group-active:opacity-[0.10] transition-opacity active:scale-[0.98]"
                            style="background: {{ $info[1] }};"></div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                style="background: {{ $info[1] }}12;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" style="color: {{ $info[1] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $info[2] }}" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider"
                                style="color: {{ $info[1] }};">{{ $info[0] }}</span>
                        </div>
                        <div class="font-black tracking-tight"
                            style="font-size: clamp(2rem, 3vw, 2.8rem); line-height: 1; color: {{ $info[1] }};">
                            {{ $stats[$key] ?? 0 }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('statistik') }}"
                    class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl font-bold text-sm border-2 border-blue-400 text-blue-500 bg-transparent transition-all duration-300 hover:bg-blue-500 active:bg-blue-500 hover:border-blue-500 active:border-blue-500 hover:text-white active:text-white hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg no-underline group active:scale-[0.98]">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 group-active:translate-x-1 active:scale-[0.98]" fill="none"
                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden py-20 lg:py-28"
        style="background: linear-gradient(160deg, #0f2744, #1e3a5f);">
        <div class="hero-glow w-[700px] h-[700px] -top-40 -right-40 opacity-[0.08]"
            style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 flex justify-center lg:justify-start">
                    <div class="relative">
                        <div
                            class="absolute inset-0 rounded-3xl bg-gradient-to-br from-primary-light/20 to-accent/20 blur-2xl">
                        </div>
                        <img src="{{ asset('assets/media/illustrations/sigma-1/21.png') }}"
                            class="relative max-w-[280px] sm:max-w-[340px] lg:max-w-full h-auto animate-float"
                            alt="Ilustrasi E-Lapor" />
                    </div>
                </div>
                <div class="lg:col-span-7 text-center lg:text-left">
                    <h2 class="font-black text-white text-3xl lg:text-4xl mb-6 tracking-tight">Apa Itu <span
                            class="text-yellow-400"">E-LAPOR</span>?</h2>
                    <div class="space-y-4 text-white/60 text-base lg:text-lg leading-relaxed text-justify">
                        <p>
                            <span class="font-semibold text-white/90">E-Lapor</span> adalah kanal resmi pengaduan dan
                            aspirasi
                            di Universitas Nurul Jadid. Layanan ini dibuat agar setiap keluhan, temuan, atau masukan dari
                            civitas akademika atau masyarakat umum dapat disampaikan secara <span
                                class="font-semibold text-white/90">terstruktur</span>,
                            diproses oleh unit yang tepat, serta <span class="font-semibold text-white/90">terpantau</span>
                            hingga selesai.
                        </p>
                        <p>
                            Saat membuat laporan, pelapor dapat memilih kategori, menuliskan kronologi secara singkat-jelas,
                            mencantumkan lokasi dan waktu, serta melampirkan bukti (foto/screenshot/dokumen) bila
                            diperlukan.
                            Laporan diverifikasi terlebih dahulu, diteruskan ke unit terkait, dan status penanganannya
                            diperbarui sampai ditutup. Untuk menjaga kenyamanan, tersedia opsi
                            <span class="font-semibold text-white/90">anonim/rahasia</span> serta pembatasan akses petugas
                            sesuai kewenangan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20"
        style="background: linear-gradient(160deg, #f0f7ff, #eff6ff 40%, #ffffff 70%, #f0f7ff);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
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
