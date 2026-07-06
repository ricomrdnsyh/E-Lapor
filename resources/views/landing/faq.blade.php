@extends('pages.app')

@section('content')
    <div class="flex-1" style="background: linear-gradient(160deg, #f0f7ff, #eff6ff 30%, #ffffff 70%, #f0f7ff);">
        <section class="py-16 lg:py-28 relative overflow-hidden">

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
                            layanan E-Lapor? Temukan jawaban untuk pertanyaan yang paling sering diajukan oleh pengguna di
                            bawah ini.</p>

                        <div
                            class="hidden lg:flex flex-col gap-1 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full opacity-50">
                            </div>
                            <div
                                class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110">
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
                                class="inline-flex justify-center items-center px-5 py-2.5 bg-slate-800 text-white text-sm font-bold rounded-xl hover:bg-primary hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 relative z-10 w-fit">
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
                                class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden transition-all duration-300 hover:border-primary-light/50 hover:shadow-lg hover:shadow-primary/5">
                                <h3 class="m-0">
                                    <button
                                        class="accordion-btn cursor-pointer w-full flex items-center justify-between gap-4 p-5 lg:p-6 text-left transition-colors collapsed group focus:outline-none"
                                        type="button" data-target="faq{{ $i }}">
                                        <span
                                            class="font-bold text-slate-800 text-[15px] lg:text-base group-hover:text-primary transition-colors pr-4">{{ $faq['q'] }}</span>
                                        <span
                                            class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 text-slate-400 group-hover:bg-primary-surface group-hover:text-primary group-hover:border-primary-mist transition-all duration-300">
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
    </div>

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
                            var svg = b.querySelector('svg');
                            if (svg) svg.classList.remove('rotate-180');
                        }
                    });
                    if (!isHidden) {
                        target.classList.add('hidden');
                        this.classList.add('collapsed');
                        var svg = this.querySelector('svg');
                        if (svg) svg.classList.remove('rotate-180');
                    } else {
                        target.classList.remove('hidden');
                        this.classList.remove('collapsed');
                        var svg = this.querySelector('svg');
                        if (svg) svg.classList.add('rotate-180');
                    }
                });
            });
        });
    </script>
@endsection
