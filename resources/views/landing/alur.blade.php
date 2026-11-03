@extends('pages.app')

@section('content')
    <section class="relative overflow-hidden py-16 lg:py-20 flex-1"
        style="background: linear-gradient(160deg, #eef6ff 0%, #f5f9ff 35%, #ffffff 65%, #f0f7ff 100%);">

        <div class="absolute -top-28 -left-28 w-[500px] h-[500px] rounded-full bg-blue-200/35 blur-3xl pointer-events-none">
        </div>
        <div class="absolute top-1/4 -right-32 w-[550px] h-[550px] rounded-full bg-indigo-200/25 blur-3xl pointer-events-none">
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

        <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 1440 900" fill="none"
            preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="alurWaveTop" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#dbeafe" stop-opacity="0.55" />
                    <stop offset="50%" stop-color="#e0e7ff" stop-opacity="0.30" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <linearGradient id="alurWaveMid" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#e0f2fe" stop-opacity="0.45" />
                    <stop offset="60%" stop-color="#dbeafe" stop-opacity="0.20" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <linearGradient id="alurWaveBot" x1="0%" y1="100%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#d1fae5" stop-opacity="0.35" />
                    <stop offset="50%" stop-color="#e0f2fe" stop-opacity="0.35" />
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path d="M0,0 L1440,0 L1440,280 C1120,350 820,170 460,250 C220,305 90,230 0,265 Z" fill="url(#alurWaveTop)" />
            <path
                d="M0,360 C380,260 760,460 1140,340 C1280,300 1380,320 1440,350 L1440,660 C1080,740 680,560 280,660 C140,690 50,670 0,645 Z"
                fill="url(#alurWaveMid)" />
            <path d="M0,700 C360,620 740,800 1140,690 C1290,650 1380,675 1440,700 L1440,900 L0,900 Z"
                fill="url(#alurWaveBot)" />
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-12">
                <h2 class="font-black text-primary-darker text-2xl lg:text-3xl">Alur Penanganan</h2>
                <p class="text-slate-500 mt-2">Tahapan penanganan pengaduan dari awal masuk hingga selesai</p>
            </div>

            <div class="grid lg:grid-cols-5 gap-10 max-w-5xl mx-auto">
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur rounded-2xl border border-slate-200 p-6 lg:p-8 shadow-sm">
                        <div class="font-extrabold text-primary-darker text-xl mb-2">Ringkasan</div>
                        <p class="text-slate-500 text-sm leading-relaxed mb-5">
                            Setiap laporan diverifikasi, diteruskan ke unit terkait, dan diberi pembaruan status. Pelapor
                            bisa menambahkan komentar atau bukti tambahan jika dibutuhkan.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ([['Menunggu', '#f59e0b', 'bg-amber-50 text-amber-600'], ['Diverifikasi', '#3b82f6', 'bg-blue-50 text-blue-600'], ['Diproses', '#06b6d4', 'bg-cyan-50 text-cyan-600'], ['Selesai', '#10b981', 'bg-emerald-50 text-emerald-600'], ['Ditolak', '#ef4444', 'bg-red-50 text-red-500']] as $s)
                                <span
                                    class="text-[11px] font-bold px-3 py-1.5 rounded-full {{ $s[2] }}">{{ $s[0] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="relative pl-12">
                        <div
                            class="absolute left-[22px] top-3 bottom-3 w-1 rounded-full bg-gradient-to-b from-primary-light/30 via-primary-mist to-transparent">
                        </div>
                        @php
                            $alurSteps = [
                                [
                                    'g' => 'from-amber-400 to-orange-500',
                                    'title' => 'Submit Laporan',
                                    'badge' => 'Menunggu',
                                    'bc' => 'bg-amber-50 text-amber-600',
                                    'desc' => 'Isi kategori, kronologi, lokasi, dan lampiran bukti pendukung.',
                                ],
                                [
                                    'g' => 'from-blue-400 to-indigo-500',
                                    'title' => 'Verifikasi ULT',
                                    'badge' => 'Diverifikasi',
                                    'bc' => 'bg-blue-50 text-blue-600',
                                    'b2' => 'Ditolak',
                                    'b2c' => 'bg-red-50 text-red-500',
                                    'desc' =>
                                        'Validasi kelengkapan data & bukti. Jika tidak sesuai, laporan bisa ditolak. Penanganan akan dilakukan paling lambat <strong>1×24 jam kerja</strong>.',
                                ],
                                [
                                    'g' => 'from-cyan-400 to-cyan-600',
                                    'title' => 'Diproses Unit Terkait',
                                    'badge' => 'Diproses',
                                    'bc' => 'bg-cyan-50 text-cyan-600',
                                    'desc' =>
                                        'Ditindaklanjuti unit berwenang, termasuk klarifikasi bila diperlukan. Proses ini diselesaikan paling lambat <strong>2×24 jam kerja</strong>.',
                                ],
                                [
                                    'g' => 'from-emerald-400 to-emerald-600',
                                    'title' => 'Selesai & Penutupan',
                                    'badge' => 'Selesai',
                                    'bc' => 'bg-emerald-50 text-emerald-600',
                                    'desc' =>
                                        'Hasil dicatat, status ditutup, dan pelapor menerima ringkasan penyelesaian.',
                                ],
                            ];
                        @endphp
                        @foreach ($alurSteps as $s)
                            <div class="group relative pb-8">
                                <div
                                    class="absolute -left-10 top-0.5 w-8 h-8 rounded-full flex items-center justify-center border-2 border-white shadow-sm transition-transform duration-200 group-hover:scale-110 group-active:scale-110 bg-gradient-to-br {{ $s['g'] }}">
                                    <span
                                        class="text-[11px] font-black text-white">{{ sprintf('%02d', $loop->iteration) }}</span>
                                </div>
                                <div
                                    class="bg-white rounded-2xl border border-slate-200 p-5 transition-all duration-200 group-hover:shadow-md group-active:shadow-md active:scale-[0.98]">
                                    <div class="flex items-center flex-wrap gap-2 mb-1">
                                        <span class="font-extrabold text-primary-dark text-sm">{{ $s['title'] }}</span>
                                        <span
                                            class="text-[11px] font-bold px-2.5 py-0.5 rounded-full {{ $s['bc'] }}">{{ $s['badge'] }}</span>
                                        @if (!empty($s['b2']))
                                            <span
                                                class="text-[11px] font-bold px-2.5 py-0.5 rounded-full {{ $s['b2c'] }}">{{ $s['b2'] }}</span>
                                        @endif
                                    </div>
                                    <div class="text-slate-500 text-sm">{!! $s['desc'] !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
