@extends('pages.app')

@section('content')
    <section class="relative overflow-hidden py-16 lg:py-20 flex-1"
        style="background: linear-gradient(160deg, #f0f7ff, #eff6ff 30%, #ffffff 70%, #f0f7ff);">
        <div class="hero-glow w-[500px] h-[500px] top-20 -left-40 opacity-10"
            style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
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
                                    class="absolute -left-10 top-0.5 w-8 h-8 rounded-full flex items-center justify-center border-2 border-white shadow-sm transition-transform duration-200 group-hover:scale-110 bg-gradient-to-br {{ $s['g'] }}">
                                    <span
                                        class="text-[11px] font-black text-white">{{ sprintf('%02d', $loop->iteration) }}</span>
                                </div>
                                <div
                                    class="bg-white rounded-2xl border border-slate-200 p-5 transition-all duration-200 group-hover:shadow-md">
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
