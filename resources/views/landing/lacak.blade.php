@extends('pages.app')

@section('content')
    <section id="lacak" class="py-10 py-lg-15 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="card border-0 shadow-sm bg-white bg-opacity-75">
                        <div class="card-body p-8 p-lg-10">

                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-4 mb-8">
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="symbol symbol-45px symbol-circle bg-light-primary">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-route fs-2 text-primary">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                            </span>
                                        </span>
                                        <div>
                                            <div class="fw-bold text-gray-900 fs-2 mb-0">Pelacakan Laporan</div>
                                            <div class="text-gray-600">Masukkan kode tiket untuk melihat progres</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge badge-light-primary fs-8 px-3 py-2 d-inline-flex align-items-center">
                                        <span class="bullet bullet-dot bg-primary me-2"></span>Diterima
                                    </span>
                                    <span class="badge badge-light-warning fs-8 px-3 py-2 d-inline-flex align-items-center">
                                        <span class="bullet bullet-dot bg-warning me-2"></span>Diverifikasi
                                    </span>
                                    <span class="badge badge-light-info fs-8 px-3 py-2 d-inline-flex align-items-center">
                                        <span class="bullet bullet-dot bg-info me-2"></span>Diproses
                                    </span>
                                    <span class="badge badge-light-success fs-8 px-3 py-2 d-inline-flex align-items-center">
                                        <span class="bullet bullet-dot bg-success me-2"></span>Selesai
                                    </span>
                                    <span class="badge badge-light-danger fs-8 px-3 py-2 d-inline-flex align-items-center">
                                        <span class="bullet bullet-dot bg-danger me-2"></span>Ditolak
                                    </span>
                                </div>
                            </div>

                            <form action="{{ route('lacak') }}" method="GET" class="mb-7">
                                <label class="form-label fw-bold text-gray-800">Kode Tiket</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ki-duotone ki-barcode fs-2">
                                            <span class="path1"></span><span class="path2"></span>
                                            <span class="path3"></span><span class="path4"></span><span
                                                class="path5"></span>
                                            <span class="path6"></span><span class="path7"></span><span
                                                class="path8"></span>
                                        </i>
                                    </span>
                                    <input type="text" name="kode" value="{{ request('kode') }}" class="form-control"
                                        placeholder="Contoh: ELP-2026-000123" autocomplete="off" />
                                    <button type="submit" class="btn btn-success">
                                        <i class="ki-duotone ki-magnifier fs-5 me-1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        Lacak
                                    </button>
                                </div>
                                <div class="form-text text-gray-600 mt-2">
                                    Gunakan format kode tiket persis seperti yang tertera.
                                </div>
                            </form>

                            @if (request('kode'))
                                <div class="separator my-7"></div>

                                <div class="d-flex align-items-start justify-content-between flex-wrap gap-4 mb-7">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge badge-light fs-8 px-3 py-2">Kode</span>
                                            <span class="fw-bold text-gray-900">{{ request('kode') }}</span>
                                        </div>
                                        <div class="fw-bold text-gray-900 fs-3 mb-1">Status Saat Ini</div>
                                        <div class="text-gray-600">Update terakhir: 31 Jan 2026 • 14:20</div>
                                    </div>

                                    <div class="text-end">
                                        <span
                                            class="badge badge-light-info fs-7 px-4 py-3 d-inline-flex align-items-center">
                                            <span class="bullet bullet-dot bg-info me-2"></span>
                                            Diproses
                                        </span>
                                    </div>
                                </div>

                                <div class="row g-4 mb-8">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-5 rounded bg-light">
                                            <span class="symbol symbol-40px me-3">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="ki-duotone ki-category fs-4 text-primary">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                            </span>
                                            <div>
                                                <div class="text-gray-600 fs-8">Kategori</div>
                                                <div class="fw-bold text-gray-900">Fasilitas Kampus</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-5 rounded bg-light">
                                            <span class="symbol symbol-40px me-3">
                                                <span class="symbol-label bg-light-info">
                                                    <i class="ki-duotone ki-briefcase fs-4 text-info">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                            </span>
                                            <div>
                                                <div class="text-gray-600 fs-8">Unit</div>
                                                <div class="fw-bold text-gray-900">Sarana & Prasarana</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="fw-bold text-gray-900 fs-3 mb-5">Timeline</div>

                                <div class="timeline-label mb-8">
                                    <div class="timeline-item">
                                        <div class="timeline-label fw-bold text-gray-700 fs-6">10:05</div>
                                        <div class="timeline-badge">
                                            <i class="ki-duotone ki-document fs-2 text-primary">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="timeline-content ps-3 pb-8">
                                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                                <span class="fw-bold text-gray-900">Laporan diterima</span>
                                                <span class="badge badge-light-primary fs-8 px-3 py-2">Diterima</span>
                                            </div>
                                            <div class="text-gray-600">Tiket dibuat dan masuk antrian verifikasi.</div>
                                            <div class="text-gray-500 fs-8 mt-2">30 Jan 2026</div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-label fw-bold text-gray-700 fs-6">11:22</div>
                                        <div class="timeline-badge">
                                            <i class="ki-duotone ki-shield-search fs-2 text-warning">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="timeline-content ps-3 pb-8">
                                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                                <span class="fw-bold text-gray-900">Verifikasi ULT</span>
                                                <span class="badge badge-light-warning fs-8 px-3 py-2">Diverifikasi</span>
                                            </div>
                                            <div class="text-gray-600">Data dan bukti dinyatakan lengkap.</div>
                                            <div class="text-gray-500 fs-8 mt-2">30 Jan 2026</div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-label fw-bold text-gray-700 fs-6">14:20</div>
                                        <div class="timeline-badge">
                                            <i class="ki-duotone ki-setting-2 fs-2 text-info">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="timeline-content ps-3">
                                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                                <span class="fw-bold text-gray-900">Diproses unit terkait</span>
                                                <span class="badge badge-light-info fs-8 px-3 py-2">Diproses</span>
                                            </div>
                                            <div class="text-gray-600">Tim melakukan pengecekan dan penjadwalan perbaikan.
                                            </div>
                                            <div class="text-gray-500 fs-8 mt-2">31 Jan 2026</div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('lacak') }}" method="POST" class="mb-0"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode" value="{{ request('kode') }}">

                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                        <div class="fw-bold text-gray-900 fs-3">Tambahkan komentar</div>
                                        <span class="badge badge-light fs-8 px-3 py-2">Opsional</span>
                                    </div>

                                    <textarea name="komentar" class="form-control form-control-solid mb-4" rows="3"
                                        placeholder="Tulis komentar tambahan (opsional)"></textarea>

                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="file" name="lampiran" class="form-control form-control-solid"
                                                style="max-width: 320px;">
                                            <span class="text-gray-500 fs-8">JPG/PNG/PDF, maks 5MB</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ki-duotone ki-send fs-5 me-1">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                            Kirim
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-10">
                                    <div class="symbol symbol-70px symbol-circle bg-light mb-5">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-magnifier fs-2tx text-gray-700">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="fw-bold text-gray-900 fs-2 mb-2">Masukkan kode tiket</div>
                                    <div class="text-gray-600 mb-6">Isi kode tiket di atas untuk melihat detail dan progres
                                        laporan.</div>
                                    <a href="{{ route('lapor') }}" class="btn btn-primary">
                                        <i class="ki-duotone ki-pencil fs-5 me-1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        Buat Laporan
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
