@extends('pages.app')

@section('css')
    <style>
        @media (min-width: 992px) {
            .text-justify-lg {
                text-align: justify;
                text-justify: inter-word;
            }
        }

        .about-illustration {
            width: 100%;
            height: auto;
            max-width: 280px;
        }

        @media (min-width: 576px) {
            .about-illustration {
                max-width: 340px;
            }
        }

        @media (min-width: 992px) {
            .about-illustration {
                max-width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <!-- HERO -->
    <section id="home" class="elapor-hero py-10 py-lg-15">
        <div class="container">
            <div class="row align-items-center gy-10">

                <div class="col-lg-7">
                    <div class="hero-badge d-inline-flex align-items-center gap-2 mb-6">
                        <i class="ki-duotone ki-shield-tick fs-4 text-success"><span class="path1"></span><span
                                class="path2"></span></i>
                        <span class="fw-semibold text-gray-800">Kanal resmi pengaduan & aspirasi civitas
                            akademika</span>
                    </div>

                    <h1 class="fw-bold text-gray-900 mb-5" style="letter-spacing:-0.03em; font-size: 2.7rem;">
                        Laporkan Masalah Kampus<br class="d-none d-lg-block">
                        <span class="text-primary">Cepat</span>, <span class="text-success">Aman</span>, dan
                        <span class="text-warning">Terpantau</span>
                    </h1>

                    <p class="text-muted fs-5 mb-7">
                        E-Lapor membantu mahasiswa & civitas menyampaikan laporan (fasilitas, akademik, TIK,
                        keamanan, etik) lengkap dengan bukti,
                        lalu memantau statusnya sampai selesai.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('lapor') }}" class="btn btn-primary btn-lg">
                            <i class="ki-duotone ki-pencil fs-4 me-2"><span class="path1"></span><span
                                    class="path2"></span></i>
                            Buat Laporan
                        </a>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-8">
                        <div class="stat-pill d-flex align-items-center gap-3">
                            <span class="symbol symbol-35px symbol-circle bg-light-primary">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-lock fs-3 text-primary"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Privasi</div>
                                <div class="text-muted fs-8">Opsi rahasia/anonim*</div>
                            </div>
                        </div>

                        <div class="stat-pill d-flex align-items-center gap-3">
                            <span class="symbol symbol-35px symbol-circle bg-light-warning">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-notification-bing fs-3 text-warning"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span></i>
                                </span>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Notifikasi</div>
                                <div class="text-muted fs-8">Update via Email</div>
                            </div>
                        </div>

                        <div class="stat-pill d-flex align-items-center gap-3">
                            <span class="symbol symbol-35px symbol-circle bg-light-success">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-timer fs-3 text-success"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                            </span>
                            <div>
                                <div class="fw-bold text-gray-900">Transparan</div>
                                <div class="text-muted fs-8">Riwayat proses terekam</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm bg-white bg-opacity-75 mb-6">
                        <div class="card-body p-7 p-lg-9">

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-6">
                                <div>
                                    <div class="fw-bold text-gray-900 fs-3 mb-1">Cara Cepat Membuat Laporan</div>
                                    <div class="text-gray-600">Ikuti 4 langkah agar laporan cepat diproses</div>
                                </div>
                                <span class="badge badge-light-primary d-inline-flex align-items-center">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    Panduan
                                </span>
                            </div>

                            <div class="timeline-label">

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">01</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-category fs-2 text-primary">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Pilih kategori</span>
                                            <span class="badge badge-light-primary fs-8 px-3 py-2">Diterima</span>
                                        </div>
                                        <div class="text-gray-600">Agar langsung ke unit yang tepat.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">02</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-notepad-edit fs-2 text-warning">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Tulis kronologi</span>
                                            <span class="badge badge-light-warning fs-8 px-3 py-2">Diverifikasi</span>
                                        </div>
                                        <div class="text-gray-600">Apa, kapan, di mana, dampak, dan harapan.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">03</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-file-added fs-2 text-info">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Upload bukti</span>
                                            <span class="badge badge-light-info fs-8 px-3 py-2">Diproses</span>
                                        </div>
                                        <div class="text-gray-600">Foto/screenshot/PDF (opsional tapi disarankan).</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">04</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-send fs-2 text-success">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Kirim & dapatkan kode tiket</span>
                                            <span class="badge badge-light-success fs-8 px-3 py-2">Selesai</span>
                                        </div>
                                        <div class="text-gray-600">Pantau progres dari menu Lacak.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="about" class="py-10 py-lg-15 bg-primary position-relative overflow-hidden">
        <span class="position-absolute top-0 end-0 translate-middle opacity-10"
            style="width:520px;height:520px;border-radius:50%;
        background:radial-gradient(circle, rgba(255,255,255,.28), rgba(255,255,255,0));"></span>

        <span class="position-absolute bottom-0 start-0 translate-middle opacity-10"
            style="width:640px;height:640px;border-radius:50%;
        background:radial-gradient(circle, rgba(255,255,255,.22), rgba(255,255,255,0));"></span>

        <div class="container position-relative">
            <div class="row align-items-center gy-10 gy-lg-0">

                <div
                    class="col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start text-center text-lg-start">
                    <img src="{{ asset('assets/media/illustrations/sigma-1/21.png') }}"
                        class="img-fluid about-illustration d-block" alt="Ilustrasi E-Lapor" />
                </div>

                <div class="col-lg-7 d-flex align-items-center">
                    <div class="w-100">
                        <h2 class="fw-bold text-white mb-4">
                            Apa Itu E-Lapor?
                        </h2>

                        <p class="text-white text-opacity-75 fs-5 mb-4 text-justify-lg">
                            <span class="fw-semibold text-white">E-Lapor</span> adalah kanal resmi pengaduan dan aspirasi
                            di Universitas Nurul Jadid. Layanan ini dibuat agar setiap keluhan, temuan, atau masukan dari
                            civitas akademika dapat disampaikan secara <span
                                class="fw-semibold text-white">terstruktur</span>,
                            diproses oleh unit yang tepat, serta <span class="fw-semibold text-white">terpantau</span>
                            hingga selesai.
                        </p>

                        <p class="text-white text-opacity-75 fs-5 mb-0 text-justify-lg">
                            Saat membuat laporan, pelapor dapat memilih kategori, menuliskan kronologi secara singkat-jelas,
                            mencantumkan lokasi dan waktu, serta melampirkan bukti (foto/screenshot/dokumen) bila
                            diperlukan.
                            Laporan diverifikasi terlebih dahulu, diteruskan ke unit terkait, dan status penanganannya
                            diperbarui sampai ditutup. Untuk menjaga kenyamanan, tersedia opsi
                            <span class="fw-semibold text-white">anonim/rahasia</span> serta pembatasan akses petugas
                            sesuai kewenangan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- KATEGORI -->
    <section id="kategori" class="py-10 py-lg-15 bg-light">
        <div class="container">

            <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-5 mb-8">
                <div>
                    <h2 class="fw-bold text-gray-900 mb-2">Kategori Laporan</h2>
                    <div class="section-kicker text-muted mb-0">Pilih kategori agar langsung ke unit terkait</div>
                </div>
            </div>

            <div class="row g-6">
                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-primary mb-5">
                                <i class="ki-duotone ki-teacher fs-2 text-primary"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Akademik</div>
                            <div class="text-muted fs-7 mt-2">KRS, jadwal, nilai, administrasi akademik.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-success mb-5">
                                <i class="ki-duotone ki-home-2 fs-2 text-success"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Sarpras</div>
                            <div class="text-muted fs-7 mt-2">Ruang, listrik, AC, kebersihan, aksesibilitas.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-info mb-5">
                                <i class="ki-duotone ki-monitor-mobile fs-2 text-info"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">TIK / Sistem Informasi </div>
                            <div class="text-muted fs-7 mt-2">SSO, WiFi, LMS, email kampus, aplikasi layanan.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-danger mb-5">
                                <i class="ki-duotone ki-shield fs-2 text-danger"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Keamanan</div>
                            <div class="text-muted fs-7 mt-2">Insiden, kehilangan, parkir, ketertiban kampus.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-warning mb-5">
                                <i class="ki-duotone ki-flag fs-2 text-warning"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Etik / Perundungan</div>
                            <div class="text-muted fs-7 mt-2">Pelanggaran etik, pelecehan, diskriminasi.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-dark mb-5">
                                <i class="ki-duotone ki-people fs-2 text-gray-800"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Kemahasiswaan</div>
                            <div class="text-muted fs-7 mt-2">UKM, beasiswa, kegiatan, konseling.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-success mb-5">
                                <i class="ki-duotone ki-wallet fs-2 text-success"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Keuangan</div>
                            <div class="text-muted fs-7 mt-2">UKT, pembayaran, refund, administrasi.</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                        <div class="card-body p-7">
                            <span class="symbol symbol-45px symbol-circle bg-light-info mb-5">
                                <i class="ki-duotone ki-dots-circle fs-2 text-info"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </span>
                            <div class="fw-bold text-gray-900">Lainnya</div>
                            <div class="text-muted fs-7 mt-2">Aspirasi, saran, masukan layanan.</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ALUR -->
    <section id="alur" class="alur-section py-10 py-lg-15">
        <div class="container">
            <div class="row align-items-center g-10">

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm bg-white bg-opacity-75">
                        <div class="card-body p-8 p-lg-10">
                            <div class="fw-bold text-gray-900 fs-2 mb-2">Alur Penanganan</div>
                            <h2 class="section-kicker text-muted mb-3">Dari laporan masuk sampai selesai</h2>
                            <p class="text-gray-600 mb-6">
                                Setiap laporan diverifikasi, diteruskan ke unit terkait, dan diberi pembaruan status.
                                Pelapor bisa menambahkan komentar atau bukti tambahan jika dibutuhkan.
                            </p>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge badge-light-primary d-inline-flex align-items-center">Diterima</span>
                                <span
                                    class="badge badge-light-warning d-inline-flex align-items-center">Diverifikasi</span>
                                <span class="badge badge-light-info d-inline-flex align-items-center">Diproses</span>
                                <span class="badge badge-light-success d-inline-flex align-items-center">Selesai</span>
                                <span class="badge badge-light-danger d-inline-flex align-items-center">Ditolak</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm bg-white bg-opacity-75">
                        <div class="card-body p-8 p-lg-10">

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-8">
                                <div>
                                    <div class="fs-2 fw-bold text-gray-900">Langkah-langkah Penanganan</div>
                                    <div class="text-gray-600">Ringkas, jelas, dan konsisten</div>
                                </div>
                                <span class="badge badge-lg badge-light-primary d-inline-flex align-items-center">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    Update status berkala
                                </span>
                            </div>

                            <div class="timeline-label">

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">01</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-document fs-2 text-primary">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Submit Laporan</span>
                                            <span class="badge badge-light-primary">Diterima</span>
                                        </div>
                                        <div class="text-gray-600">Isi kategori, kronologi, lokasi, dan lampiran bukti
                                            pendukung.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">02</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-shield-search fs-2 text-warning">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Verifikasi ULT</span>
                                            <span class="badge badge-light-warning">Diverifikasi</span>
                                            <span class="badge badge-light-danger">Ditolak</span>
                                        </div>
                                        <div class="text-gray-600">Validasi kelengkapan data & bukti. Jika tidak sesuai,
                                            laporan bisa ditolak.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">03</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-setting-2 fs-2 text-info">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Diproses Unit Terkait</span>
                                            <span class="badge badge-light-info">Diproses</span>
                                        </div>
                                        <div class="text-gray-600">Ditindaklanjuti unit berwenang, termasuk klarifikasi
                                            bila diperlukan.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">04</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-check-circle fs-2 text-success">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Selesai & Penutupan</span>
                                            <span class="badge badge-light-success">Selesai</span>
                                        </div>
                                        <div class="text-gray-600">Hasil dicatat, status ditutup, dan pelapor menerima
                                            ringkasan penyelesaian.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ -->
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq_1">
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq_2">
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq_3">
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq_4">
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq_5">
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
