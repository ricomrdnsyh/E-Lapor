@extends('pages.app')

@section('content')
    <section id="faq" class="py-10 py-lg-15 bg-light">
        <div class="container">
            <div class="text-center mb-8">
                <h2 class="fw-bold text-gray-900 mb-2">FAQ</h2>
                <div class="section-kicker text-muted mb-0">Pertanyaan yang sering ditanyakan</div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faq_accordion">

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_1_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_1">
                                    Siapa yang dapat melapor?
                                </button>
                            </h2>
                            <div id="faq_1" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Seluruh civitas akademika, tenaga kependidikan dan pegawai Universitas Nurul Jadid
                                    dengan perjanjian kerja di lingkungan Universitas Nurul Jadid yang memiliki informasi
                                    dan/atau akses informasi disertai dengan barang bukti atas dugaan terjadinya
                                    Pelanggaran.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_2_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_2">
                                    Apakah kerahasiaan identitas pelapor aman?
                                </button>
                            </h2>
                            <div id="faq_2" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Anda memiliki pilihan untuk melaporkan pengaduan tanpa mencantumkan nama atau informasi
                                    kontak pribadi (Anonim). UNUJA menjamin dan memastikan adanya perlindungan kerahasian
                                    pelapor yang menyampaikan laporan indikasi pelanggaran.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_3_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_3">
                                    Berapa lama laporan ditangani?
                                </button>
                            </h2>
                            <div id="faq_3" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Respon awal ditargetkan paling lambat 3 (tiga) hari kerja terhitung sejak pelaporan
                                    diterima. Durasi penyelesaian tergantung kategori & kompleksitas.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_4_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_4">
                                    Apa yang membuat laporan diproses lebih cepat?
                                </button>
                            </h2>
                            <div id="faq_4" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Pilih kategori tepat, isi kronologi singkat-jelas, sertakan lokasi/waktu, dan
                                    unggah bukti (foto/screenshot).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_5_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_5">
                                    Bagaimana cara saya memantau status laporan yang telah dikirim?
                                </button>
                            </h2>
                            <div id="faq_5" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Anda dapat memantau perkembangan laporan Anda secara real-time melalui fitur pelacakan
                                    kami dengan langkah-langkah berikut:
                                    <ul class="mt-3">
                                        <li>Masuk ke menu utama dan pilih halaman "Pelacakan".</li>
                                        <li>Masukkan nomor unik (Kode Tiket) yang Anda dapatkan sesaat setelah Anda berhasil
                                            mengirimkan laporan.</li>
                                        <li>Sistem akan menampilkan status terkini laporan Anda, mulai dari tahap verifikasi
                                            hingga tahap penyelesaian.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
