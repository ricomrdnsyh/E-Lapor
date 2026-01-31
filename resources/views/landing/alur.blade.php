@extends('pages.app')

@section('content')
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
                            <span class="badge badge-light-warning d-inline-flex align-items-center">Diverifikasi</span>
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
                                    <div class="text-gray-600">Isi kategori, kronologi, lokasi, dan lampiran bukti pendukung.</div>
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
                                    <div class="text-gray-600">Validasi kelengkapan data & bukti. Jika tidak sesuai, laporan bisa ditolak.</div>
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
                                    <div class="text-gray-600">Ditindaklanjuti unit berwenang, termasuk klarifikasi bila diperlukan.</div>
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
                                    <div class="text-gray-600">Hasil dicatat, status ditutup, dan pelapor menerima ringkasan penyelesaian.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
