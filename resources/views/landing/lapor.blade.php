@extends('pages.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .select2-container {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            display: block !important;
        }

        .select2-container .select2-selection--single {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            height: 42px !important;
            display: flex !important;
            align-items: center !important;
            transition: all 0.3s;
            box-shadow: none !important;
            outline: none;
            position: relative !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow: hidden !important;
        }

        .select2-container .select2-selection--single:hover {
            border-color: #cbd5e1 !important;
        }

        .select2-container.select2-container--open .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 12px !important;
            top: 1px !important;
            position: absolute !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 20px !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            display: none !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow::after {
            content: "";
            display: block;
            width: 14px;
            height: 14px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
            background-size: cover;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            color: #334155 !important;
            font-weight: 400 !important;
            font-size: 0.875rem !important;
            padding-left: 0.875rem !important;
            padding-right: 3.5rem !important;
            flex: 1 !important;
            width: auto !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            display: block !important;
            line-height: normal !important;
            margin: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            margin-top: 4px !important;
            z-index: 9999 !important;
        }

        .select2-container .select2-results__option {
            padding: 0.6rem 1rem !important;
            font-size: 0.875rem !important;
            color: #475569 !important;
            transition: all 0.2s !important;
            white-space: normal !important;
            word-wrap: break-word !important;
        }

        .select2-container .select2-results__option--highlighted[aria-selected] {
            background-color: #f1f5f9 !important;
            color: #1e40af !important;
            font-weight: 600 !important;
        }

        .select2-container .select2-results__option[aria-selected=true] {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
            font-weight: 600 !important;
        }

        .select2-search--dropdown {
            padding: 0.5rem !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            margin-right: 0 !important;
            color: #94a3b8 !important;
            font-size: 1.5rem !important;
            position: absolute !important;
            right: 32px !important;
            top: 0 !important;
            z-index: 10 !important;
            background: transparent !important;
        }

        .select2-container .select2-selection--single .select2-selection__clear:hover {
            color: #ef4444 !important;
        }

        .required::after {
            content: " *";
            color: #ef4444;
        }
    </style>
@endsection

@section('content')
    <div class="flex-1" style="background: linear-gradient(160deg, #f0f7ff, #eff6ff 30%, #ffffff 70%, #f0f7ff);">
        <section class="py-12 lg:py-16 relative overflow-hidden">
            <div class="hero-glow w-[300px] h-[300px] -top-40 -right-20 opacity-20"
                style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
            <div class="hero-glow w-[200px] h-[200px] bottom-0 -left-20 opacity-10"
                style="background: radial-gradient(circle, #1e40af, transparent);"></div>
            <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary-surface border border-primary-mist text-primary text-xs font-bold uppercase mb-5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    E-LAPOR Universitas Nurul Jadid
                </span>
                <h1 class="font-black text-primary-darker mb-2" style="font-size:clamp(2rem,4vw,2.8rem);line-height:1.25;">
                    Sampaikan <span class="text-primary-light">Laporan Anda</span><br>Dengan Mudah
                </h1>
                <p class="text-slate-500 max-w-lg mx-auto text-center">Laporkan masalah atau aspirasi Anda melalui sistem
                    E-LAPOR.
                    Setelah terkirim, Anda akan mendapatkan kode tiket untuk melacak perkembangannya.</p>
            </div>
        </section>

        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-4" style="margin-top:-1.5rem;">



                @php
                    $ssoUser = session('sso_user');
                    $isAnonOld = old('is_anonymous') === 'y';
                @endphp

                @if ($ssoUser)
                    <div
                        class="flex items-center gap-2.5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm mb-5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <div><strong>Login via SSO UNUJA</strong> — Halo, <strong>{{ $ssoUser['nama'] }}</strong>! Data
                            identitas Anda sudah terisi otomatis dari SSO.</div>
                    </div>
                @endif

                <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data" id="form_laporan">
                    @csrf


                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-6 p-4 md:p-6 relative overflow-hidden">

                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-[#1F4788]/5 to-transparent rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-[#FFC107]/5 to-transparent rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none">
                        </div>

                        <div class="overflow-x-auto relative z-10 custom-scrollbar">
                            <div class="flex items-center justify-between min-w-[700px] gap-2 px-2">


                                <div class="flex items-center gap-2.5 group cursor-default">
                                    <div
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-[#1F4788] to-[#2a5ca8] text-white flex items-center justify-center font-bold text-sm shadow-md shadow-[#1F4788]/20 ring-4 ring-white transition-all duration-300 group-hover:scale-110 group-active:scale-110">
                                        1
                                    </div>
                                    <span
                                        class="text-sm font-bold text-slate-700 transition-colors duration-300 group-hover:text-[#1F4788] group-active:text-[#1F4788] active:scale-[0.98]">Kategori
                                        Laporan</span>
                                </div>


                                <div
                                    class="flex-1 h-[2px] bg-gradient-to-r from-slate-200 via-blue-100 to-slate-200 rounded-full mx-1">
                                </div>


                                <div class="flex items-center gap-2.5 group cursor-default">
                                    <div
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-[#1F4788] to-[#2a5ca8] text-white flex items-center justify-center font-bold text-sm shadow-md shadow-[#1F4788]/20 ring-4 ring-white transition-all duration-300 group-hover:scale-110 group-active:scale-110">
                                        2
                                    </div>
                                    <span
                                        class="text-sm font-bold text-slate-700 transition-colors duration-300 group-hover:text-[#1F4788] group-active:text-[#1F4788] active:scale-[0.98]">Lokasi</span>
                                </div>


                                <div
                                    class="flex-1 h-[2px] bg-gradient-to-r from-slate-200 via-blue-100 to-slate-200 rounded-full mx-1">
                                </div>


                                <div class="flex items-center gap-2.5 group cursor-default">
                                    <div
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-[#1F4788] to-[#2a5ca8] text-white flex items-center justify-center font-bold text-sm shadow-md shadow-[#1F4788]/20 ring-4 ring-white transition-all duration-300 group-hover:scale-110 group-active:scale-110">
                                        3
                                    </div>
                                    <span
                                        class="text-sm font-bold text-slate-700 transition-colors duration-300 group-hover:text-[#1F4788] group-active:text-[#1F4788] active:scale-[0.98]">Detail</span>
                                </div>


                                <div
                                    class="flex-1 h-[2px] bg-gradient-to-r from-slate-200 via-blue-100 to-slate-200 rounded-full mx-1">
                                </div>


                                <div class="flex items-center gap-2.5 group cursor-default">
                                    <div
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-[#1F4788] to-[#2a5ca8] text-white flex items-center justify-center font-bold text-sm shadow-md shadow-[#1F4788]/20 ring-4 ring-white transition-all duration-300 group-hover:scale-110 group-active:scale-110">
                                        4
                                    </div>
                                    <span
                                        class="text-sm font-bold text-slate-700 transition-colors duration-300 group-hover:text-[#1F4788] group-active:text-[#1F4788] active:scale-[0.98]">Pelapor</span>
                                </div>


                                <div
                                    class="flex-1 h-[2px] bg-gradient-to-r from-slate-200 via-blue-100 to-slate-200 rounded-full mx-1">
                                </div>


                                <div class="flex items-center gap-2.5 group cursor-default">
                                    <div
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-[#1F4788] to-[#2a5ca8] text-white flex items-center justify-center font-bold text-sm shadow-md shadow-[#1F4788]/20 ring-4 ring-white transition-all duration-300 group-hover:scale-110 group-active:scale-110">
                                        5
                                    </div>
                                    <span
                                        class="text-sm font-bold text-slate-700 transition-colors duration-300 group-hover:text-[#1F4788] group-active:text-[#1F4788] active:scale-[0.98]">Kirim</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-[#1F4788]/5 to-transparent border-b border-slate-100 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#1F4788]"></div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0 border border-slate-200 text-[#1F4788] relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#FFC107]"></div>
                                    <svg class="w-5 h-5 mb-0.5 relative z-10" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h6 class="font-bold text-slate-800 text-base m-0 tracking-tight">Kategori Laporan</h6>
                                <div class="ml-auto">
                                    <span
                                        class="flex items-center justify-center w-7 h-7 rounded-full bg-[#1F4788] text-white font-bold text-[11px] shadow-md shadow-[#1F4788]/20">
                                        1
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Unit
                                        Tujuan</label>
                                    <select id="unit_id" name="unit_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih Unit Tujuan" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Kategori
                                        Laporan</label>
                                    <select id="kategori_id" name="kategori_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih unit terlebih dahulu" required
                                        disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block">Sub Kategori</label>
                                    <select id="sub_kategori_id" name="sub_kategori_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih kategori terlebih dahulu" disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-[#1F4788]/5 to-transparent border-b border-slate-100 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#1F4788]"></div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0 border border-slate-200 text-[#1F4788] relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#FFC107]"></div>
                                    <svg class="w-5 h-5 mb-0.5 relative z-10" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h6 class="font-bold text-slate-800 text-base m-0 tracking-tight">Lokasi Kejadian</h6>
                                <div class="ml-auto">
                                    <span
                                        class="flex items-center justify-center w-7 h-7 rounded-full bg-[#1F4788] text-white font-bold text-[11px] shadow-md shadow-[#1F4788]/20">
                                        2
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Gedung</label>
                                    <select id="gedung_id" name="gedung_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih Gedung" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Lantai</label>
                                    <select id="lantai_id" name="lantai_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih gedung dulu" required disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="text-xs font-bold text-primary-dark mb-1.5 block required">Ruangan</label>
                                    <select id="ruangan_id" name="ruangan_id"
                                        class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        data-control="select2" data-placeholder="Pilih lantai dulu" required disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-[#1F4788]/5 to-transparent border-b border-slate-100 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#1F4788]"></div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0 border border-slate-200 text-[#1F4788] relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#FFC107]"></div>
                                    <svg class="w-5 h-5 mb-0.5 relative z-10" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h6 class="font-bold text-slate-800 text-base m-0 tracking-tight">Detail Laporan</h6>
                                <div class="ml-auto">
                                    <span
                                        class="flex items-center justify-center w-7 h-7 rounded-full bg-[#1F4788] text-white font-bold text-[11px] shadow-md shadow-[#1F4788]/20">
                                        3
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Judul
                                        Laporan</label>
                                    <input type="text" name="judul_laporan"
                                        class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        placeholder="Contoh: AC Ruang Lab 2 Gedung D tidak berfungsi"
                                        value="{{ old('judul_laporan') }}" required>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Tanggal &
                                        Waktu Kejadian</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-slate-200 bg-primary-surface text-primary">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                    ry="2" />
                                                <line x1="16" y1="2" x2="16" y2="6" />
                                                <line x1="8" y1="2" x2="8" y2="6" />
                                                <line x1="3" y1="10" x2="21" y2="10" />
                                            </svg>
                                        </span>
                                        <input type="text" id="tgl_kejadian" name="tgl_kejadian"
                                            class="flex-1 text-sm px-3.5 py-2.5 rounded-r-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                            placeholder="Pilih tanggal & waktu" value="{{ old('tgl_kejadian') }}" required
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Kronologi /
                                        Deskripsi</label>
                                    <textarea name="deskripsi_laporan" id="desc" rows="5"
                                        class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        placeholder="Tuliskan apa yang terjadi, kronologi, dampak, dan harapan..." required>{{ old('deskripsi_laporan') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block">Lampiran Bukti</label>
                                    <div id="upload_zone">
                                        <label for="lampiran_file"
                                            class="flex flex-col items-center justify-center w-full h-28 px-4 py-4 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/50 hover:bg-primary-surface active:bg-primary-surface hover:border-primary/50 active:border-primary/50 transition-all cursor-pointer group active:scale-[0.98]">
                                            <div
                                                class="w-10 h-10 rounded-full bg-white border border-slate-200 shadow-sm text-slate-400 group-hover:text-primary group-active:text-primary group-hover:border-primary/30 group-active:border-primary/30 flex items-center justify-center mb-2 group-hover:-translate-y-1 group-active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                            </div>
                                            <div
                                                class="text-sm font-bold text-slate-700 group-hover:text-primary group-active:text-primary transition-colors active:scale-[0.98]">
                                                Klik untuk unggah file</div>
                                            <div class="text-[11px] text-slate-400 font-medium mt-0.5">Format JPG, JPEG,
                                                PNG, PDF
                                                (Maks. 5MB)</div>
                                        </label>
                                    </div>
                                    <input type="file" name="lampiran_file" id="lampiran_file" class="hidden"
                                        accept=".jpg,.jpeg,.png,.pdf">

                                    <div id="file_preview"
                                        class="hidden items-center justify-between p-3 rounded-xl border border-primary/20 bg-primary-surface text-sm">
                                        <div class="flex items-center gap-3 overflow-hidden">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                            </div>
                                            <div class="truncate">
                                                <div id="file_name_text" class="font-bold text-primary-dark truncate">
                                                </div>
                                                <div id="file_size_text"
                                                    class="text-[11px] font-semibold text-primary/60"></div>
                                            </div>
                                        </div>
                                        <button type="button" id="btn_remove_file"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-red-500 active:text-red-500 hover:bg-white active:bg-white transition-colors shrink-0 active:scale-[0.98]"
                                            aria-label="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="file_error"
                                        class="text-red-500 text-xs mt-1.5 hidden font-medium flex items-center gap-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-[#1F4788]/5 to-transparent border-b border-slate-100 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#1F4788]"></div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0 border border-slate-200 text-[#1F4788] relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#FFC107]"></div>
                                    <svg class="w-5 h-5 mb-0.5 relative z-10" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h6 class="font-bold text-slate-800 text-base m-0 tracking-tight">Data Pelapor</h6>
                                <div class="ml-auto">
                                    <span
                                        class="flex items-center justify-center w-7 h-7 rounded-full bg-[#1F4788] text-white font-bold text-[11px] shadow-md shadow-[#1F4788]/20">
                                        4
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block">Privasi Laporan</label>
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <label
                                            class="flex-1 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer transition-all duration-150 has-checked:border-primary has-checked:bg-primary-surface {{ !$isAnonOld ? 'border-primary bg-primary-surface' : '' }}"
                                            id="pc-rahasia" onclick="setPrivacy('t')">
                                            <input type="radio" name="is_anonymous" value="t" class="hidden"
                                                {{ !$isAnonOld ? 'checked' : '' }}>
                                            <div class="flex items-center gap-1.5 font-bold text-primary-dark text-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <rect x="3" y="11" width="18" height="11" rx="2"
                                                        ry="2" />
                                                    <path d="M7 11V7a5 5 0 0110 0v4" />
                                                </svg>
                                                Rahasia
                                            </div>
                                            <div class="text-xs text-slate-500">Identitas hanya terlihat petugas berwenang
                                            </div>
                                        </label>
                                        <label
                                            class="flex-1 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white cursor-pointer transition-all duration-150 has-checked:border-primary has-checked:bg-primary-surface {{ $isAnonOld ? 'border-primary bg-primary-surface' : '' }}"
                                            id="pc-anonim" onclick="setPrivacy('y')">
                                            <input type="radio" name="is_anonymous" value="y" class="hidden"
                                                {{ $isAnonOld ? 'checked' : '' }}>
                                            <div class="flex items-center gap-1.5 font-bold text-primary-dark text-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                                    <circle cx="8.5" cy="7" r="4" />
                                                    <line x1="20" y1="8" x2="20" y2="14" />
                                                    <line x1="23" y1="11" x2="17" y2="11" />
                                                </svg>
                                                Anonim
                                            </div>
                                            <div class="text-xs text-slate-500">Tanpa identitas pelapor sama sekali</div>
                                        </label>
                                    </div>
                                </div>

                                <div id="anonEmailBlock" class="{{ $isAnonOld ? '' : 'hidden' }}">
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Email</label>
                                    <input type="email" id="email_anonim" name="email_anonim"
                                        class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        placeholder="nama@gmail.com" value="{{ old('email_anonim') }}"
                                        {{ $isAnonOld ? 'required' : '' }}>
                                    <div class="flex items-start gap-2 p-2.5 rounded-xl bg-primary-surface mt-2">
                                        <svg class="w-4 h-4 text-primary shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="text-xs text-slate-500">Alamat email Anda akan dirahasiakan dan hanya
                                            digunakan untuk mengirimkan notifikasi perkembangan laporan.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4 mt-4" id="identityBlock"
                                style="{{ $isAnonOld ? 'display:none;' : '' }}">
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Nama
                                            Pelapor</label>
                                        <input type="text" id="nama_pelapor" name="nama_pelapor"
                                            class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                            placeholder="Nama lengkap"
                                            value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['nama'] ?? old('nama_pelapor') }}"
                                            {{ $ssoUser ? 'readonly' : '' }} {{ $isAnonOld ? '' : 'required' }}>
                                    </div>
                                    <div>
                                        <label
                                            class="text-xs font-bold text-primary-dark mb-1.5 block required">Email</label>
                                        <input type="email" id="email_pelapor" name="email_pelapor"
                                            class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                            placeholder="nama@gmail.com"
                                            value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['email'] ?? old('email_pelapor') }}"
                                            {{ $ssoUser && !empty($ssoUser['email']) ? 'readonly' : '' }}
                                            {{ $isAnonOld ? '' : 'required' }}>
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-primary-dark mb-1.5 block">No. Telepon</label>
                                        <input type="text" id="no_telp_pelapor" name="no_telp_pelapor"
                                            class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                            placeholder="08xxxxxxxxxx"
                                            value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['no_telp'] ?? old('no_telp_pelapor') }}"
                                            {{ $ssoUser && !empty($ssoUser['no_telp']) ? 'readonly' : '' }}>
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Profesi /
                                            Tipe Pelapor</label>
                                        <select name="{{ $ssoUser ? '' : 'tipe_pelapor' }}" id="tipe_pelapor"
                                            class="w-full text-sm px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                            data-control="select2" data-placeholder="Pilih profesi"
                                            {{ $ssoUser ? 'disabled' : '' }}>
                                            <option value=""></option>
                                            @foreach (['Dosen', 'Mahasiswa', 'Tenaga Pendidik', 'Masyarakat/Umum'] as $t)
                                                <option value="{{ $t }}"
                                                    {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == $t ? 'selected' : '' }}>
                                                    {{ $t }}</option>
                                            @endforeach
                                        </select>
                                        @if ($ssoUser)
                                            <input type="hidden" name="tipe_pelapor" value="{{ $ssoUser['tipe'] }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-[#1F4788]/5 to-transparent border-b border-slate-100 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#1F4788]"></div>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0 border border-slate-200 text-[#1F4788] relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#FFC107]"></div>
                                    <svg class="w-5 h-5 mb-0.5 relative z-10" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h6 class="font-bold text-slate-800 text-base m-0 tracking-tight">Verifikasi & Kirim</h6>
                                <div class="ml-auto">
                                    <span
                                        class="flex items-center justify-center w-7 h-7 rounded-full bg-[#1F4788] text-white font-bold text-[11px] shadow-md shadow-[#1F4788]/20">
                                        5
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-bold text-primary-dark mb-1.5 block required">Verifikasi
                                        Captcha</label>
                                    <div class="flex items-center gap-2 mb-2">
                                        <div
                                            class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-primary-surface border border-dashed border-primary/30 min-w-[140px]">
                                            <span class="font-bold text-lg text-primary"
                                                id="captcha_question">Memuat...</span>
                                        </div>
                                        <button type="button" id="btn_refresh_captcha"
                                            class="w-9 h-9 rounded-xl bg-primary-surface flex items-center justify-center text-primary hover:bg-primary-mist active:bg-primary-mist transition-all active:scale-[0.98]"
                                            title="Refresh Captcha">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="number" name="captcha" id="captcha_answer"
                                        class="w-full max-w-[200px] text-sm px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                        placeholder="Masukkan jawaban" required>
                                </div>
                                <div>
                                    <label class="flex items-start gap-2.5 cursor-pointer">
                                        <input
                                            class="mt-0.5 w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary/30"
                                            type="checkbox" name="agreement" id="agreement" value="1" required>
                                        <span class="text-sm text-slate-500 font-medium">Saya menyatakan informasi yang
                                            saya kirimkan benar dan dapat dipertanggungjawabkan.</span>
                                    </label>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl bg-gradient-to-r from-primary to-primary-light text-white font-bold text-sm shadow-lg shadow-primary/25 hover:brightness-110 active:brightness-110 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-[0.98]"
                                        id="btn_submit">
                                        <span class="indicator-label inline-flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                            Kirim Laporan
                                        </span>
                                        <span class="indicator-progress hidden items-center gap-2">
                                            Mengirim... <span
                                                class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                        </span>
                                    </button>
                                    <div
                                        class="flex items-center justify-center flex-wrap gap-1.5 text-xs text-slate-400 mt-2">
                                        <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        <span class="text-center">Setelah terkirim, kamu akan mendapatkan <strong
                                                class="mx-1">Kode
                                                Tiket</strong> untuk pelacakan.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        (function() {

            var lampiranInput = document.getElementById('lampiran_file');
            var fileError = document.getElementById('file_error');
            var uploadZone = document.getElementById('upload_zone');
            var filePreview = document.getElementById('file_preview');
            var fileNameText = document.getElementById('file_name_text');
            var fileSizeText = document.getElementById('file_size_text');
            var btnRemoveFile = document.getElementById('btn_remove_file');
            var allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            var maxSize = 5 * 1024 * 1024;

            function formatBytes(bytes, decimals = 2) {
                if (!+bytes) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
            }

            if (lampiranInput) {
                lampiranInput.addEventListener('change', function() {
                    var file = this.files[0];
                    fileError.classList.add('hidden');
                    fileError.textContent = '';

                    if (!file) {
                        uploadZone.classList.remove('hidden');
                        filePreview.classList.add('hidden');
                        filePreview.classList.remove('flex');
                        return;
                    }
                    if (!allowedTypes.includes(file.type)) {
                        fileError.textContent = 'Format file tidak didukung. Gunakan JPG, PNG, atau PDF.';
                        fileError.classList.remove('hidden');
                        fileError.classList.add('flex');
                        this.value = '';
                        return;
                    }
                    if (file.size > maxSize) {
                        fileError.textContent = 'Ukuran file terlalu besar. Maksimal 5MB.';
                        fileError.classList.remove('hidden');
                        fileError.classList.add('flex');
                        this.value = '';
                        return;
                    }

                    // Success
                    fileNameText.textContent = file.name;
                    fileSizeText.textContent = formatBytes(file.size);
                    uploadZone.classList.add('hidden');
                    filePreview.classList.remove('hidden');
                    filePreview.classList.add('flex');
                });

                if (btnRemoveFile) {
                    btnRemoveFile.addEventListener('click', function() {
                        lampiranInput.value = '';
                        lampiranInput.dispatchEvent(new Event('change'));
                    });
                }
            }
        })();

        window.setPrivacy = function(val) {
            document.getElementById('pc-rahasia').classList.toggle('border-primary', val === 't');
            document.getElementById('pc-rahasia').classList.toggle('bg-primary-surface', val === 't');
            document.getElementById('pc-anonim').classList.toggle('border-primary', val === 'y');
            document.getElementById('pc-anonim').classList.toggle('bg-primary-surface', val === 'y');
            document.querySelectorAll('input[name="is_anonymous"]').forEach(function(r) {
                r.checked = r.value === val;
            });

            var identityBlock = document.getElementById('identityBlock');
            var anonEmailBlock = document.getElementById('anonEmailBlock');
            var namaPelapor = document.getElementById('nama_pelapor');
            var emailPelapor = document.getElementById('email_pelapor');
            var noTelp = document.getElementById('no_telp_pelapor');
            var tipePelapor = document.getElementById('tipe_pelapor');
            var emailAnonim = document.getElementById('email_anonim');
            var isAnon = (val === 'y');

            if (identityBlock) {
                identityBlock.classList.toggle('hidden', isAnon);
                identityBlock.style.display = ''; // Clear inline styles just in case
                identityBlock.querySelectorAll('input, select').forEach(function(inp) {
                    if (isAnon) inp.setAttribute('disabled', 'disabled');
                    else inp.removeAttribute('disabled');
                });
            }
            if (anonEmailBlock) {
                anonEmailBlock.classList.toggle('hidden', !isAnon);
                anonEmailBlock.style.display = ''; // Clear inline styles
                if (!isAnon && emailAnonim) emailAnonim.value = '';
            }
            if (isAnon) {
                if (namaPelapor) namaPelapor.value = 'Anonymous';
                if (emailPelapor) emailPelapor.value = 'Anonymous';
                if (noTelp) noTelp.value = 'Anonymous';
                if (tipePelapor) tipePelapor.value = '';
            } else {
                if (namaPelapor && namaPelapor.value === 'Anonymous') namaPelapor.value = '';
                if (emailPelapor && emailPelapor.value === 'Anonymous') emailPelapor.value = '';
                if (noTelp && noTelp.value === 'Anonymous') noTelp.value = '';
            }
            if (namaPelapor) isAnon ? namaPelapor.removeAttribute('required') : namaPelapor.setAttribute('required',
                'required');
            if (emailPelapor) isAnon ? emailPelapor.removeAttribute('required') : emailPelapor.setAttribute('required',
                'required');
            if (emailAnonim) isAnon ? emailAnonim.setAttribute('required', 'required') : emailAnonim.removeAttribute(
                'required');
        };

        document.addEventListener('DOMContentLoaded', function() {
            var unitSelect = document.getElementById('unit_id');
            var kategoriSelect = document.getElementById('kategori_id');
            var subKategoriSelect = document.getElementById('sub_kategori_id');
            var gedungSelect = document.getElementById('gedung_id');
            var lantaiSelect = document.getElementById('lantai_id');
            var ruanganSelect = document.getElementById('ruangan_id');
            var tglKejadianEl = document.getElementById('tgl_kejadian');
            var checkedPrivacy = document.querySelector('input[name="is_anonymous"]:checked');
            if (checkedPrivacy) window.setPrivacy(checkedPrivacy.value);

            if (typeof jQuery !== 'undefined') {
                jQuery('[data-control="select2"]').each(function() {
                    var el = jQuery(this);
                    el.select2({
                        width: '100%',
                        allowClear: true,
                        placeholder: el.attr('data-placeholder') || 'Pilih opsi'
                    });
                });
            }

            fetch('{{ route('lapor.units') }}').then(function(res) {
                return res.json();
            }).then(function(data) {
                data.forEach(function(unit) {
                    var opt = document.createElement('option');
                    opt.value = unit.id;
                    opt.textContent = unit.nama;
                    unitSelect.appendChild(opt);
                });
                jQuery(unitSelect).trigger('change');
            });

            jQuery(unitSelect).on('select2:select', function() {
                var id = this.value;
                kategoriSelect.innerHTML = '<option value=""></option>';
                jQuery(kategoriSelect).val(null).trigger('change');
                kategoriSelect.disabled = true;
                if (!id) return;
                fetch('{{ route('lapor.categories') }}?unit_id=' + id).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    data.forEach(function(cat) {
                        var opt = document.createElement('option');
                        opt.value = cat.id;
                        opt.textContent = cat.nama;
                        kategoriSelect.appendChild(opt);
                    });
                    kategoriSelect.disabled = false;
                    jQuery(kategoriSelect).prop('disabled', false).trigger('change');
                });
            });

            function resetSubKategori() {
                subKategoriSelect.innerHTML = '<option value=""></option>';
                subKategoriSelect.disabled = true;
                jQuery(subKategoriSelect).val(null).trigger('change');
            }
            jQuery(kategoriSelect).on('select2:select', function() {
                var id = this.value;
                resetSubKategori();
                if (!id) return;
                fetch('{{ route('lapor.subkategoris') }}?kategori_id=' + id).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    data.forEach(function(sub) {
                        var opt = document.createElement('option');
                        opt.value = sub.id;
                        opt.textContent = sub.nama;
                        subKategoriSelect.appendChild(opt);
                    });
                    subKategoriSelect.disabled = false;
                    jQuery(subKategoriSelect).prop('disabled', false).trigger('change');
                });
            });
            jQuery(kategoriSelect).on('select2:clear', resetSubKategori);
            jQuery(unitSelect).on('select2:clear', function() {
                kategoriSelect.innerHTML = '<option value=""></option>';
                kategoriSelect.disabled = true;
                jQuery(kategoriSelect).val(null).trigger('change');
                resetSubKategori();
            });

            fetch('{{ route('lapor.gedungs') }}').then(function(res) {
                return res.json();
            }).then(function(data) {
                data.forEach(function(gedung) {
                    var opt = document.createElement('option');
                    opt.value = gedung.id;
                    opt.textContent = gedung.nama;
                    gedungSelect.appendChild(opt);
                });
                jQuery(gedungSelect).trigger('change');
            });

            function resetLantai() {
                lantaiSelect.innerHTML = '<option value=""></option>';
                lantaiSelect.disabled = true;
                jQuery(lantaiSelect).val(null).trigger('change');
            }

            function resetRuangan() {
                ruanganSelect.innerHTML = '<option value=""></option>';
                ruanganSelect.disabled = true;
                jQuery(ruanganSelect).val(null).trigger('change');
            }
            jQuery(gedungSelect).on('select2:select', function() {
                var id = this.value;
                resetLantai();
                resetRuangan();
                if (!id) return;
                fetch('{{ route('lapor.lantai') }}?gedung_id=' + id).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    data.forEach(function(lantai) {
                        var opt = document.createElement('option');
                        opt.value = lantai.id;
                        opt.textContent = lantai.nama;
                        lantaiSelect.appendChild(opt);
                    });
                    lantaiSelect.disabled = false;
                    jQuery(lantaiSelect).prop('disabled', false).trigger('change');
                });
            });
            jQuery(gedungSelect).on('select2:clear', function() {
                resetLantai();
                resetRuangan();
            });
            jQuery(lantaiSelect).on('select2:select', function() {
                var id = this.value;
                resetRuangan();
                if (!id) return;
                fetch('{{ route('lapor.ruangan') }}?lantai_id=' + id).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    data.forEach(function(ruangan) {
                        var opt = document.createElement('option');
                        opt.value = ruangan.id;
                        opt.textContent = ruangan.nama + (ruangan.fungsi ? ' (' + ruangan
                            .fungsi + ')' : '');
                        ruanganSelect.appendChild(opt);
                    });
                    ruanganSelect.disabled = false;
                    jQuery(ruanganSelect).prop('disabled', false).trigger('change');
                });
            });
            jQuery(lantaiSelect).on('select2:clear', resetRuangan);

            if (tglKejadianEl && typeof flatpickr !== 'undefined') {
                flatpickr(tglKejadianEl, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: 'Y-m-d H:i',
                    allowInput: true
                });
            }

            function loadCaptcha() {
                fetch('{{ route('lapor.captcha') }}').then(function(res) {
                    return res.json();
                }).then(function(data) {
                    var el = document.getElementById('captcha_question');
                    if (el) el.textContent = data.question;
                    var inp = document.getElementById('captcha_answer');
                    if (inp) inp.value = '';
                }).catch(function() {
                    var el = document.getElementById('captcha_question');
                    if (el) el.textContent = 'Gagal memuat';
                });
            }

            var btnRefresh = document.getElementById('btn_refresh_captcha');
            if (btnRefresh) btnRefresh.addEventListener('click', loadCaptcha);
            loadCaptcha();

            var formLaporan = document.getElementById('form_laporan');
            if (formLaporan) {
                formLaporan.addEventListener('submit', function(e) {
                    e.preventDefault();
                    var captchaInput = document.getElementById('captcha_answer');
                    if (!captchaInput || !captchaInput.value.trim()) {
                        Swal.fire({
                            title: 'Captcha Belum Diisi',
                            text: 'Silakan jawab pertanyaan captcha terlebih dahulu.',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#2563eb'
                        });
                        return;
                    }
                    var fileError = document.getElementById('file_error');
                    if (fileError && !fileError.classList.contains('hidden')) {
                        Swal.fire({
                            title: 'File Tidak Valid',
                            text: fileError.textContent,
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#2563eb'
                        });
                        return;
                    }

                    var formData = new FormData(this);
                    var submitBtn = document.getElementById('btn_submit');
                    var indicatorLabel = submitBtn.querySelector('.indicator-label');
                    var indicatorProgress = submitBtn.querySelector('.indicator-progress');
                    submitBtn.disabled = true;
                    indicatorLabel.style.display = 'none';
                    indicatorProgress.style.display = 'inline-flex';

                    fetch('{{ route('lapor.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.content || ''
                        }
                    }).then(function(res) {
                        if (!res.ok) throw res;
                        return res.json();
                    }).then(function(data) {
                        submitBtn.disabled = false;
                        indicatorLabel.style.display = 'inline-flex';
                        indicatorProgress.style.display = 'none';
                        if (data.success) {
                            Swal.fire({
                                title: 'Laporan Berhasil Dibuat!',
                                html: `<div class="text-left">
                                        <p class="mb-2 font-semibold text-slate-700 text-center">Kode Tiket Anda:</p>
                                        <div class="bg-blue-50/50 border border-blue-100 p-3.5 rounded-xl mb-3">
                                            <h5 class="text-center font-bold text-2xl text-primary tracking-widest mb-0" style="user-select:all;cursor:pointer;" title="Klik untuk menyalin">` +
                                    data.kode_tiket + `</h5>
                                        </div>
                                        <div class="bg-amber-50/50 border border-amber-200 p-3.5 rounded-xl text-center mb-0">
                                            <span class="font-bold text-slate-800 block mb-1 text-sm"><i class="fas fa-exclamation-triangle text-amber-500 me-1"></i> Penting! Simpan Kode Tiket Ini</span>
                                            <span class="text-slate-600 text-xs">Harap <b>Catat</b>, <b>Salin</b>, atau <b>Cek Email</b> kode tiket di atas untuk melacak status laporan Anda.</span>
                                        </div>
                                    </div>`,
                                icon: 'success',
                                confirmButtonText: 'Lacak Sekarang',
                                confirmButtonColor: '#1F4788',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    const btn = Swal.getConfirmButton();
                                    if (btn) btn.innerHTML =
                                        '<i class="fas fa-search me-2"></i> Lacak Sekarang';
                                }
                            }).then(function(result) {
                                if (result.isConfirmed) window.location.href = data
                                    .redirect;
                            });
                        } else {
                            loadCaptcha();
                            Swal.fire({
                                title: 'Terjadi Kesalahan!',
                                text: data.message || 'Gagal membuat laporan.',
                                icon: 'error',
                                confirmButtonText: 'Coba Lagi',
                                confirmButtonColor: '#F64E60'
                            });
                        }
                    }).catch(async function(err) {
                        submitBtn.disabled = false;
                        indicatorLabel.style.display = 'inline-flex';
                        indicatorProgress.style.display = 'none';
                        loadCaptcha();
                        try {
                            var errData = await err.json();
                            var errors = errData.errors || {};
                            var messages = Object.values(errors).flat();
                            if (messages.length > 0) {
                                Swal.fire({
                                    title: 'Validasi Gagal!',
                                    html: `<ul class="pl-4 mb-0">${messages.map(m => `<li class="text-left text-slate-700 text-sm">${m}</li>`).join('')}</ul>`,
                                    icon: 'warning',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#1F4788'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Terjadi Kesalahan!',
                                    text: errData.message || 'Gagal membuat laporan.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi',
                                    confirmButtonColor: '#F64E60'
                                });
                            }
                        } catch (e) {
                            Swal.fire({
                                title: 'Terjadi Kesalahan!',
                                text: 'Kesalahan jaringan. Silakan coba lagi.',
                                icon: 'error',
                                confirmButtonText: 'Coba Lagi',
                                confirmButtonColor: '#F64E60'
                            });
                        }
                    });
                });
            }
        });
    </script>
@endsection
