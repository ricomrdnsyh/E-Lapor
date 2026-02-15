@extends('pages.app')

@section('css')
    <style>
        .track-summary {
            background: linear-gradient(180deg, rgba(62, 151, 255, .08) 0%, rgba(255, 255, 255, 1) 70%);
            border-radius: 16px;
        }

        .track-pill {
            display: inline-flex;
            padding: .35rem .7rem;
            border-radius: 999px;
            font-size: .75rem;
            color: #7E8299;
            background: #F5F8FA;
            border: 1px solid #EFF2F5;
            font-weight: 700;
        }

        .track-status {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: .5rem .8rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
            border: 1px solid #EFF2F5;
            background: #fff;
            color: #3F4254;
        }

        .track-status .track-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #D8DDE6;
        }

        .track-status.is-info .track-dot {
            background: #3E97FF;
        }

        .track-steps {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 14px;
            align-items: center;
            justify-content: flex-end;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .75);
            border: 1px solid #EFF2F5;
        }

        .track-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .75rem;
            color: #7E8299;
            font-weight: 700;
        }

        .track-step .s-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #D8DDE6;
            box-shadow: 0 0 0 3px rgba(216, 221, 230, .35);
        }

        .track-step.is-done {
            color: #50CD89;
        }

        .track-step.is-done .s-dot {
            background: #50CD89;
            box-shadow: 0 0 0 3px rgba(80, 205, 137, .18);
        }

        .track-step.is-active {
            color: #3E97FF;
        }

        .track-step.is-active .s-dot {
            background: #3E97FF;
            box-shadow: 0 0 0 3px rgba(62, 151, 255, .18);
        }

        .track-step.is-danger {
            color: #F1416C;
        }

        .track-step.is-danger .s-dot {
            background: #F1416C;
            box-shadow: 0 0 0 3px rgba(241, 65, 108, .18);
        }

        .track-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid #EFF2F5;
        }

        .track-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .track-label {
            font-size: .75rem;
            color: #7E8299;
        }

        .track-value {
            font-weight: 800;
            color: #181C32;
        }

        .track-activity {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding-left: 52px;
        }

        .track-activity:before {
            content: "";
            position: absolute;
            left: 22px;
            top: 10px;
            bottom: 10px;
            width: 1px;
            background: #EEF0F5;
        }

        .track-item {
            position: relative;
        }

        .track-badge {
            position: absolute;
            left: -52px;
            top: 10px;
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #EFF2F5;
        }

        .track-card {
            background: #fff;
            border: 1px solid #EFF2F5;
            border-radius: 16px;
            padding: 14px 16px;
        }
    </style>
@endsection

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

                                <!-- SUMMARY -->
                                <div class="card border-0 shadow-sm track-summary mb-7">
                                    <div class="card-body p-6 p-lg-7">
                                        <div
                                            class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-5">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span class="track-pill">Kode tiket</span>
                                                    <span class="fw-bold text-gray-900">{{ request('kode') }}</span>
                                                </div>

                                                <div class="d-flex align-items-center flex-wrap gap-3 mb-1">
                                                    <div class="fw-bold text-gray-900 fs-2">Diproses</div>

                                                    <span class="track-status is-info">
                                                        <span class="track-dot"></span>
                                                        Status saat ini
                                                    </span>
                                                </div>

                                                <div class="text-gray-500 fs-8">
                                                    Update terakhir: <span class="text-gray-700 fw-semibold">31 Jan
                                                        2026</span> • 14:20
                                                </div>
                                            </div>

                                            <!-- MINI STEPPER -->
                                            <div class="track-steps ms-lg-auto">
                                                <div class="track-step is-done">
                                                    <span class="s-dot"></span><span class="s-text">Diterima</span>
                                                </div>
                                                <div class="track-step is-done">
                                                    <span class="s-dot"></span><span class="s-text">Diverifikasi</span>
                                                </div>
                                                <div class="track-step is-active">
                                                    <span class="s-dot"></span><span class="s-text">Diproses</span>
                                                </div>
                                                <div class="track-step">
                                                    <span class="s-dot"></span><span class="s-text">Selesai</span>
                                                </div>
                                                <div class="track-step is-danger">
                                                    <span class="s-dot"></span><span class="s-text">Ditolak</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- META -->
                                <div class="row g-4 mb-7">
                                    <div class="col-md-6">
                                        <div class="track-meta">
                                            <div class="track-icon bg-light-primary">
                                                <i class="ki-duotone ki-category fs-4 text-primary">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                            </div>
                                            <div>
                                                <div class="track-label">Kategori</div>
                                                <div class="track-value">Fasilitas Kampus</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="track-meta">
                                            <div class="track-icon bg-light-info">
                                                <i class="ki-duotone ki-briefcase fs-4 text-info">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                            </div>
                                            <div>
                                                <div class="track-label">Unit</div>
                                                <div class="track-value">Sarana & Prasarana</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TIMELINE -->
                                <div class="d-flex align-items-end justify-content-between mb-4">
                                    <div class="fw-bold text-gray-900 fs-3">Timeline</div>
                                    <div class="text-gray-500 fs-8">Riwayat progres laporan</div>
                                </div>

                                <div class="track-activity mb-2">

                                    <div class="track-item">
                                        <div class="track-badge bg-light-primary">
                                            <i class="ki-duotone ki-document fs-3 text-primary">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>

                                        <div class="track-card">
                                            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                <div>
                                                    <div class="fw-semibold text-gray-900">Laporan diterima</div>
                                                    <div class="text-gray-600 fs-7 mt-1">Tiket dibuat dan masuk antrian
                                                        verifikasi.</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-gray-500 fs-8">30 Jan 2026 • 10:05</div>
                                                    <span class="badge badge-light-primary mt-2">Diterima</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="track-item">
                                        <div class="track-badge bg-light-warning">
                                            <i class="ki-duotone ki-shield-search fs-3 text-warning">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>

                                        <div class="track-card">
                                            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                <div>
                                                    <div class="fw-semibold text-gray-900">Verifikasi ULT</div>
                                                    <div class="text-gray-600 fs-7 mt-1">Data dan bukti dinyatakan lengkap.
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-gray-500 fs-8">30 Jan 2026 • 11:22</div>
                                                    <span class="badge badge-light-warning mt-2">Diverifikasi</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="track-item">
                                        <div class="track-badge bg-light-info">
                                            <i class="ki-duotone ki-setting-2 fs-3 text-info">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>

                                        <div class="track-card">
                                            <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                <div>
                                                    <div class="fw-semibold text-gray-900">Diproses unit terkait</div>
                                                    <div class="text-gray-600 fs-7 mt-1">Tim melakukan pengecekan dan
                                                        penjadwalan perbaikan.</div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="text-gray-500 fs-8">31 Jan 2026 • 14:20</div>
                                                    <span class="badge badge-light-info mt-2">Diproses</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
