@extends('pages.app')

@section('css')
    <style>
        #lacak {
            background:
                radial-gradient(1200px 500px at 10% -10%, rgba(59, 130, 246, .18), transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(16, 185, 129, .16), transparent 55%),
                linear-gradient(180deg, rgba(15, 23, 42, .02), transparent 40%);
        }

        .track-page {
            max-width: 1080px;
            margin: 0 auto;
        }

        .track-hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, .28), transparent 28%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, .18), transparent 24%),
                linear-gradient(135deg, #2a5b92 0%, #004289 58%, #00356f 100%);
            border-radius: 32px;
            padding: 40px;
            color: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .12);
            z-index: 1;
        }

        .track-hero::before {
            content: "";
            position: absolute;
            inset: auto -80px -110px auto;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, .24), rgba(255, 255, 255, .04));
        }

        .track-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, .16), rgba(255, 255, 255, 0));
            pointer-events: none;
        }

        .track-hero > * {
            position: relative;
            z-index: 1;
        }

        .track-kicker {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            padding: .45rem .9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .14);
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #fff;
        }

        .track-hero-title {
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.08;
            font-weight: 900;
            margin: 1.2rem 0 .9rem;
            max-width: 720px;
            color: #fff;
        }

        .track-hero-text {
            max-width: 720px;
            color: rgba(255, 255, 255, .9);
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .track-search {
            position: relative;
            z-index: 3;
            margin-top: -26px;
            margin-bottom: 24px;
            background: #fff;
            border-radius: 28px;
            padding: 22px;
            border: 1px solid rgba(15, 23, 42, .07);
            box-shadow: 0 20px 44px rgba(15, 23, 42, .08);
        }

        .track-search-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 14px;
            align-items: end;
        }

        .track-search-action {
            padding-top: 26px;
            display: flex;
            align-items: flex-end;
        }

        .track-input-label,
        .track-section-label,
        .track-meta-label,
        .track-list-label {
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #7b8794;
        }

        .track-input-label {
            display: block;
            margin-bottom: .7rem;
        }

        .track-input-wrap {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .55rem .65rem .55rem 1rem;
            height: 58px;
            border-radius: 20px;
            border: 1px solid #e3e8ef;
            background: #f9fbfc;
            transition: .2s ease;
        }

        .track-input-wrap:focus-within {
            border-color: rgba(0, 66, 137, .35);
            box-shadow: 0 0 0 4px rgba(0, 66, 137, .10);
            background: #fff;
        }

        .track-input-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 66, 137, .10);
            color: #004289;
            flex-shrink: 0;
        }

        .track-input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            font-size: 1rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .track-input::placeholder {
            color: #94a3b8;
            letter-spacing: normal;
            text-transform: none;
        }

        .track-submit-btn {
            color: #fff;
            min-width: 160px;
            border-radius: 18px;
            height: 58px;
            padding: .95rem 1.4rem;
            display: inline-flex;
            align-items: center;
            align-self: flex-end;
            justify-content: center;
            background: #004289;
            border: none;
            font-weight: 800;
            box-shadow: 0 14px 26px rgba(0, 66, 137, .24);
        }

        .track-submit-btn:hover,
        .track-submit-btn:focus,
        .track-submit-btn:active {
            color: #fff;
            background: #00376f;
            border-color: transparent;
            box-shadow: 0 14px 26px rgba(0, 55, 111, .26);
        }

        .track-submit-btn .indicator-progress {
            display: none;
        }

        .track-submit-btn.is-loading {
            pointer-events: none;
            opacity: .96;
            color: #fff;
            background: #00376f;
            border-color: transparent;
            box-shadow: 0 14px 26px rgba(0, 55, 111, .26);
        }

        .track-submit-btn.is-loading .indicator-label {
            display: none;
        }

        .track-submit-btn.is-loading .indicator-progress {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .track-help {
            margin-top: .9rem;
            font-size: .88rem;
            color: #64748b;
        }

        .track-result {
            display: grid;
            gap: 20px;
            margin-top: 22px;
        }

        .track-summary-card,
        .track-card,
        .track-timeline-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, .08);
            border-radius: 28px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, .05);
        }

        .track-summary-card {
            padding: 26px;
        }

        .track-summary-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(280px, .9fr);
            gap: 22px;
            align-items: start;
        }

        .track-status-head {
            display: flex;
            align-items: start;
            gap: 16px;
        }

        .track-status-icon {
            width: 64px;
            height: 64px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .track-status-title {
            font-size: clamp(1.45rem, 2.8vw, 2rem);
            line-height: 1.2;
            font-weight: 900;
            color: #0f172a;
            margin: .2rem 0 .45rem;
        }

        .track-status-text {
            color: #64748b;
            font-size: .95rem;
            line-height: 1.8;
            margin: 0;
        }

        .track-progress-wrap {
            margin-top: 1.35rem;
        }

        .track-progress {
            height: 10px;
            background: #eaf0f4;
            border-radius: 999px;
            overflow: hidden;
        }

        .track-progress-bar {
            height: 100%;
            border-radius: inherit;
            background: #50cd89;
        }

        .track-progress-meta {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: .65rem;
            font-size: .84rem;
            font-weight: 700;
            color: #64748b;
        }

        .track-meta-stack {
            display: grid;
            gap: 12px;
        }

        .track-meta-box,
        .track-list-item,
        .track-empty,
        .track-not-found {
            padding: 16px 18px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e8edf3;
        }

        .track-list-item {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 104px;
        }

        .track-meta-value,
        .track-list-value {
            color: #0f172a;
            font-size: .95rem;
            line-height: 1.7;
            font-weight: 700;
            margin-top: .35rem;
            word-break: break-word;
            white-space: pre-wrap;
        }

        .track-list-item.full {
            min-height: 0;
        }

        .track-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .track-card {
            padding: 22px;
        }

        .track-card-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .track-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .track-card-title {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 900;
            color: #0f172a;
        }

        .track-card-text {
            margin: .15rem 0 0;
            font-size: .85rem;
            color: #64748b;
        }

        .track-list {
            display: grid;
            gap: 12px;
        }

        .track-list-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .track-list-grid.is-report-detail {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .track-list-item.full {
            grid-column: 1 / -1;
        }

        .track-rejection {
            margin-top: 16px;
            padding: 16px 18px;
            border-radius: 20px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
        }

        .track-rejection .track-section-label {
            color: #c2410c;
        }

        .track-list-item.is-compact {
            min-height: 88px;
            padding: 14px 16px;
        }

        .track-list-item.is-description {
            grid-column: span 2;
            min-height: 220px;
        }

        .track-timeline-card {
            padding: 22px;
        }

        .track-timeline-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 16px;
        }

        .track-timeline-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 900;
            color: #0f172a;
        }

        .track-timeline-subtitle {
            margin: .15rem 0 0;
            font-size: .85rem;
            color: #64748b;
        }

        .track-timeline {
            position: relative;
            display: grid;
            gap: 14px;
            padding-left: 40px;
        }

        .track-timeline::before {
            content: "";
            position: absolute;
            left: 15px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: linear-gradient(180deg, rgba(0, 66, 137, .26), rgba(15, 23, 42, .08));
        }

        .track-timeline-item {
            position: relative;
            padding: 16px 18px;
            border-radius: 22px;
            background: #fff;
            border: 1px solid #e8edf3;
        }

        .track-timeline-badge {
            position: absolute;
            left: -40px;
            top: 16px;
            width: 30px;
            height: 30px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e8edf3;
            background: #fff;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .08);
        }

        .track-timeline-row {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .track-timeline-item-title {
            color: #0f172a;
            font-size: .98rem;
            font-weight: 800;
            margin-bottom: .35rem;
        }

        .track-timeline-item-text,
        .track-timeline-note {
            color: #64748b;
            font-size: .9rem;
            line-height: 1.75;
        }

        .track-timeline-note {
            margin-top: .45rem;
            font-size: .8rem;
        }

        .track-timeline-meta {
            min-width: 170px;
            text-align: right;
        }

        .track-timeline-date {
            color: #64748b;
            font-size: .8rem;
            font-weight: 700;
            margin-bottom: .45rem;
        }

        .track-empty,
        .track-not-found {
            margin-top: 22px;
            text-align: center;
            background: #fff;
            padding: 42px 24px;
        }

        .track-empty-title,
        .track-not-found-title {
            color: #424242;
            font-size: 1.4rem;
            font-weight: 900;
            margin: 1rem 0 .65rem;
        }

        .track-empty-text,
        .track-not-found-text {
            max-width: 560px;
            margin: 0 auto 1.4rem;
            color: #64748b;
            font-size: .95rem;
            line-height: 1.8;
        }

        @media (max-width: 991.98px) {

            .track-hero,
            .track-search,
            .track-summary-card,
            .track-card,
            .track-timeline-card {
                padding: 20px;
            }

            .track-search-grid,
            .track-summary-grid,
            .track-grid,
            .track-list-grid {
                grid-template-columns: 1fr;
            }

            .track-list-grid.is-report-detail {
                grid-template-columns: 1fr;
            }

            .track-list-item.is-description {
                grid-column: auto;
                min-height: 180px;
            }

            .track-search-action {
                padding-top: 0;
            }

            .track-submit-btn {
                color: #fff;
                width: 100%;
            }

            .track-timeline {
                padding-left: 0;
            }

            .track-timeline::before,
            .track-timeline-badge {
                display: none;
            }

            .track-timeline-meta {
                min-width: 0;
                text-align: left;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trackForm = document.getElementById('track-form');
            const submitButton = document.getElementById('track-submit-btn');
            const kodeInput = document.getElementById('track-kode-input');

            if (trackForm && submitButton) {
                trackForm.addEventListener('submit', function() {
                    submitButton.classList.add('is-loading');
                    submitButton.setAttribute('disabled', 'disabled');
                });
            }

            if (kodeInput) {
                kodeInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase().replace(/\s+/g, '');
                });
            }
        });
    </script>
@endsection

@section('content')
    <section id="lacak" class="py-10 py-lg-15">
        <div class="container">
            <div class="track-page">
                @php
                    $rejectionNote = $history->where('status', 'ditolak')->last()?->catatan;
                    $lastUpdate = $history->last()?->updated_at ?? $laporan?->updated_at;
                @endphp

                <div class="track-hero">
                    <span class="track-kicker">
                        <i class="ki-duotone ki-route fs-6">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        Lacak Laporan
                    </span>
                    <h1 class="track-hero-title">Lacak status laporan menggunakan kode tiket.</h1>
                    <p class="track-hero-text">
                        Lihat status terbaru, ringkasan laporan, dan riwayat penanganan dalam satu halaman.
                    </p>
                </div>

                <div class="track-search">
                    <form action="{{ route('lacak') }}" method="GET" id="track-form">
                        <div class="track-search-grid">
                            <div>
                                <label class="track-input-label" for="track-kode-input">Kode Tiket</label>
                                <div class="track-input-wrap">
                                    <span class="track-input-icon">
                                        <i class="ki-duotone ki-barcode fs-2">
                                            <span class="path1"></span><span class="path2"></span><span
                                                class="path3"></span><span class="path4"></span>
                                            <span class="path5"></span><span class="path6"></span><span
                                                class="path7"></span><span class="path8"></span>
                                        </i>
                                    </span>
                                    <input id="track-kode-input" type="text" name="kode" value="{{ $kode }}"
                                        class="track-input" autocomplete="off" placeholder="UNUJA-XXX-XXXXXXXX-XXXX"
                                        required>
                                </div>
                            </div>

                            <div class="track-search-action">
                                <button type="submit" class="btn track-submit-btn" id="track-submit-btn">
                                    <span class="indicator-label">
                                        <i class="ki-duotone ki-magnifier fs-5 me-1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        Lacak
                                    </span>
                                    <span class="indicator-progress">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Mencari...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="track-help">
                        Gunakan kode tiket persis seperti yang Anda terima setelah membuat laporan.
                    </div>
                </div>

                @if ($kode)
                    @if ($laporan)
                        <div class="track-result">
                            <div class="track-summary-card">
                                <div class="track-summary-grid">
                                    <div>
                                        <div class="track-status-head">
                                            <div class="track-status-icon {{ $statusMeta['icon_bg'] }}">
                                                <i
                                                    class="ki-duotone {{ $statusMeta['icon'] }} fs-1 {{ $statusMeta['icon_color'] }}">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span><span class="path4"></span>
                                                </i>
                                            </div>
                                            <div>
                                                <div class="track-section-label">Status Saat Ini</div>
                                                <div class="track-status-title">{{ $statusMeta['title'] }}</div>
                                                <p class="track-status-text">{{ $statusMeta['summary'] }}</p>
                                            </div>
                                        </div>

                                        <div class="track-progress-wrap">
                                            <div class="track-progress">
                                                <div class="track-progress-bar"
                                                    style="width: {{ $statusMeta['progress'] }}%;"></div>
                                            </div>
                                            <div class="track-progress-meta">
                                                <span>{{ $statusMeta['label'] }}</span>
                                                <span>{{ $statusMeta['progress'] }}%</span>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="track-meta-stack">
                                            <div class="track-meta-box">
                                                <div class="track-meta-label">Kode Tiket</div>
                                                <div class="track-meta-value">{{ $laporan->kode_tiket }}</div>
                                            </div>
                                            <div class="track-meta-box">
                                                <div class="track-meta-label">Judul Laporan</div>
                                                <div class="track-meta-value">{{ $laporan->judul_laporan }}</div>
                                            </div>
                                    </div>
                                </div>

                                @if ($laporan->status === 'ditolak' && $rejectionNote)
                                    <div class="track-rejection">
                                        <div class="track-section-label">Catatan Penolakan</div>
                                        <div class="track-meta-value">{{ $rejectionNote }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="track-grid">
                                <div class="track-card">
                                    <div class="track-card-head">
                                        <div class="track-card-icon bg-light-primary">
                                            <i class="ki-duotone ki-information-5 fs-4 text-primary">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <h3 class="track-card-title">Detail Laporan</h3>
                                            <p class="track-card-text">Informasi utama dari laporan yang sedang dilacak.</p>
                                        </div>
                                    </div>

                                    <div class="track-list track-list-grid is-report-detail">
                                        <div class="track-list-item is-compact">
                                            <div class="track-list-label">Kategori</div>
                                            <div class="track-list-value">{{ $laporan->kategori?->nama_kategori ?? '-' }}
                                            </div>
                                        </div>
                                        <div class="track-list-item is-compact">
                                            <div class="track-list-label">Unit Penangan</div>
                                            <div class="track-list-value">{{ $laporan->kategori?->unit?->nama_unit ?? '-' }}</div>
                                        </div>
                                        <div class="track-list-item is-compact">
                                            <div class="track-list-label">Lokasi</div>
                                            <div class="track-list-value">{{ $laporan->lokasi_kejadian ?? '-' }}</div>
                                        </div>
                                        <div class="track-list-item is-compact">
                                            <div class="track-list-label">Tanggal Kejadian</div>
                                            <div class="track-list-value">{{ $laporan->tgl_kejadian?->locale('id')->translatedFormat('d M Y') ?? '-' }}@if ($laporan->tgl_kejadian) • {{ $laporan->tgl_kejadian->format('H:i') }} @endif</div>
                                        </div>
                                        <div class="track-list-item full is-description">
                                            <div class="track-list-label">Deskripsi</div>
                                            <div class="track-list-value">{{ $laporan->deskripsi_laporan ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="track-card">
                                    <div class="track-card-head">
                                        <div class="track-card-icon bg-light-info">
                                            <i class="ki-duotone ki-profile-circle fs-4 text-info">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <h3 class="track-card-title">Informasi Pelapor</h3>
                                            <p class="track-card-text">Data pelapor yang tersimpan pada laporan.</p>
                                        </div>
                                    </div>

                                    <div class="track-list track-list-grid">
                                        <div class="track-list-item">
                                            <div class="track-list-label">Nama Pelapor</div>
                                            <div class="track-list-value">{{ $laporan->nama_pelapor ?: 'Anonim' }}</div>
                                        </div>
                                        <div class="track-list-item">
                                            <div class="track-list-label">Tipe Pelapor</div>
                                            <div class="track-list-value">{{ $laporan->tipe_pelapor ?: '-' }}</div>
                                        </div>
                                        <div class="track-list-item">
                                            <div class="track-list-label">Email</div>
                                            <div class="track-list-value">{{ $laporan->email_pelapor ?: '-' }}</div>
                                        </div>
                                        <div class="track-list-item">
                                            <div class="track-list-label">No. Telepon</div>
                                            <div class="track-list-value">{{ $laporan->no_telp_pelapor ?: '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="track-timeline-card">
                                <div class="track-timeline-head">
                                    <div>
                                        <h3 class="track-timeline-title">Riwayat Penanganan</h3>
                                        <p class="track-timeline-subtitle">Urutan pembaruan status laporan dari awal sampai
                                            sekarang.</p>
                                    </div>
                                    <span class="badge badge-light-primary px-4 py-2">{{ $history->count() + 1 }}
                                        aktivitas</span>
                                </div>

                                <div class="track-timeline">
                                    <div class="track-timeline-item">
                                        <div class="track-timeline-badge bg-light-primary">
                                            <i class="ki-duotone ki-document fs-5 text-primary">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="track-timeline-row">
                                            <div>
                                                <div class="track-timeline-item-title">Laporan dibuat</div>
                                                <div class="track-timeline-item-text">
                                                    Laporan berhasil dikirim dengan judul
                                                    <strong>{{ $laporan->judul_laporan }}</strong>.
                                                </div>
                                            </div>
                                            <div class="track-timeline-meta">
                                                <div class="track-timeline-date">
                                                    {{ $laporan->created_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                    @if ($laporan->created_at)
                                                        •
                                                        {{ $laporan->created_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                    @endif
                                                </div>
                                                <span class="badge badge-light-primary">Diterima</span>
                                            </div>
                                        </div>
                                    </div>

                                    @forelse ($history as $item)
                                        @php
                                            $itemStatus = $item->status_baru ?? $item->status ?? null;
                                            $itemMeta = match ($itemStatus) {
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

                                        <div class="track-timeline-item">
                                            <div class="track-timeline-badge {{ $itemMeta['bg'] }}">
                                                <i
                                                    class="ki-duotone {{ $itemMeta['icon'] }} fs-5 {{ $itemMeta['text'] }}">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span><span class="path4"></span>
                                                </i>
                                            </div>
                                            <div class="track-timeline-row">
                                                <div>
                                                    <div class="track-timeline-item-title">{{ $itemMeta['title'] }}</div>
                                                    <div class="track-timeline-item-text">
                                                        {{ $item->catatan ?: $itemMeta['title'] }}
                                                    </div>
                                                    @if ($item->user)
                                                        <div class="track-timeline-note">
                                                            Diperbarui oleh
                                                            {{ $item->user->unit?->nama_unit ?? $item->user->nama }}
                                                        </div>
                                                    @endif
                                                    @if ($item->lampiran_file)
                                                        <div class="track-timeline-note mt-2">
                                                            <a href="{{ asset('uploads/history-laporan/' . $item->lampiran_file) }}"
                                                                target="_blank" class="btn btn-sm btn-light-primary">
                                                                Lihat lampiran bukti
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="track-timeline-meta">
                                                    <div class="track-timeline-date">
                                                        {{ $item->created_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                        @if ($item->created_at)
                                                            •
                                                            {{ $item->created_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="badge {{ $itemMeta['badge'] }} text-capitalize">{{ $itemStatus ?: '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="track-timeline-item">
                                            <div class="track-timeline-badge {{ $statusMeta['icon_bg'] }}">
                                                <i
                                                    class="ki-duotone {{ $statusMeta['icon'] }} fs-5 {{ $statusMeta['icon_color'] }}">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span><span class="path4"></span>
                                                </i>
                                            </div>
                                            <div class="track-timeline-row">
                                                <div>
                                                    <div class="track-timeline-item-title">
                                                        {{ $statusMeta['timeline_title'] }}</div>
                                                    <div class="track-timeline-item-text">
                                                        {{ $statusMeta['timeline_note'] }}</div>
                                                </div>
                                                <div class="track-timeline-meta">
                                                    <div class="track-timeline-date">
                                                        {{ $laporan->updated_at?->copy()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                                                        @if ($laporan->updated_at)
                                                            •
                                                            {{ $laporan->updated_at->copy()->setTimezone('Asia/Jakarta')->format('H:i') }}
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="badge badge-{{ $statusMeta['badge_class'] }}">{{ $statusMeta['label'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="track-not-found">
                            <div class="symbol symbol-70px symbol-circle bg-light-danger mb-3">
                                <span class="symbol-label">
                                    <i class="ki-duotone ki-information-5 fs-2tx text-danger">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="track-not-found-title">Kode tiket tidak ditemukan</div>
                            <div class="track-not-found-text">
                                Kode <strong>{{ $kode }}</strong> tidak terdaftar. Pastikan kode tiket yang Anda
                                masukkan sudah benar.
                            </div>
                            <a href="{{ route('lapor') }}" class="btn btn-primary px-6">Buat Laporan</a>
                        </div>
                    @endif
                @else
                    <div class="track-empty">
                        <div class="symbol symbol-70px symbol-circle bg-light-primary mb-3">
                            <span class="symbol-label">
                                <i class="ki-duotone ki-magnifier fs-2tx text-primary">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <div class="track-empty-title">Masukkan kode tiket untuk mulai melacak</div>
                        <div class="track-empty-text">
                            Setelah laporan dibuat, Anda akan menerima kode tiket. Gunakan kode tersebut untuk melihat
                            status dan riwayat penanganan laporan.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
