@extends('pages.app')

@section('content')
    <section id="alur" class="py-10 py-lg-15 bg-white">
        <div class="container">
            <div class="row align-items-center g-10">

                <div class="col-lg-5">
                    <h2 class="fw-bold text-gray-900 mb-2">Alur penanganan</h2>
                    <div class="section-kicker text-muted mb-4">Dari laporan masuk sampai selesai</div>
                    <p class="text-muted mb-7">
                        Setiap laporan diverifikasi, diteruskan ke unit terkait, dan diberi pembaruan status.
                        Pelapor bisa menambahkan komentar/bukti jika dibutuhkan.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge badge-light-primary">Diterima</span>
                        <span class="badge badge-light-warning">Diverifikasi</span>
                        <span class="badge badge-light-info">Diproses</span>
                        <span class="badge badge-light-success">Selesai</span>
                        <span class="badge badge-light-danger">Ditolak</span>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card elapor-card">
                        <div class="card-body p-8 p-lg-10">

                            <div class="d-flex align-items-start mb-6">
                                <span class="symbol symbol-40px symbol-circle bg-light-primary me-4">
                                    <span class="symbol-label fw-bold text-primary">1</span>
                                </span>
                                <div>
                                    <div class="fw-bold text-gray-900">Submit Laporan</div>
                                    <div class="text-muted">Isi kategori, kronologi, lokasi, dan lampiran.</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-6">
                                <span class="symbol symbol-40px symbol-circle bg-light-warning me-4">
                                    <span class="symbol-label fw-bold text-warning">2</span>
                                </span>
                                <div>
                                    <div class="fw-bold text-gray-900">Verifikasi ULT</div>
                                    <div class="text-muted">Validasi data & bukti agar tepat sasaran.</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-6">
                                <span class="symbol symbol-40px symbol-circle bg-light-info me-4">
                                    <span class="symbol-label fw-bold text-info">3</span>
                                </span>
                                <div>
                                    <div class="fw-bold text-gray-900">Diproses Unit Terkait</div>
                                    <div class="text-muted">Tindak lanjut + komunikasi bila butuh klarifikasi.
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <span class="symbol symbol-40px symbol-circle bg-light-success me-4">
                                    <span class="symbol-label fw-bold text-success">4</span>
                                </span>
                                <div>
                                    <div class="fw-bold text-gray-900">Selesai & Penutupan</div>
                                    <div class="text-muted">Hasil dicatat, status ditutup, pelapor diberi
                                        ringkasan.</div>
                                </div>
                            </div>

                            <div class="separator my-8"></div>

                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('lapor') }}" class="btn btn-primary">Buat Laporan</a>
                                <a href="{{ route('beranda') }}" class="btn btn-secondary">Lacak Status</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
