@extends('layouts.main')

@section('title', 'Dashboard')

@section('css')
    <style>
        .unit-dashboard {
            --unit-surface: #ffffff;
            --unit-border: #e5e7eb;
            --unit-text: #1f2937;
            --unit-muted: #6b7280;
            --unit-bg-soft: linear-gradient(135deg, #f8fbff 0%, #eef4ff 100%);
        }

        .unit-dashboard .hero-card {
            background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 58%, #60a5fa 100%);
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.18);
        }

        .unit-dashboard .hero-card::before,
        .unit-dashboard .hero-card::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
        }

        .unit-dashboard .hero-card::before {
            width: 220px;
            height: 220px;
            top: -90px;
            right: -40px;
        }

        .unit-dashboard .hero-card::after {
            width: 160px;
            height: 160px;
            bottom: -70px;
            right: 140px;
        }

        .unit-dashboard .hero-card .card-body {
            position: relative;
            z-index: 1;
            padding: 2rem;
        }

        .unit-dashboard .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .45rem .85rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: #eff6ff;
            font-size: .85rem;
            font-weight: 600;
        }

        .unit-dashboard .hero-title {
            color: #ffffff;
            font-size: clamp(1.65rem, 2.6vw, 2.35rem);
            font-weight: 800;
            line-height: 1.2;
            margin: 1rem 0 .75rem;
        }

        .unit-dashboard .hero-subtitle {
            color: rgba(255, 255, 255, 0.82);
            max-width: 720px;
            font-size: .98rem;
            margin-bottom: 1.5rem;
        }

        .unit-dashboard .hero-inline-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem 1.5rem;
            margin-top: .5rem;
        }

        .unit-dashboard .hero-inline-item {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            color: rgba(255, 255, 255, 0.84);
            font-size: .92rem;
        }

        .unit-dashboard .hero-inline-item i {
            color: #bfdbfe;
            font-size: 1rem;
        }

        .unit-dashboard .stat-card,
        .unit-dashboard .info-card,
        .unit-dashboard .chart-card {
            background: var(--unit-surface);
            border: 1px solid var(--unit-border);
            border-radius: 1.15rem;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
            height: 100%;
        }

        .unit-dashboard .stat-link {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .unit-dashboard .stat-link .stat-card {
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
            cursor: pointer;
        }

        .unit-dashboard .stat-link:hover .stat-card {
            transform: translateY(-3px);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.12);
            border-color: #bfdbfe;
        }

        .unit-dashboard .stat-card .card-body,
        .unit-dashboard .info-card .card-body,
        .unit-dashboard .chart-card .card-body {
            padding: 1.25rem;
        }

        .unit-dashboard .stat-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
        }

        .unit-dashboard .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: .95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .unit-dashboard .stat-icon i {
            font-size: 1.35rem;
        }

        .unit-dashboard .stat-label {
            color: var(--unit-muted);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
        }

        .unit-dashboard .stat-value {
            color: var(--unit-text);
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: .35rem;
        }

        .unit-dashboard .stat-note {
            color: #94a3b8;
            font-size: .82rem;
        }

        .unit-dashboard .theme-total .stat-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .unit-dashboard .theme-menunggu .stat-icon {
            background: #fef3c7;
            color: #d97706;
        }

        .unit-dashboard .theme-diproses .stat-icon {
            background: #dbeafe;
            color: #0284c7;
        }

        .unit-dashboard .theme-selesai .stat-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .unit-dashboard .theme-ditolak .stat-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .unit-dashboard .chart-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: .5rem 0 1rem;
        }

        .unit-dashboard .chart-box {
            position: relative;
            width: 240px;
            height: 240px;
        }

        .unit-dashboard .chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .unit-dashboard .chart-center {
            position: absolute;
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
        }

        .unit-dashboard .chart-center-label {
            color: #64748b;
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .unit-dashboard .chart-center-value {
            color: #0f172a;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .unit-dashboard .legend-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .85rem;
        }

        .unit-dashboard .legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            padding: .9rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: .9rem;
        }

        .unit-dashboard .legend-left {
            display: flex;
            align-items: center;
            gap: .65rem;
            min-width: 0;
        }

        .unit-dashboard .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .unit-dashboard .legend-label {
            color: #475569;
            font-weight: 700;
            font-size: .9rem;
        }

        .unit-dashboard .legend-value {
            color: #0f172a;
            font-weight: 800;
            white-space: nowrap;
        }

        .unit-dashboard .summary-strip {
            background: var(--unit-bg-soft);
            border: 1px dashed #cbd5e1;
            border-radius: 1rem;
            padding: 1rem 1.1rem;
            color: #475569;
            line-height: 1.7;
        }

        .unit-dashboard .summary-strip strong {
            color: #0f172a;
        }

        .unit-dashboard .info-title {
            color: var(--unit-text);
            font-size: 1.05rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .unit-dashboard .info-list {
            display: grid;
            gap: .9rem;
        }

        .unit-dashboard .profile-card {
            background: #ffffff;
            overflow: hidden;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .unit-dashboard .profile-shell {
            display: grid;
            gap: 1rem;
        }

        .unit-dashboard .profile-top {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding-bottom: .25rem;
        }

        .unit-dashboard .profile-avatar {
            width: 60px;
            height: 60px;
            border-radius: .95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            color: #2563eb;
            box-shadow: none;
            flex-shrink: 0;
        }

        .unit-dashboard .profile-avatar i {
            font-size: 1.35rem;
        }

        .unit-dashboard .profile-kicker {
            color: #64748b;
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
        }

        .unit-dashboard .profile-name {
            color: #0f172a;
            font-size: 1.08rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: .2rem;
        }

        .unit-dashboard .profile-subtitle {
            color: #64748b;
            font-size: .9rem;
            line-height: 1.5;
            margin: 0;
        }

        .unit-dashboard .profile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: .9rem;
        }

        .unit-dashboard .info-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: .95rem;
            padding: .95rem 1rem;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .unit-dashboard .info-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .unit-dashboard .info-label {
            color: #64748b;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
            font-weight: 700;
        }

        .unit-dashboard .info-value {
            color: #0f172a;
            font-size: 1rem;
            font-weight: 700;
            word-break: break-word;
        }

        @media (max-width: 1199.98px) {
            .unit-dashboard .legend-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid unit-dashboard" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_content" class="app-content flex-column-fluid mt-12">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-12">
                            <div class="card hero-card">
                                <div class="card-body">
                                    <div class="hero-badge">
                                        <i class="ki-duotone ki-shield-tick fs-5 text-white">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span>Dashboard Pimpinan</span>
                                    </div>

                                    <h1 class="hero-title">Ringkasan Monitoring Laporan
                                        {{ $user->unit->nama_unit ?? 'Unit Anda' }}</h1>
                                    <p class="hero-subtitle">
                                        Pantau seluruh statistik, status, dan progres penanganan laporan secara terpusat.
                                    </p>

                                    <div class="hero-inline-info">
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-abstract-26">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span>Monitoring laporan sesuai unit aktif</span>
                                        </div>
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-timer">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span>Membantu membaca prioritas penanganan lebih cepat</span>
                                        </div>
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-chart-pie-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <span>Distribusi status tersaji dalam grafik lingkaran</span>
                                        </div>
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-chart-bar-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span>Grafik kategori, pelapor, dan privasi laporan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-total">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Total Laporan</div>
                                                <div class="stat-value">{{ $stats['total'] ?? 0 }}</div>
                                                <div class="stat-note">Laporan unit ini</div>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="ki-duotone ki-element-11">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-menunggu">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Menunggu</div>
                                                <div class="stat-value">{{ $stats['menunggu'] ?? 0 }}</div>
                                                <div class="stat-note">Belum ditindaklanjuti</div>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="ki-duotone ki-time">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-diproses">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Diproses</div>
                                                <div class="stat-value">{{ $stats['diproses'] ?? 0 }}</div>
                                                <div class="stat-note">Sedang ditangani</div>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="ki-duotone ki-timer">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-selesai">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Selesai</div>
                                                <div class="stat-value">{{ $stats['selesai'] ?? 0 }}</div>
                                                <div class="stat-note">Sudah dituntaskan</div>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="ki-duotone ki-verify">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-ditolak">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Ditolak</div>
                                                <div class="stat-value">{{ $stats['ditolak'] ?? 0 }}</div>
                                                <div class="stat-note">Tidak diproses lanjut</div>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="ki-duotone ki-cross-circle">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl-8">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Distribusi Status Laporan</div>
                                    <div class="chart-wrap">
                                        <div class="chart-box">
                                            <canvas id="unitStatusChart"></canvas>
                                            <div class="chart-center">
                                                <div class="chart-center-label">Total</div>
                                                <div class="chart-center-value">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="legend-list">
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#f59e0b"></span>
                                                <span class="legend-label">Menunggu Respons</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['menunggu'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#0ea5e9"></span>
                                                <span class="legend-label">Diproses</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['diproses'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#22c55e"></span>
                                                <span class="legend-label">Selesai</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['selesai'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#ef4444"></span>
                                                <span class="legend-label">Ditolak</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['ditolak'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card info-card profile-card">
                                <div class="card-body">
                                    <div class="info-title">Informasi Akun Pimpinan</div>
                                    <div class="profile-shell">
                                        <div class="profile-top">
                                            <div class="profile-avatar">
                                                <i class="ki-duotone ki-profile-user">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <div class="profile-kicker">Akun Aktif</div>
                                                <div class="profile-name">{{ $user->nama }}</div>
                                                <p class="profile-subtitle">{{ $user->unit->singkatan ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <div class="profile-grid">
                                            <div class="info-item">
                                                <div class="info-label">Unit</div>
                                                <div class="info-value">{{ $user->unit->nama_unit ?? 'N/A' }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Nama</div>
                                                <div class="info-value">{{ $user->nama }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Username</div>
                                                <div class="info-value">{{ $user->username }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Status Akses</div>
                                                <div class="info-value">Aktif Sebagai Akun Pimpinan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-12">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <div class="info-title mb-0">Tren Laporan Bulanan</div>
                                            <div class="text-muted fs-7">Jumlah laporan masuk per bulan — 12 bulan terakhir</div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0" data-bs-toggle="dropdown" title="Download">
                                                <i class="fas fa-bars fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                <li><a class="dropdown-item" onclick="downloadChart('trenChart', 'Tren Bulanan', 'png')" href="javascript:void(0)">PNG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('trenChart', 'Tren Bulanan', 'jpeg')" href="javascript:void(0)">JPEG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('trenChart', 'Tren Bulanan', 'pdf')" href="javascript:void(0)">PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="position:relative; height:320px;">
                                        <canvas id="trenChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl-8">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="info-title mb-0">Laporan per Kategori</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0" data-bs-toggle="dropdown" title="Download">
                                                <i class="fas fa-bars fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                <li><a class="dropdown-item" onclick="downloadChart('kategoriChart', 'Per Kategori', 'png')" href="javascript:void(0)">PNG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('kategoriChart', 'Per Kategori', 'jpeg')" href="javascript:void(0)">JPEG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('kategoriChart', 'Per Kategori', 'pdf')" href="javascript:void(0)">PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="position:relative; height:300px;">
                                        <canvas id="kategoriChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Privasi Laporan</div>
                                    <div class="chart-wrap">
                                        <div class="chart-box" style="width:220px;height:220px;">
                                            <canvas id="privasiChart"></canvas>
                                            <div class="chart-center">
                                                <div class="chart-center-label">Total</div>
                                                <div class="chart-center-value">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="legend-list" style="grid-template-columns:1fr;">
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#8b5cf6"></span>
                                                <span class="legend-label">Anonim</span>
                                            </div>
                                            <span class="legend-value">{{ $privasiData['anonim'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#f59e0b"></span>
                                                <span class="legend-label">Rahasia</span>
                                            </div>
                                            <span class="legend-value">{{ $privasiData['rahasia'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl-8">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="info-title mb-0">Laporan per Sub Kategori</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0" data-bs-toggle="dropdown" title="Download">
                                                <i class="fas fa-bars fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                <li><a class="dropdown-item" onclick="downloadChart('subKategoriChart', 'Per Sub Kategori', 'png')" href="javascript:void(0)">PNG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('subKategoriChart', 'Per Sub Kategori', 'jpeg')" href="javascript:void(0)">JPEG</a></li>
                                                <li><a class="dropdown-item" onclick="downloadChart('subKategoriChart', 'Per Sub Kategori', 'pdf')" href="javascript:void(0)">PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="position:relative; height:420px;">
                                        <canvas id="subKategoriChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Tipe Pelapor</div>
                                    <div class="chart-wrap">
                                        <div class="chart-box" style="width:220px;height:220px;">
                                            <canvas id="tipePelaporChart"></canvas>
                                            <div class="chart-center">
                                                <div class="chart-center-label">Total</div>
                                                <div class="chart-center-value">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tipePelaporLegend" class="legend-list" style="grid-template-columns:1fr;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function downloadChart(canvasId, label, format) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;

            if (format === 'pdf') {
                if (typeof window.jspdf === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
                    script.onload = function () { downloadChart(canvasId, label, 'pdf'); };
                    document.head.appendChild(script);
                    return;
                }
                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('l', 'mm', 'a4');
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (canvas.height / canvas.width) * pdfWidth;
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('Dashboard Pimpinan - ' + label + '.pdf');
                return;
            }

            const link = document.createElement('a');
            const ext = format === 'jpeg' ? 'jpg' : 'png';
            link.download = 'Dashboard Pimpinan - ' + label + '.' + ext;
            
            if (format === 'jpeg') {
                const tempCanvas = document.createElement('canvas');
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;
                const ctx = tempCanvas.getContext('2d');
                ctx.fillStyle = '#FFFFFF';
                ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
                ctx.drawImage(canvas, 0, 0);
                link.href = tempCanvas.toDataURL('image/jpeg', 0.92);
            } else {
                link.href = canvas.toDataURL('image/png');
            }
            
            link.click();
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Chart === 'undefined') return;

            const BAR_COLORS = ['#009ef7', '#50cd89', '#7239ea', '#ffc700', '#f1416c', '#43ced7', '#ff6f1e'];

            // --- Tren Bulanan ---
            const trenChartEl = document.getElementById('trenChart');
            if (trenChartEl) {
                const trenLabels = @json(collect($bulanData)->pluck('bulan'));
                const trenData = @json(collect($bulanData)->pluck('jumlah'));

                new Chart(trenChartEl, {
                    type: 'line',
                    data: {
                        labels: trenLabels,
                        datasets: [{
                            label: 'Laporan',
                            data: trenData,
                            borderColor: '#50cd89',
                            backgroundColor: 'rgba(80, 205, 137, 0.12)',
                            borderWidth: 3,
                            fill: true,
                            tension: .42,
                            pointBackgroundColor: '#50cd89',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12 }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#64748b' } },
                            y: { beginAtZero: true, ticks: { stepSize: 1, color: '#64748b' }, grid: { color: '#e2e8f0', borderDash: [5, 5] } }
                        }
                    }
                });
            }

            // --- Status Doughnut ---
            const statusEl = document.getElementById('unitStatusChart');
            if (statusEl) {
                new Chart(statusEl, {
                    type: 'doughnut',
                    data: {
                        labels: ['Menunggu Respons', 'Diproses', 'Selesai', 'Ditolak'],
                        datasets: [{
                            data: [
                                {{ $stats['menunggu'] ?? 0 }},
                                {{ $stats['diproses'] ?? 0 }},
                                {{ $stats['selesai'] ?? 0 }},
                                {{ $stats['ditolak'] ?? 0 }}
                            ],
                            backgroundColor: ['#ffc700', '#009ef7', '#50cd89', '#f1416c'],
                            borderColor: '#ffffff',
                            borderWidth: 6,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12, displayColors: true }
                        }
                    }
                });
            }

            // --- Kategori Bar Chart ---
            const kategoriEl = document.getElementById('kategoriChart');
            if (kategoriEl) {
                const kategoriLabels = @json($kategoriData->pluck('nama'));
                const kategoriValues = @json($kategoriData->pluck('total'));

                new Chart(kategoriEl, {
                    type: 'bar',
                    data: {
                        labels: kategoriLabels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: kategoriValues,
                            backgroundColor: kategoriLabels.map((_, i) => BAR_COLORS[i % BAR_COLORS.length]),
                            borderRadius: 6,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12 }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { stepSize: 1 }
                            },
                            y: {
                                grid: { display: false },
                                ticks: { font: { size: 11, weight: 'bold' } }
                            }
                        }
                    }
                });
            }

            // --- Sub Kategori Bar Chart ---
            const subKategoriEl = document.getElementById('subKategoriChart');
            if (subKategoriEl) {
                const subLabels = @json($subKategoriData->pluck('nama'));
                const subValues = @json($subKategoriData->pluck('total'));

                new Chart(subKategoriEl, {
                    type: 'bar',
                    data: {
                        labels: subLabels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: subValues,
                            backgroundColor: subLabels.map((_, i) => BAR_COLORS[(i + 3) % BAR_COLORS.length]),
                            borderRadius: 6,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12 }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { stepSize: 1 }
                            },
                            y: {
                                grid: { display: false },
                                ticks: {
                                    autoSkip: false,
                                    font: { size: 10, weight: 'bold' }
                                }
                            }
                        }
                    }
                });
            }

            // --- Tipe Pelapor Doughnut ---
            const tipeEl = document.getElementById('tipePelaporChart');
            const tipeLabels = @json($tipePelapor->keys());
            const tipeValues = @json($tipePelapor->values());
            const tipeColors = ['#009ef7', '#50cd89', '#7239ea', '#ffc700', '#f1416c'];

            if (tipeEl && tipeLabels.length) {
                new Chart(tipeEl, {
                    type: 'doughnut',
                    data: {
                        labels: tipeLabels,
                        datasets: [{
                            data: tipeValues,
                            backgroundColor: tipeColors.slice(0, tipeLabels.length),
                            borderColor: '#ffffff',
                            borderWidth: 4,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12, displayColors: true }
                        }
                    }
                });

                const legendContainer = document.getElementById('tipePelaporLegend');
                if (legendContainer) {
                    legendContainer.innerHTML = tipeLabels.map((label, i) => `
                        <div class="legend-item">
                            <div class="legend-left">
                                <span class="legend-dot" style="background:${tipeColors[i]}"></span>
                                <span class="legend-label">${label}</span>
                            </div>
                            <span class="legend-value">${tipeValues[i]}</span>
                        </div>
                    `).join('');
                }
            }

            // --- Privasi Doughnut ---
            const privasiEl = document.getElementById('privasiChart');
            if (privasiEl) {
                new Chart(privasiEl, {
                    type: 'doughnut',
                    data: {
                        labels: ['Anonim', 'Rahasia'],
                        datasets: [{
                            data: [
                                {{ $privasiData['anonim'] ?? 0 }},
                                {{ $privasiData['rahasia'] ?? 0 }}
                            ],
                            backgroundColor: ['#8b5cf6', '#f59e0b'],
                            borderColor: '#ffffff',
                            borderWidth: 4,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0f172a', padding: 12, displayColors: true }
                        }
                    }
                });
            }
        });
    </script>
@endsection
