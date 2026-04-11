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

        .track-result-shell {
            display: grid;
            gap: 1.25rem;
        }

        .track-overview {
            background: #ffffff;
            border: 1px solid #EFF2F5;
            border-radius: 22px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, .05);
            overflow: hidden;
        }

        .track-overview-head {
            padding: 22px 22px 18px;
            border-bottom: 1px solid #EFF2F5;
            background: linear-gradient(180deg, rgba(62, 151, 255, .07) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .track-overview-title {
            font-size: clamp(1.35rem, 2.8vw, 1.9rem);
            font-weight: 800;
            line-height: 1.25;
            color: #181C32;
            margin: 0 0 8px;
        }

        .track-overview-subtitle {
            color: #7E8299;
            font-size: .92rem;
            line-height: 1.6;
            margin: 0 0 1rem;
        }

        .track-overview-body {
            padding: 20px 22px 22px;
        }

        .track-rejection-note {
            padding: 16px 18px;
            border-radius: 16px;
            background: #fff5f8;
            border: 1px solid #ffd8e4;
            margin-bottom: 1.25rem;
        }

        .track-rejection-title {
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #d6336c;
            margin-bottom: 8px;
        }

        .track-rejection-text {
            color: #3F4254;
            font-size: .92rem;
            line-height: 1.7;
            margin: 0;
        }

        .track-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .track-info-card {
            background: #fff;
            border: 1px solid #EFF2F5;
            border-radius: 18px;
            padding: 18px;
            height: 100%;
            min-width: 0;
            overflow: hidden;
        }

        .track-info-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .track-info-title {
            font-size: 1rem;
            font-weight: 800;
            color: #181C32;
            margin: 0;
        }

        .track-info-subtitle {
            font-size: .78rem;
            color: #7E8299;
            margin: 2px 0 0;
        }

        .track-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .track-detail-item {
            padding: 12px 14px;
            border-radius: 14px;
            background: #F8FAFC;
            border: 1px solid #EEF2F6;
            min-width: 0;
            max-width: 100%;
            overflow: hidden;
        }

        .track-detail-item.is-description {
            height: auto;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .track-detail-label {
            font-size: .72rem;
            color: #7E8299;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .track-detail-value {
            font-size: .92rem;
            font-weight: 700;
            color: #181C32;
            line-height: 1.5;
            word-break: break-word;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
            max-width: 100%;
        }

        .track-status-panel {
            display: grid;
            gap: 14px;
        }

        .track-status-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #F8FAFC;
            border: 1px solid #EEF2F6;
        }

        .track-status-label {
            font-size: .75rem;
            color: #7E8299;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .track-status-value {
            font-size: .95rem;
            color: #181C32;
            font-weight: 700;
            line-height: 1.5;
        }

        .track-status-icon {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #EFF2F5;
        }

        .track-submit-btn {
            min-width: 120px;
        }

        .track-submit-btn .indicator-progress {
            display: none;
        }

        .track-submit-btn.is-loading {
            pointer-events: none;
            opacity: .95;
        }

        .track-submit-btn.is-loading .indicator-label {
            display: none;
        }

        .track-submit-btn.is-loading .indicator-progress {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        @media (max-width: 991.98px) {
            .track-info-grid,
            .track-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trackForm = document.getElementById('track-form');
            const submitButton = document.getElementById('track-submit-btn');

            if (trackForm && submitButton) {
                trackForm.addEventListener('submit', function() {
                    submitButton.classList.add('is-loading');
                    submitButton.setAttribute('disabled', 'disabled');
                });
            }
        });
    </script>
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

                            <form action="{{ route('lacak') }}" method="GET" class="mb-7" id="track-form">
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
                                        data-allow-clear="true" autocomplete="off" required/>
                                    <button type="submit" class="btn btn-success track-submit-btn" id="track-submit-btn">
                                        <span class="indicator-label">
                                            <i class="ki-duotone ki-magnifier fs-5 me-1">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                            Lacak
                                        </span>
                                        <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Lacak...
                                        </span>
                                    </button>
                                </div>
                                <div class="form-text text-gray-600 mt-2">
                                    Gunakan format kode tiket persis seperti yang tertera.
                                </div>
                            </form>

                            @if ($kode)
                                <div class="separator my-7"></div>
                                @if ($laporan)
                                    @php
                                        $rejectionNote = $history->where('status', 'ditolak')->last()?->catatan;
                                    @endphp
                                    <div class="track-result-shell mb-7">
                                        <div class="track-overview">
                                            <div class="track-overview-head">
                                                <div class="track-pill mb-3">Kode Tiket: {{ $laporan->kode_tiket }}</div>
                                                <h2 class="track-overview-title">{{ $laporan->judul_laporan }}</h2>
                                                <p class="track-overview-subtitle">
                                                    Status laporan saat ini adalah <strong class="text-gray-900">{{ $statusMeta['label'] }}</strong>.
                                                    Anda bisa melihat ringkasan utama dan riwayat penanganan pada bagian di bawah.
                                                </p>

                                                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-4">
                                                    <span class="track-status {{ $statusMeta['track_class'] }}">
                                                        <span class="track-dot"></span>
                                                        {{ $statusMeta['label'] }}
                                                    </span>

                                                    <div class="track-steps ms-lg-auto">
                                                        @foreach ($statusSteps as $step)
                                                            <div class="track-step {{ $step['class'] }}">
                                                                <span class="s-dot"></span><span class="s-text">{{ $step['label'] }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="track-overview-body">
                                                @if ($laporan->status === 'ditolak' && $rejectionNote)
                                                    <div class="track-rejection-note">
                                                        <div class="track-rejection-title">Catatan Penolakan</div>
                                                        <p class="track-rejection-text">{{ $rejectionNote }}</p>
                                                    </div>
                                                @endif

                                                <div class="track-info-grid">
                                                    <div class="track-info-card">
                                                        <div class="track-info-head">
                                                            <div class="track-icon bg-light-primary">
                                                                <i class="ki-duotone ki-information-5 fs-4 text-primary">
                                                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                                                </i>
                                                            </div>
                                                            <div>
                                                                <h3 class="track-info-title">Detail Laporan</h3>
                                                                <div class="track-info-subtitle">Informasi utama dari tiket yang sedang dilacak</div>
                                                            </div>
                                                        </div>

                                                        <div class="track-detail-grid">
                                                            <div class="track-detail-item">
                                                                <div class="track-detail-label">Kategori</div>
                                                                <div class="track-detail-value">{{ $laporan->kategori?->nama_kategori ?? '-' }}</div>
                                                            </div>
                                                            <div class="track-detail-item">
                                                                <div class="track-detail-label">Unit Penangan</div>
                                                                <div class="track-detail-value">{{ $laporan->kategori?->unit?->nama_unit ?? '-' }}</div>
                                                            </div>
                                                            <div class="track-detail-item">
                                                                <div class="track-detail-label">Tanggal Kejadian</div>
                                                                <div class="track-detail-value">
                                                                    {{ $laporan->tgl_kejadian?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') ?? '-' }}
                                                                </div>
                                                            </div>
                                                            <div class="track-detail-item">
                                                                <div class="track-detail-label">Lokasi</div>
                                                                <div class="track-detail-value">{{ $laporan->lokasi_kejadian ?? '-' }}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="track-info-card">
                                                        <div class="track-info-head">
                                                            <div class="track-icon bg-light-info">
                                                                <i class="ki-duotone ki-calendar-8 fs-4 text-info">
                                                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                                                </i>
                                                            </div>
                                                            <div>
                                                                <h3 class="track-info-title">Progres Penanganan</h3>
                                                                <div class="track-info-subtitle">Informasi terbaru terkait pembaruan laporan</div>
                                                            </div>
                                                        </div>

                                                        <div class="track-status-panel">
                                                            <div class="track-status-row">
                                                                <div>
                                                                    <div class="track-status-label">Status Saat Ini</div>
                                                                    <div class="track-status-value">{{ $statusMeta['label'] }}</div>
                                                                </div>
                                                                <div class="track-status-icon">
                                                                    <span class="badge badge-{{ $statusMeta['badge_class'] }}">{{ $statusMeta['label'] }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="track-status-row">
                                                                <div>
                                                                    <div class="track-status-label">Update Terakhir</div>
                                                                    <div class="track-status-value">
                                                                        {{ optional($history->last()?->updated_at ?? $laporan->updated_at)?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                                        •
                                                                        {{ optional($history->last()?->updated_at ?? $laporan->updated_at)?->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                                    </div>
                                                                </div>
                                                                <div class="track-status-icon">
                                                                    <i class="ki-duotone ki-time fs-3 text-primary">
                                                                        <span class="path1"></span><span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div class="track-status-row">
                                                                <div>
                                                                    <div class="track-status-label">Catatan Status</div>
                                                                    <div class="track-status-value">{{ $statusMeta['timeline_note'] }}</div>
                                                                </div>
                                                                <div class="track-status-icon">
                                                                    <i class="ki-duotone ki-message-text-2 fs-3 text-info">
                                                                        <span class="path1"></span><span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="track-info-grid">
                                            <div class="track-info-card">
                                                <div class="track-info-head">
                                                    <div class="track-icon bg-light-primary">
                                                        <i class="ki-duotone ki-profile-circle fs-4 text-primary">
                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                                        </i>
                                                    </div>
                                                    <div>
                                                        <h3 class="track-info-title">Informasi Pelapor</h3>
                                                        <div class="track-info-subtitle">Data pelapor yang tercatat pada laporan</div>
                                                    </div>
                                                </div>

                                                <div class="track-detail-grid">
                                                    <div class="track-detail-item">
                                                        <div class="track-detail-label">Nama Pelapor</div>
                                                        <div class="track-detail-value">{{ $laporan->nama_pelapor ?: 'Anonim' }}</div>
                                                    </div>
                                                    <div class="track-detail-item">
                                                        <div class="track-detail-label">Email</div>
                                                        <div class="track-detail-value">{{ $laporan->email_pelapor ?: '-' }}</div>
                                                    </div>
                                                    <div class="track-detail-item">
                                                        <div class="track-detail-label">No. Telepon</div>
                                                        <div class="track-detail-value">{{ $laporan->no_telp_pelapor ?: '-' }}</div>
                                                    </div>
                                                    <div class="track-detail-item">
                                                        <div class="track-detail-label">Tipe Pelapor</div>
                                                        <div class="track-detail-value">{{ $laporan->tipe_pelapor ?: '-' }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="track-info-card">
                                                <div class="track-info-head">
                                                    <div class="track-icon bg-light-info">
                                                        <i class="ki-duotone ki-message-text-2 fs-4 text-info">
                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                                        </i>
                                                    </div>
                                                    <div>
                                                        <h3 class="track-info-title">Deskripsi Laporan</h3>
                                                        <div class="track-info-subtitle">Ringkasan isi laporan yang dikirim pelapor</div>
                                                    </div>
                                                </div>
                                                <div class="track-detail-item is-description">
                                                    <div class="track-detail-label">Isi Laporan</div>
                                                    <div class="track-detail-value">{{ $laporan->deskripsi_laporan ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                <div
                                                    class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                    <div>
                                                        <div class="fw-semibold text-gray-900">Laporan dibuat</div>
                                                        <div class="text-gray-600 fs-7 mt-1">
                                                            Laporan berhasil dikirim dengan judul
                                                            <span
                                                                class="fw-semibold text-gray-700">{{ $laporan->judul_laporan }}</span>.
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="text-gray-500 fs-8">
                                                            {{ $laporan->created_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                            • {{ $laporan->created_at?->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                                                        <span class="badge badge-light-primary mt-2">Diterima</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @forelse ($history as $item)
                                            @php
                                                $itemMeta = match ($item->status) {
                                                    'menunggu' => [
                                                        'bg' => 'bg-light-warning',
                                                        'text' => 'text-warning',
                                                        'badge' => 'badge-light-warning',
                                                        'icon' => 'ki-time',
                                                        'title' => 'Menunggu tindak lanjut',
                                                    ],
                                                    'diproses' => [
                                                        'bg' => 'bg-light-info',
                                                        'text' => 'text-info',
                                                        'badge' => 'badge-light-info',
                                                        'icon' => 'ki-setting-2',
                                                        'title' => 'Diproses unit terkait',
                                                    ],
                                                    'selesai' => [
                                                        'bg' => 'bg-light-success',
                                                        'text' => 'text-success',
                                                        'badge' => 'badge-light-success',
                                                        'icon' => 'ki-check-circle',
                                                        'title' => 'Laporan selesai',
                                                    ],
                                                    'ditolak' => [
                                                        'bg' => 'bg-light-danger',
                                                        'text' => 'text-danger',
                                                        'badge' => 'badge-light-danger',
                                                        'icon' => 'ki-cross-circle',
                                                        'title' => 'Laporan ditolak',
                                                    ],
                                                    default => [
                                                        'bg' => 'bg-light-secondary',
                                                        'text' => 'text-secondary',
                                                        'badge' => 'badge-light-secondary',
                                                        'icon' => 'ki-information-5',
                                                        'title' => 'Perubahan status',
                                                    ],
                                                };
                                            @endphp
                                            <div class="track-item">
                                                <div class="track-badge {{ $itemMeta['bg'] }}">
                                                    <i
                                                        class="ki-duotone {{ $itemMeta['icon'] }} fs-3 {{ $itemMeta['text'] }}">
                                                        <span class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span class="path4"></span>
                                                    </i>
                                                </div>

                                                <div class="track-card">
                                                    <div
                                                        class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                        <div>
                                                            <div class="fw-semibold text-gray-900">
                                                                {{ $itemMeta['title'] }}</div>
                                                            <div class="text-gray-600 fs-7 mt-1">
                                                                {{ $item->catatan ?: $statusMeta['timeline_note'] }}
                                                            </div>
                                                            @if ($item->user)
                                                                <div class="text-gray-500 fs-8 mt-2">
                                                                    Oleh:
                                                                    {{ $item->user->unit?->nama_unit ?? $item->user->nama }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="text-gray-500 fs-8">
                                                                {{ $item->created_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                                • {{ $item->created_at?->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                                                            <span
                                                                class="badge {{ $itemMeta['badge'] }} mt-2 text-capitalize">{{ $item->status }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="track-item">
                                                <div class="track-badge {{ $statusMeta['icon_bg'] }}">
                                                    <i
                                                        class="ki-duotone {{ $statusMeta['icon'] }} fs-3 {{ $statusMeta['icon_color'] }}">
                                                        <span class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span class="path4"></span>
                                                    </i>
                                                </div>
                                                <div class="track-card">
                                                    <div
                                                        class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                                                        <div>
                                                            <div class="fw-semibold text-gray-900">
                                                                {{ $statusMeta['timeline_title'] }}</div>
                                                            <div class="text-gray-600 fs-7 mt-1">
                                                                {{ $statusMeta['timeline_note'] }}</div>
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="text-gray-500 fs-8">
                                                                {{ $laporan->updated_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                                • {{ $laporan->updated_at?->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                                                            <span
                                                                class="badge badge-{{ $statusMeta['badge_class'] }} mt-2">{{ $statusMeta['label'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                @else
                                    <div class="text-center py-10">
                                        <div class="symbol symbol-70px symbol-circle bg-light-danger mb-5">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-information-5 fs-2tx text-danger">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="fw-bold text-gray-900 fs-2 mb-2">Kode tiket tidak ditemukan</div>
                                        <div class="text-gray-600 mb-6">
                                            Kode <span class="fw-semibold text-gray-800">{{ $kode }}</span> tidak
                                            terdaftar.
                                            Pastikan format kode tiket sudah benar.
                                        </div>
                                    </div>
                                @endif
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
