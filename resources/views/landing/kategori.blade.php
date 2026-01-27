@extends('pages.app')

@section('content')
    <section id="kategori" class="py-10 py-lg-15 bg-light">
        <div class="container">

            <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-5 mb-8">
                <div>
                    <h2 class="fw-bold text-gray-900 mb-2">Kategori laporan</h2>
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
@endsection
