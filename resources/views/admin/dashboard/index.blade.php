@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('css')
    <style>
        .admin-dashboard {
            --admin-surface: #ffffff;
            --admin-border: #e5e7eb;
            --admin-text: #1f2937;
            --admin-muted: #6b7280;
            --admin-bg-soft: linear-gradient(135deg, #f8fbff 0%, #eef4ff 100%);
        }

        .hero-welcome-card {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #1b84ff 50%, #7239ea 100%);
        }

        .hero-welcome-card::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            top: -120px;
            right: -60px;
            pointer-events: none;
        }

        .hero-welcome-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.04);
            bottom: -80px;
            left: 10%;
            pointer-events: none;
        }



        .admin-dashboard .stat-card,
        .admin-dashboard .info-card,
        .admin-dashboard .chart-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: 1.15rem;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
            height: 100%;
        }

        .admin-dashboard .stat-link {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .admin-dashboard .stat-link .stat-card {
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
            cursor: pointer;
        }

        .admin-dashboard .stat-link:hover .stat-card {
            transform: translateY(-3px);
            box-shadow: 0 18px 36px rgba(15, 23, 42, 0.12);
            border-color: #bfdbfe;
        }

        .admin-dashboard .stat-card .card-body,
        .admin-dashboard .info-card .card-body,
        .admin-dashboard .chart-card .card-body {
            padding: 1.25rem;
        }

        .admin-dashboard .stat-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
        }

        .admin-dashboard .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: .95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .admin-dashboard .stat-icon i {
            font-size: 1.35rem;
        }

        .admin-dashboard .stat-label {
            color: var(--admin-muted);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
        }

        .admin-dashboard .stat-value {
            color: var(--admin-text);
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: .35rem;
        }

        .admin-dashboard .stat-note {
            color: #94a3b8;
            font-size: .82rem;
        }

        .admin-dashboard .theme-total .stat-icon {
            background: rgba(114, 57, 234, 0.12);
            color: #7239ea;
        }

        .admin-dashboard .theme-menunggu .stat-icon {
            background: rgba(255, 199, 0, 0.12);
            color: #ffc700;
        }

        .admin-dashboard .theme-diproses .stat-icon {
            background: rgba(0, 158, 247, 0.12);
            color: #009ef7;
        }

        .admin-dashboard .theme-selesai .stat-icon {
            background: rgba(80, 205, 137, 0.12);
            color: #50cd89;
        }

        .admin-dashboard .theme-ditolak .stat-icon {
            background: rgba(241, 65, 108, 0.12);
            color: #f1416c;
        }

        .admin-dashboard .chart-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: .5rem 0 1rem;
        }

        .admin-dashboard .chart-box {
            position: relative;
            width: 240px;
            height: 240px;
        }

        .admin-dashboard .chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .admin-dashboard .chart-center {
            position: absolute;
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
        }

        .admin-dashboard .chart-center-label {
            color: #64748b;
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .admin-dashboard .chart-center-value {
            color: #0f172a;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .admin-dashboard .legend-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .85rem;
        }

        .admin-dashboard .legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            padding: .9rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: .9rem;
        }

        .admin-dashboard .legend-left {
            display: flex;
            align-items: center;
            gap: .65rem;
            min-width: 0;
        }

        .admin-dashboard .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .admin-dashboard .legend-label {
            color: #475569;
            font-weight: 700;
            font-size: .9rem;
        }

        .admin-dashboard .legend-value {
            color: #0f172a;
            font-weight: 800;
            white-space: nowrap;
        }

        .admin-dashboard .summary-strip {
            background: var(--admin-bg-soft);
            border: 1px dashed #cbd5e1;
            border-radius: 1rem;
            padding: 1rem 1.1rem;
            color: #475569;
            line-height: 1.7;
        }

        .admin-dashboard .summary-strip strong {
            color: #0f172a;
        }

        .admin-dashboard .info-title {
            color: var(--admin-text);
            font-size: 1.05rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .admin-dashboard .profile-card {
            background: #ffffff;
            overflow: hidden;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .admin-dashboard .profile-shell {
            display: grid;
            gap: 1rem;
        }

        .admin-dashboard .profile-top {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding-bottom: .25rem;
        }

        .admin-dashboard .profile-avatar {
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

        .admin-dashboard .profile-avatar i {
            font-size: 1.35rem;
        }

        .admin-dashboard .profile-kicker {
            color: #64748b;
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
        }

        .admin-dashboard .profile-name {
            color: #0f172a;
            font-size: 1.08rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: .2rem;
        }

        .admin-dashboard .profile-subtitle {
            color: #64748b;
            font-size: .9rem;
            line-height: 1.5;
            margin: 0;
        }

        .admin-dashboard .profile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: .9rem;
        }

        .admin-dashboard .info-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: .95rem;
            padding: .95rem 1rem;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .admin-dashboard .info-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .admin-dashboard .info-label {
            color: #64748b;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .35rem;
            font-weight: 700;
        }

        .admin-dashboard .info-value {
            color: #0f172a;
            font-size: 1rem;
            font-weight: 700;
            word-break: break-word;
        }

        @media (max-width: 1199.98px) {
            .admin-dashboard .legend-list {
                grid-template-columns: 1fr;
            }
        }

        .admin-dashboard .chart-holder {
            position: relative;
            width: 100%;
        }

        .admin-dashboard .chart-holder-trend {
            height: 300px;
        }

        .admin-dashboard .chart-holder-donut {
            height: 260px;
        }

        .admin-dashboard .chart-holder-bar {
            height: var(--chart-height);
        }

        .admin-dashboard .chart-holder-pie {
            height: 280px;
        }

        .admin-dashboard .chart-legend-swatch {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid admin-dashboard" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid mt-12">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-12">
                            <div class="card card-flush hero-welcome-card border-0 overflow-hidden">
                                <div class="card-body d-flex flex-column flex-md-row align-items-center p-8 p-lg-10 position-relative" style="z-index:1">
                                    <div class="d-flex flex-column flex-grow-1 me-md-8 mb-5 mb-md-0">
                                        <div class="d-inline-flex align-items-center bg-white bg-opacity-15 rounded-pill px-4 py-2 mb-4" style="width:fit-content">
                                            <i class="ki-duotone ki-shield-tick fs-4 text-white me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span class="text-white fw-semibold fs-7">Dashboard Admin</span>
                                        </div>
                                        <h1 class="text-white fw-bolder mb-3" style="font-size:clamp(1.5rem,2.5vw,2rem)">Selamat Datang, {{ $user->nama }}!</h1>
                                        <p class="text-white text-opacity-75 fs-5 mb-0 mw-700px">
                                            Pantau seluruh statistik, status, dan progres penanganan laporan lintas unit secara terpusat.
                                        </p>
                                    </div>
                                    <div class="d-flex gap-4 flex-wrap justify-content-center">
                                        <div class="bg-white bg-opacity-10 rounded-3 px-5 py-4 text-center" style="min-width:110px">
                                            <div class="text-white fw-bolder fs-2x lh-1">{{ $stats['total'] ?? 0 }}</div>
                                            <div class="text-white text-opacity-75 fw-semibold fs-7 mt-1">Total Laporan</div>
                                        </div>
                                        <div class="bg-white bg-opacity-10 rounded-3 px-5 py-4 text-center" style="min-width:110px">
                                            <div class="text-white fw-bolder fs-2x lh-1">{{ $meta['total_unit'] ?? 0 }}</div>
                                            <div class="text-white text-opacity-75 fw-semibold fs-7 mt-1">Unit Aktif</div>
                                        </div>
                                        <div class="bg-white bg-opacity-10 rounded-3 px-5 py-4 text-center" style="min-width:110px">
                                            <div class="text-white fw-bolder fs-2x lh-1">{{ $meta['total_user'] ?? 0 }}</div>
                                            <div class="text-white text-opacity-75 fw-semibold fs-7 mt-1">Pengguna</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}" class="stat-link">
                                <div class="card stat-card theme-total">
                                    <div class="card-body">
                                        <div class="stat-head">
                                            <div>
                                                <div class="stat-label">Total Laporan</div>
                                                <div class="stat-value">{{ $stats['total'] ?? 0 }}</div>
                                                <div class="stat-note">Seluruh laporan sistem</div>
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
                            <a href="{{ route('admin.history-laporan.index') }}" class="stat-link">
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
                            <a href="{{ route('admin.history-laporan.index') }}" class="stat-link">
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
                            <a href="{{ route('admin.history-laporan.index') }}" class="stat-link">
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
                            <a href="{{ route('admin.history-laporan.index') }}" class="stat-link">
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
                                            <canvas id="adminStatusChart"></canvas>
                                            <div class="chart-center">
                                                <div class="chart-center-label">Total</div>
                                                <div class="chart-center-value">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="legend-list">
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#ffc700"></span>
                                                <span class="legend-label">Menunggu Respons</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['menunggu'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#009ef7"></span>
                                                <span class="legend-label">Diproses</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['diproses'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#50cd89"></span>
                                                <span class="legend-label">Selesai</span>
                                            </div>
                                            <span class="legend-value">{{ $stats['selesai'] ?? 0 }}</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-left">
                                                <span class="legend-dot" style="background:#f1416c"></span>
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
                                    <div class="info-title">Informasi Akun Admin</div>
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
                                                <p class="profile-subtitle">Administrator Sistem E-Lapor</p>
                                            </div>
                                        </div>

                                        <div class="profile-grid">
                                            <div class="info-item">
                                                <div class="info-label">Username</div>
                                                <div class="info-value">{{ $user->username }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Role</div>
                                                <div class="info-value text-capitalize">{{ $user->role }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Total Unit</div>
                                                <div class="info-value">{{ $meta['total_unit'] ?? 0 }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Total User</div>
                                                <div class="info-value">{{ $meta['total_user'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-lg-8">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Tren Laporan Bulanan</div>
                                    <div class="text-muted fs-7 mb-4">Jumlah laporan masuk per bulan — 12 bulan terakhir</div>
                                    <div class="chart-holder chart-holder-trend">
                                        <canvas id="trenChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Rahasia vs Anonim</div>
                                    <div class="text-muted fs-7 mb-4">Pilihan privasi pelapor</div>
                                    <div id="anonimLegend" class="d-flex flex-wrap justify-content-center gap-3 mb-5"></div>
                                    <div class="chart-holder chart-holder-donut">
                                        <canvas id="anonimChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10">
                        <div class="col-lg-8">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Laporan per Kategori</div>
                                    <div class="text-muted fs-7 mb-4">Distribusi berdasarkan kategori laporan</div>
                                    <div class="chart-holder chart-holder-bar" style="--chart-height: {{ max(280, count($laporanPerKategori) * 46) }}px;">
                                        <canvas id="kategoriChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card chart-card">
                                <div class="card-body">
                                    <div class="info-title">Tipe Pelapor</div>
                                    <div class="text-muted fs-7 mb-4">Profil berdasarkan kategori pengguna</div>
                                    <div id="tipeLegend" class="d-flex flex-wrap justify-content-center gap-3 mb-5"></div>
                                    <div class="chart-holder chart-holder-pie">
                                        <canvas id="tipePelaporChart"></canvas>
                                    </div>
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
    <script src="{{ asset('assets/plugins/custom/chartjs/chartjs.bundle.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cssVar = function(name, fallback) {
                const value = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
                return value || fallback;
            };

            const colors = {
                primary: cssVar('--bs-primary', '#009ef7'),
                success: cssVar('--bs-success', '#50cd89'),
                info: cssVar('--bs-info', '#7239ea'),
                warning: cssVar('--bs-warning', '#ffc700'),
                danger: cssVar('--bs-danger', '#f1416c'),
                dark: cssVar('--bs-dark', '#181c32'),
                body: cssVar('--bs-body-bg', '#ffffff'),
                gray100: cssVar('--bs-gray-100', '#f5f8fa'),
                gray200: cssVar('--bs-gray-200', '#eff2f5'),
                gray300: cssVar('--bs-gray-300', '#e4e6ef'),
                gray500: cssVar('--bs-gray-500', '#a1a5b7'),
                gray600: cssVar('--bs-gray-600', '#7e8299'),
                gray700: cssVar('--bs-gray-700', '#5e6278')
            };

            Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
            Chart.defaults.color = colors.gray500;
            Chart.defaults.borderColor = colors.gray200;

            const palette = [
                colors.primary, colors.success, colors.info, colors.warning,
                colors.danger, '#7239ea', '#43ced7', '#ff6f1e'
            ];

            const tooltipOptions = {
                backgroundColor: colors.dark,
                titleColor: colors.body,
                bodyColor: colors.gray500,
                padding: 12,
                cornerRadius: 8,
                displayColors: true,
                boxPadding: 5
            };

            const chartElement = document.getElementById('adminStatusChart');

            if (chartElement && typeof Chart !== 'undefined') {
                new Chart(chartElement, {
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
                            backgroundColor: [colors.warning, colors.primary, colors.success, colors.danger],
                            borderColor: colors.body,
                            borderWidth: 6,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: tooltipOptions
                        }
                    }
                });
            }

            function rgba(hex, alpha) {
                const value = hex.replace('#', '');
                const r = parseInt(value.substring(0, 2), 16);
                const g = parseInt(value.substring(2, 4), 16);
                const b = parseInt(value.substring(4, 6), 16);
                return `rgba(${r},${g},${b},${alpha})`;
            }

            function createLegend(el, labels, data, legendColors) {
                if(!el) return;
                const total = data.reduce((a, b) => a + Number(b), 0);
                labels.forEach((label, index) => {
                    const item = document.createElement('span');
                    const swatch = document.createElement('span');
                    const percent = total > 0 ? Math.round(Number(data[index]) / total * 100) : 0;

                    item.className = 'd-flex align-items-center text-gray-600 fs-7';
                    swatch.className = 'admin-dashboard chart-legend-swatch me-2';
                    swatch.style.backgroundColor = legendColors[index % legendColors.length];

                    item.appendChild(swatch);
                    item.appendChild(document.createTextNode(`${label} ${percent}%`));
                    el.appendChild(item);
                });
            }

            // 1. Tren Laporan Bulanan
            const trenChartEl = document.getElementById('trenChart');
            if (trenChartEl) {
                const trenLabels = {!! json_encode(collect($bulanData)->pluck('bulan')) !!};
                const trenData = {!! json_encode(collect($bulanData)->pluck('jumlah')) !!};

                new Chart(trenChartEl, {
                    type: 'line',
                    data: {
                        labels: trenLabels,
                        datasets: [{
                            label: 'Laporan',
                            data: trenData,
                            borderColor: colors.success,
                            backgroundColor: rgba(colors.success, .12),
                            borderWidth: 3,
                            fill: true,
                            tension: .42,
                            pointBackgroundColor: colors.success,
                            pointBorderColor: colors.body,
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false }, tooltip: tooltipOptions },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: colors.gray500 } },
                            y: { beginAtZero: true, grid: { color: colors.gray200, borderDash: [5, 5] }, ticks: { stepSize: 1, color: colors.gray500 } }
                        }
                    }
                });
            }

            // 2. Laporan per Kategori
            const kategoriChartEl = document.getElementById('kategoriChart');
            if (kategoriChartEl) {
                const katLabels = {!! json_encode($laporanPerKategori->pluck('nama_kategori')) !!};
                const katData = {!! json_encode($laporanPerKategori->pluck('jumlah_laporan')) !!};

                new Chart(kategoriChartEl, {
                    type: 'bar',
                    data: {
                        labels: katLabels,
                        datasets: [{
                            label: 'Laporan',
                            data: katData,
                            backgroundColor: katLabels.map((_, i) => palette[i % palette.length]),
                            borderRadius: 6,
                            barThickness: 24
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        plugins: { legend: { display: false }, tooltip: tooltipOptions },
                        scales: {
                            x: { beginAtZero: true, grid: { color: colors.gray200 }, ticks: { stepSize: 1, color: colors.gray500 } },
                            y: { grid: { display: false }, ticks: { color: colors.gray700, font: { weight: '600' } } }
                        }
                    }
                });
            }

            // 3. Tipe Pelapor
            const tipePelaporChartEl = document.getElementById('tipePelaporChart');
            if (tipePelaporChartEl) {
                const tipeLabels = {!! json_encode($tipePelapor->pluck('tipe_pelapor')) !!};
                const tipeData = {!! json_encode($tipePelapor->pluck('jumlah')) !!};
                const tipeColorMap = {
                    'Dosen': colors.primary,
                    'Mahasiswa': colors.success,
                    'Tenaga Pendidik': colors.warning,
                    'Masyarakat/Umum': colors.info
                };
                const tipeColors = tipeLabels.map(label => tipeColorMap[label] || colors.danger);

                createLegend(document.getElementById('tipeLegend'), tipeLabels, tipeData, tipeColors);

                new Chart(tipePelaporChartEl, {
                    type: 'pie',
                    data: {
                        labels: tipeLabels,
                        datasets: [{
                            data: tipeData,
                            backgroundColor: tipeColors,
                            borderColor: colors.body,
                            borderWidth: 3,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false }, tooltip: tooltipOptions }
                    }
                });
            }

            // 4. Rahasia vs Anonim
            const anonimChartEl = document.getElementById('anonimChart');
            if (anonimChartEl) {
                const anonData = [{{ $anonimData['rahasia'] ?? 0 }}, {{ $anonimData['anonim'] ?? 0 }}];
                const anonLabels = ['Rahasia', 'Anonim'];
                const anonColors = [colors.primary, colors.success];

                createLegend(document.getElementById('anonimLegend'), anonLabels, anonData, anonColors);

                new Chart(anonimChartEl, {
                    type: 'doughnut',
                    data: {
                        labels: anonLabels,
                        datasets: [{
                            data: anonData,
                            backgroundColor: anonColors,
                            borderColor: colors.body,
                            borderWidth: 4,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '62%',
                        plugins: { legend: { display: false }, tooltip: tooltipOptions }
                    }
                });
            }
        });
    </script>
@endsection
