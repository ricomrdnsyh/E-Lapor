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

        .admin-dashboard .hero-card {
            background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 58%, #60a5fa 100%);
            border: 0;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.18);
        }

        .admin-dashboard .hero-card::before,
        .admin-dashboard .hero-card::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
        }

        .admin-dashboard .hero-card::before {
            width: 220px;
            height: 220px;
            top: -90px;
            right: -40px;
        }

        .admin-dashboard .hero-card::after {
            width: 160px;
            height: 160px;
            bottom: -70px;
            right: 140px;
        }

        .admin-dashboard .hero-card .card-body {
            position: relative;
            z-index: 1;
            padding: 2rem;
        }

        .admin-dashboard .hero-badge {
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

        .admin-dashboard .hero-title {
            color: #ffffff;
            font-size: clamp(1.65rem, 2.6vw, 2.35rem);
            font-weight: 800;
            line-height: 1.2;
            margin: 1rem 0 .75rem;
        }

        .admin-dashboard .hero-subtitle {
            color: rgba(255, 255, 255, 0.82);
            max-width: 760px;
            font-size: .98rem;
            margin-bottom: 1.25rem;
        }

        .admin-dashboard .hero-inline-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem 1.5rem;
            margin-top: .5rem;
        }

        .admin-dashboard .hero-inline-item {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            color: rgba(255, 255, 255, 0.84);
            font-size: .92rem;
        }

        .admin-dashboard .hero-inline-item i {
            color: #bfdbfe;
            font-size: 1rem;
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

        .admin-dashboard .theme-total .stat-icon { background: #dbeafe; color: #2563eb; }
        .admin-dashboard .theme-menunggu .stat-icon { background: #fef3c7; color: #d97706; }
        .admin-dashboard .theme-diproses .stat-icon { background: #dbeafe; color: #0284c7; }
        .admin-dashboard .theme-selesai .stat-icon { background: #dcfce7; color: #16a34a; }
        .admin-dashboard .theme-ditolak .stat-icon { background: #fee2e2; color: #dc2626; }

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
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid admin-dashboard" id="kt_app_main">
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
                                        <span>Dashboard Admin</span>
                                    </div>

                                    <h1 class="hero-title">Ringkasan pengelolaan seluruh laporan E-Lapor</h1>
                                    <p class="hero-subtitle">
                                        Dashboard admin menampilkan gambaran menyeluruh terhadap seluruh laporan yang masuk,
                                        sehingga pemantauan status, tindak lanjut, dan distribusi progres bisa dilihat dalam satu tampilan.
                                    </p>

                                    <div class="hero-inline-info">
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-abstract-26">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span>Monitoring seluruh laporan lintas unit</span>
                                        </div>
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-timer">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <span>Membantu melihat antrean dan progres penanganan global</span>
                                        </div>
                                        <div class="hero-inline-item">
                                            <i class="ki-duotone ki-chart-pie-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <span>Distribusi status tersaji dalam grafik lingkaran</span>
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
                                                <div class="info-label">Role</div>
                                                <div class="info-value text-capitalize">{{ $user->role }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Username</div>
                                                <div class="info-value">{{ $user->username }}</div>
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
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.getElementById('adminStatusChart');

            if (!chartElement || typeof Chart === 'undefined') {
                return;
            }

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
                        backgroundColor: ['#f59e0b', '#0ea5e9', '#22c55e', '#ef4444'],
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
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 12,
                            displayColors: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
