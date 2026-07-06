@extends('pages.app')

@section('css')
    <style>
        .select2-container {
            width: 100% !important;
        }

        @keyframes progress {
            0% {
                background-position: 1rem 0;
            }

            100% {
                background-position: 0 0;
            }
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endsection

@section('content')
    <section class="py-12 lg:py-20 relative overflow-hidden flex-1 bg-slate-50"
        style="background: linear-gradient(160deg, #f8fafc 0%, #f1f5f9 100%);">

        <div
            class="absolute top-0 -left-4 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-0 -right-4 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-96 h-96 bg-sky-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10 w-full">
            <div class="w-full">
                @php
                    $rejectionNote = $history->where('status', 'ditolak')->last()?->catatan;
                    $lastUpdate = $history->last()?->updated_at ?? $laporan?->updated_at;
                    $completionEvidence = null;
                    if ($laporan?->status === 'selesai') {
                        $completionEvidence =
                            $history->where('status', 'selesai')->last()?->historyLaporan?->lampiran_file ??
                            $laporan->historyLaporans->where('status', 'selesai')->sortByDesc('updated_at')->first()
                                ?->lampiran_file;
                    }
                @endphp


                <div
                    class="bg-white/70 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-white p-8 lg:p-14 mb-14 overflow-hidden relative group hover:bg-white/90 active:bg-white/90 transition-all duration-700 active:scale-[0.98]">
                    <div
                        class="absolute top-0 right-0 p-12 opacity-[0.02] pointer-events-none group-hover:scale-110 group-active:scale-110 group-hover:rotate-6 group-active:rotate-6 transition-all duration-700">
                        <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="max-w-3xl mx-auto text-center relative z-10">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold text-primary bg-primary/10 border border-primary/20 mb-6 uppercase tracking-widest shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Lacak Laporan
                        </span>
                        <h1 class="font-black text-slate-900 tracking-tight mb-5"
                            style="font-size: clamp(2.5rem, 5vw, 3.5rem); line-height: 1.1;">
                            Pantau status laporan <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-blue-500 to-indigo-600">dengan
                                mudah.</span>
                        </h1>
                        <p class="text-slate-500 text-lg max-w-xl mx-auto leading-relaxed">Lihat perkembangan, riwayat
                            penanganan, dan detail laporan Anda hanya dengan menggunakan kode tiket.</p>

                        <div class="mt-12 group/form relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-primary via-indigo-500 to-blue-600 rounded-[2rem] blur opacity-25 group-hover/form:opacity-50 transition duration-1000 group-hover/form:duration-200">
                            </div>
                            <form action="{{ route('lacak') }}" method="GET" id="track-form" class="relative">
                                <div
                                    class="relative flex flex-col sm:flex-row items-center p-2.5 rounded-3xl bg-white shadow-xl ring-1 ring-slate-100/50 transition-all duration-300 focus-within:ring-primary/30">
                                    <div class="flex items-center w-full pl-2">
                                        <div class="flex items-center justify-center w-12 h-12 shrink-0 text-primary">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <rect x="8" y="8" width="8" height="8" rx="1" />
                                                <line x1="3" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="13" x2="21" y2="13" />
                                                <line x1="11" y1="16" x2="11" y2="21" />
                                                <line x1="3" y1="8" x2="8" y2="8" />
                                            </svg>
                                        </div>
                                        <input id="track-kode-input" type="text" name="kode"
                                            value="{{ $kode }}"
                                            class="flex-1 w-full h-14 bg-transparent border-0 text-slate-900 font-bold uppercase tracking-widest text-sm focus:ring-0 placeholder:text-slate-400 placeholder:normal-case placeholder:font-normal placeholder:tracking-normal outline-none ml-2"
                                            autocomplete="off" placeholder="UNUJA-XXX-XXXXXXXX-XXXX" required>
                                    </div>
                                    <button type="submit"
                                        class="w-full sm:w-auto h-12 sm:h-14 mt-2 sm:mt-0 px-10 rounded-2xl bg-gradient-to-r from-primary to-blue-600 text-white font-bold text-sm shadow-lg shadow-primary/25 hover:shadow-xl active:shadow-xl hover:shadow-primary/40 active:shadow-primary/40 hover:-translate-y-0.5 active:-translate-y-0.5 transition-all inline-flex items-center justify-center gap-2 border-0 cursor-pointer group active:scale-[0.98]"
                                        id="track-submit-btn">
                                        <span class="indicator-label inline-flex items-center gap-2 whitespace-nowrap">
                                            Lacak Tiket
                                            <svg class="w-4 h-4 group-hover:translate-x-1 group-active:translate-x-1 transition-transform active:scale-[0.98]"
                                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </span>
                                        <span class="indicator-progress hidden items-center gap-2 whitespace-nowrap">
                                            <span
                                                class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($kode)
                    @if ($laporan)
                        <div class="space-y-5">
                            <div
                                class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-slate-100/50 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] active:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:-translate-y-1 active:-translate-y-1 hover:bg-white/95 active:bg-white/95 transition-all duration-500 p-8 lg:p-10 relative overflow-hidden active:scale-[0.98]">

                                <div class="absolute top-0 right-0 p-8 opacity-[0.03] pointer-events-none">
                                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 22h20L12 2z" />
                                    </svg>
                                </div>
                                <div class="grid lg:grid-cols-5 gap-8 relative z-10">
                                    <div class="lg:col-span-3">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 shadow-xl ring-4 ring-white shadow-slate-200 {{ $statusMeta['icon_bg'] ?? 'bg-primary/10' }}">
                                                <svg class="w-7 h-7 {{ $statusMeta['icon_color'] ?? 'text-primary' }}"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    @switch($statusMeta['icon'] ?? 'ki-information-5')
                                                        @case('ki-check-circle')
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        @break

                                                        @case('ki-cross-circle')
                                                            <circle cx="12" cy="12" r="10" />
                                                            <line x1="15" y1="9" x2="9" y2="15" />
                                                            <line x1="9" y1="9" x2="15" y2="15" />
                                                        @break

                                                        @case('ki-setting-2')
                                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                                                        @break

                                                        @default
                                                            <circle cx="12" cy="12" r="10" />
                                                            <line x1="12" y1="16" x2="12" y2="12" />
                                                            <line x1="12" y1="8" x2="12.01" y2="8" />
                                                        @break
                                                    @endswitch
                                                </svg>
                                            </div>
                                            <div>
                                                <div
                                                    class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                    Status Saat Ini</div>
                                                <div class="font-black text-slate-800 tracking-tight"
                                                    style="font-size: clamp(1.5rem, 2.8vw, 2.25rem); line-height: 1.1;">
                                                    {{ $statusMeta['title'] ?? '-' }}</div>
                                                <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                                                    {{ $statusMeta['summary'] ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-8">
                                            <div
                                                class="flex justify-between mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                <span>{{ $statusMeta['label'] ?? '' }}</span>
                                                <span class="text-primary">{{ $statusMeta['progress'] ?? 0 }}%
                                                    Selesai</span>
                                            </div>
                                            <div class="h-2.5 bg-slate-100/80 rounded-full overflow-hidden shadow-inner">
                                                <div class="h-full rounded-full bg-gradient-to-r from-primary to-blue-500 transition-all duration-1000 ease-out relative overflow-hidden"
                                                    style="width: {{ $statusMeta['progress'] ?? 0 }}%;">
                                                    <div
                                                        class="absolute inset-0 bg-[linear-gradient(45deg,rgba(255,255,255,0.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.15)_50%,rgba(255,255,255,0.15)_75%,transparent_75%,transparent)] bg-[length:1rem_1rem] animate-[progress_1s_linear_infinite]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lg:col-span-2 space-y-4">
                                        <div
                                            class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-slate-200 active:border-slate-200 transition-colors active:scale-[0.98]">
                                            <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">
                                                Kode
                                                Tiket</div>
                                            <div class="text-base font-bold text-slate-800 mt-1 uppercase tracking-wider">
                                                {{ $laporan->kode_tiket }}</div>
                                        </div>
                                        <div
                                            class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-slate-200 active:border-slate-200 transition-colors active:scale-[0.98]">
                                            <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">
                                                Judul
                                                Laporan</div>
                                            <div class="text-base font-bold text-slate-800 mt-1 line-clamp-2 leading-snug">
                                                {{ $laporan->judul_laporan }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if ($laporan->status === 'ditolak' && $rejectionNote)
                                    <div
                                        class="mt-6 p-5 rounded-2xl bg-red-50 border border-red-100 flex gap-4 items-start">
                                        <div
                                            class="w-10 h-10 rounded-full bg-red-100 text-red-500 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-[11px] font-bold uppercase tracking-widest text-red-500 mb-1">
                                                Catatan
                                                Penolakan</div>
                                            <div class="text-sm text-slate-700 leading-relaxed">{{ $rejectionNote }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="grid lg:grid-cols-2 gap-5">
                                <div
                                    class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-slate-100/50 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] active:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:-translate-y-1 active:-translate-y-1 hover:bg-white/95 active:bg-white/95 transition-all duration-500 p-8 lg:p-10 active:scale-[0.98]">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30 flex items-center justify-center shrink-0">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-lg m-0">Detail Laporan</h3>
                                            <p class="text-sm text-slate-500 m-0">Informasi utama laporan.</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Kategori</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                {{ $laporan->kategori?->nama_kategori ?? '-' }}</div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Unit
                                                Penangan</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                {{ $laporan->kategori?->unit?->nama_unit ?? '-' }}</div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Lokasi</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                @if ($laporan->ruangan)
                                                    {{ $laporan->ruangan->lantai->gedung->nama_gedung ?? '' }} -
                                                    {{ $laporan->ruangan->lantai->nama_lantai ?? '' }} -
                                                    {{ $laporan->ruangan->nama_ruangan }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Tanggal Kejadian</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                @if ($laporan->tgl_kejadian)
                                                    {{ $laporan->tgl_kejadian->locale('id')->translatedFormat('d M Y') }}
                                                    <span
                                                        class="text-slate-400 font-normal ml-1">{{ $laporan->tgl_kejadian->format('H:i') }}</span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="col-span-2 p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Deskripsi</div>
                                            <div class="text-sm text-slate-700 leading-relaxed">
                                                {{ $laporan->deskripsi_laporan ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-slate-100/50 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] active:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:-translate-y-1 active:-translate-y-1 hover:bg-white/95 active:bg-white/95 transition-all duration-500 p-8 lg:p-10 active:scale-[0.98]">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/30 flex items-center justify-center shrink-0">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-800 text-lg m-0">Informasi Pelapor</h3>
                                            <p class="text-sm text-slate-500 m-0">Data pengirim laporan.</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Nama
                                                Pelapor</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                {{ $laporan->nama_pelapor ?: 'Anonim' }}</div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Tipe
                                                Pelapor</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                {{ $laporan->tipe_pelapor ?: '-' }}</div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                Email</div>
                                            <div class="text-sm font-bold text-slate-800 break-all">
                                                {{ $laporan->email_pelapor ?: '-' }}</div>
                                        </div>
                                        <div
                                            class="p-4 rounded-2xl bg-white/60 border border-slate-100 hover:bg-white active:bg-white hover:border-blue-100 active:border-blue-100 hover:shadow-xl active:shadow-xl hover:shadow-blue-500/5 active:shadow-blue-500/5 hover:-translate-y-1 active:-translate-y-1 transition-all duration-300 active:scale-[0.98]">
                                            <div
                                                class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1">
                                                No.
                                                Telepon</div>
                                            <div class="text-sm font-bold text-slate-800">
                                                {{ $laporan->no_telp_pelapor ?: '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-slate-100/50 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] active:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:-translate-y-1 active:-translate-y-1 hover:bg-white/95 active:bg-white/95 transition-all duration-500 p-8 lg:p-12 active:scale-[0.98]">
                                <div class="flex items-end justify-between gap-4 mb-8">
                                    <div>
                                        <h3 class="font-bold text-slate-800 text-xl m-0 tracking-tight">Riwayat Penanganan
                                        </h3>
                                        <p class="text-sm text-slate-500 mt-1">Jejak aktivitas penanganan laporan Anda.</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-3.5 py-1.5 rounded-xl bg-slate-50 border border-slate-100 text-slate-600 text-[11px] font-bold tracking-widest uppercase">
                                        {{ $history->count() }} Aktivitas
                                    </span>
                                </div>

                                <div class="relative space-y-6 pl-8">
                                    <div class="absolute left-[15px] top-4 bottom-4 w-[2px] bg-slate-100">
                                    </div>
                                    @forelse ($history as $item)
                                        @php
                                            $itemStatus = $item->status ?? null;
                                            $itemEvidence =
                                                $itemStatus === 'selesai'
                                                    ? $item->historyLaporan?->lampiran_file
                                                    : null;
                                            $itemEvidenceUrl = $itemEvidence
                                                ? asset('uploads/history-laporan/' . $itemEvidence)
                                                : null;
                                            $itemMeta = match ($itemStatus) {
                                                'menunggu' => [
                                                    'bg' => 'bg-amber-100',
                                                    'text' => 'text-amber-600',
                                                    'badge' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'title' => 'Menunggu tindak lanjut',
                                                ],
                                                'diproses' => [
                                                    'bg' => 'bg-blue-100',
                                                    'text' => 'text-blue-600',
                                                    'badge' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                    'icon' =>
                                                        'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>',
                                                    'title' => 'Diproses unit terkait',
                                                ],
                                                'selesai' => [
                                                    'bg' => 'bg-emerald-100',
                                                    'text' => 'text-emerald-600',
                                                    'badge' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'title' => 'Laporan selesai',
                                                ],
                                                'ditolak' => [
                                                    'bg' => 'bg-red-100',
                                                    'text' => 'text-red-500',
                                                    'badge' => 'bg-red-50 text-red-500 border-red-100',
                                                    'icon' => 'M6 18L18 6M6 6l12 12',
                                                    'title' => 'Laporan ditolak',
                                                ],
                                                default => [
                                                    'bg' => 'bg-slate-200',
                                                    'text' => 'text-slate-600',
                                                    'badge' => 'bg-slate-100 text-slate-600 border-slate-200',
                                                    'icon' =>
                                                        'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'title' => 'Perubahan status',
                                                ],
                                            };
                                        @endphp
                                        <div class="relative">
                                            <div
                                                class="absolute -left-12 top-0.5 w-[32px] h-[32px] rounded-full flex items-center justify-center border-[3px] border-white shadow-sm z-10 {{ $itemMeta['bg'] }}">
                                                <svg class="w-3.5 h-3.5 {{ $itemMeta['text'] }}" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="{{ $itemMeta['icon'] }}" />
                                                </svg>
                                            </div>
                                            <div
                                                class="flex justify-between items-start gap-4 flex-wrap bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] active:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all active:scale-[0.98]">
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-bold text-slate-800 text-base mb-1">
                                                        {{ $itemMeta['title'] }}
                                                    </div>
                                                    <div class="text-sm text-slate-600 leading-relaxed mb-3">
                                                        {{ $item->catatan ?: $itemMeta['title'] }}</div>

                                                    <div class="flex items-center gap-3">
                                                        @if ($item->user)
                                                            <div
                                                                class="flex items-center gap-1.5 text-xs font-medium text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                                    </path>
                                                                </svg>
                                                                {{ $laporan->kategori?->unit?->nama_unit ?? 'Unit Terkait' }}
                                                            </div>
                                                        @else
                                                            <div
                                                                class="flex items-center gap-1.5 text-xs font-medium text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                    </path>
                                                                </svg>
                                                                Pelapor
                                                            </div>
                                                        @endif

                                                        @if ($itemEvidenceUrl)
                                                            <a href="{{ $itemEvidenceUrl }}" target="_blank"
                                                                class="inline-flex items-center gap-1.5 text-xs font-bold px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 active:bg-emerald-100 transition-all no-underline active:scale-[0.98]">
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                                    </path>
                                                                </svg>
                                                                Lihat Bukti
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="shrink-0 text-right flex flex-col items-end gap-2">
                                                    <span
                                                        class="inline-flex border text-[10px] font-bold px-2.5 py-1 rounded-lg {{ $itemMeta['badge'] }} uppercase tracking-widest">{{ $itemStatus ?: '-' }}</span>
                                                    <div class="text-[11px] font-medium text-slate-400">
                                                        @if ($item->created_at)
                                                            {{ $item->created_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                            <span class="mx-1">&bull;</span>
                                                            {{ $item->created_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="relative">
                                            <div
                                                class="absolute -left-12 top-0.5 w-[32px] h-[32px] rounded-full flex items-center justify-center border-[3px] border-white shadow-sm z-10 {{ $statusMeta['icon_bg'] ?? 'bg-blue-100' }}">
                                                <svg class="w-3.5 h-3.5 {{ $statusMeta['icon_color'] ?? 'text-blue-500' }}"
                                                    fill="none" stroke="currentColor" stroke-width="2.5"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <line x1="12" y1="16" x2="12" y2="12" />
                                                    <line x1="12" y1="8" x2="12.01" y2="8" />
                                                </svg>
                                            </div>
                                            <div
                                                class="flex justify-between items-start gap-4 flex-wrap bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)]">
                                                <div>
                                                    <div class="font-bold text-slate-800 text-base mb-1">
                                                        {{ $statusMeta['timeline_title'] ?? 'Status terkini' }}</div>
                                                    <div class="text-sm text-slate-500">
                                                        {{ $statusMeta['timeline_note'] ?? '' }}</div>
                                                </div>
                                                <div class="shrink-0 text-right flex flex-col items-end gap-2">
                                                    <span
                                                        class="inline-flex border border-{{ $statusMeta['badge_class'] ?? 'slate' }}-200 text-[10px] font-bold px-2.5 py-1 rounded-lg bg-{{ $statusMeta['badge_class'] ?? 'slate' }}-50 text-{{ $statusMeta['badge_class'] ?? 'slate' }}-600 uppercase tracking-widest">{{ $statusMeta['label'] ?? '-' }}</span>
                                                    <div class="text-[11px] font-medium text-slate-400">
                                                        @if ($laporan->updated_at)
                                                            {{ $laporan->updated_at->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                            <span class="mx-1">&bull;</span>
                                                            {{ $laporan->updated_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="bg-gradient-to-b from-red-50/50 to-white backdrop-blur-lg rounded-[2.5rem] border border-red-100/50 shadow-[0_8px_30px_rgb(239,68,68,0.04)] p-14 w-full text-center group hover:shadow-[0_20px_40px_rgb(239,68,68,0.08)] active:shadow-[0_20px_40px_rgb(239,68,68,0.08)] hover:-translate-y-1 active:-translate-y-1 transition-all duration-500 relative overflow-hidden mt-8 active:scale-[0.98]">
                            <div
                                class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] opacity-20 pointer-events-none">
                            </div>
                            <div
                                class="w-24 h-24 rounded-[2rem] bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-8 relative z-10 shadow-inner group-hover:scale-110 group-active:scale-110 group-hover:rotate-6 group-active:rotate-6 transition-all duration-500">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="font-black text-slate-800 text-3xl mb-4 tracking-tight relative z-10">Tiket tidak
                                ditemukan</h3>
                            <p class="text-slate-500 text-lg max-w-lg mx-auto mb-10 leading-relaxed relative z-10">Kode
                                <strong>{{ $kode }}</strong>
                                tidak terdaftar di sistem kami. Pastikan kode tiket yang Anda masukkan sudah benar.
                            </p>
                            <a href="{{ route('lapor') }}"
                                class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 active:bg-slate-800 shadow-xl shadow-slate-900/20 hover:shadow-slate-900/30 active:shadow-slate-900/30 hover:-translate-y-0.5 active:-translate-y-0.5 transition-all no-underline relative z-10 active:scale-[0.98]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Laporan Baru
                            </a>
                        </div>
                    @endif
                @else
                    <div class="grid lg:grid-cols-2 gap-8 mt-4">
                        <div
                            class="bg-white/80 backdrop-blur-lg rounded-[2.5rem] border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.06)] active:shadow-[0_20px_40px_rgb(0,0,0,0.06)] hover:-translate-y-1 active:-translate-y-1 transition-all duration-500 p-12 text-center flex flex-col justify-center items-center h-full group active:scale-[0.98]">
                            <div
                                class="w-28 h-28 rounded-full bg-blue-50/50 flex items-center justify-center mb-8 relative group-hover:scale-105 group-active:scale-105 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 border-2 border-dashed border-blue-200 rounded-full animate-[spin_10s_linear_infinite]">
                                </div>
                                <div
                                    class="w-20 h-20 rounded-full bg-white shadow-md flex items-center justify-center relative z-10">
                                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <circle cx="11" cy="11" r="8" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-black text-slate-800 text-3xl mb-4 tracking-tight">Siap Melacak Laporan</h3>
                            <p class="text-slate-500 text-lg max-w-sm mx-auto leading-relaxed">Masukkan kode tiket yang
                                Anda terima setelah membuat laporan untuk memantau status.</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-[2.5rem] p-12 text-white relative overflow-hidden shadow-xl shadow-slate-900/20 hover:-translate-y-1 active:-translate-y-1 transition-all duration-500 flex flex-col justify-center group active:scale-[0.98]">
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCI+PHBhdGggZD0iTTAgMGgyNHYyNEgwem0xMiAybTkgOW0tOS05bTkgOSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiIGZpbGw9Im5vbmUiLz48L3N2Zz4=')] opacity-20 group-hover:opacity-30 group-active:opacity-30 transition-opacity active:scale-[0.98]">
                            </div>
                            <div
                                class="absolute -bottom-24 -right-24 w-64 h-64 bg-slate-700/50 rounded-full blur-3xl pointer-events-none">
                            </div>
                            <div class="relative z-10">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-sm mb-6 shadow-inner">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-black text-white text-2xl mb-6 tracking-tight">Cara Kerja</h3>
                                <ul class="space-y-6">
                                    <li class="flex gap-4 items-start">
                                        <div
                                            class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center shrink-0 font-bold text-sm">
                                            1</div>
                                        <div>
                                            <strong class="block text-white mb-1">Dapatkan Kode</strong>
                                            <span class="text-white/80 text-sm leading-relaxed block">Kode tiket unik
                                                diberikan setiap kali Anda mengirimkan laporan.</span>
                                        </div>
                                    </li>
                                    <li class="flex gap-4 items-start">
                                        <div
                                            class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center shrink-0 font-bold text-sm">
                                            2</div>
                                        <div>
                                            <strong class="block text-white mb-1">Cek Secara Berkala</strong>
                                            <span class="text-white/80 text-sm leading-relaxed block">Gunakan halaman ini
                                                untuk memantau progres penanganan secara transparan.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var trackForm = document.getElementById('track-form');
            var submitButton = document.getElementById('track-submit-btn');
            var kodeInput = document.getElementById('track-kode-input');

            if (trackForm && submitButton) {
                trackForm.addEventListener('submit', function() {
                    submitButton.classList.add('is-loading');
                    submitButton.setAttribute('disabled', 'disabled');
                    submitButton.querySelector('.indicator-label').style.display = 'none';
                    submitButton.querySelector('.indicator-progress').style.display = 'inline-flex';
                });
            }
            if (kodeInput) {
                kodeInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase().replace(/\s+/g, '');
                });
            }
        });
    </script>
@endsection
