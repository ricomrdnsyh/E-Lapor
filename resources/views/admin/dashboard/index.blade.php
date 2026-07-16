@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid mt-7">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card card-flush border border-dashed border-gray-400 mb-7">
                        <div class="card-header pt-6 pb-4">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="symbol symbol-40px">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-shield-tick text-primary fs-3">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <span class="fs-3 fw-semibold text-gray-900">
                                            Selamat Datang,
                                            <span class="text-primary fw-bolder">{{ $user->nama }}</span>
                                        </span>
                                        <span class="text-gray-600 fw-semibold fs-7">
                                            Pantau seluruh statistik, status, dan progres penanganan laporan lintas unit
                                            secara terpusat.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center fw-bold px-4 py-2"
                                        style="background-color: #F8F9FA; color: #64748B; border-radius: 6px; font-size: 0.95rem;">
                                        <i class="ki-duotone ki-bank me-2" style="color: #64748B;"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        {{ $meta['total_unit'] ?? 0 }} Unit Aktif
                                    </div>
                                    <div class="d-flex align-items-center fw-bold px-4 py-2"
                                        style="background-color: #F8F9FA; color: #64748B; border-radius: 6px; font-size: 0.95rem;">
                                        <i class="ki-duotone ki-profile-user me-2" style="color: #64748B;"><span
                                                class="path1"></span><span class="path2"></span><span
                                                class="path3"></span><span class="path4"></span></i>
                                        {{ $meta['total_user'] ?? 0 }} Pengguna
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}"
                                class="card bg-secondary border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-dark shadow-sm">
                                                <i class="ki-duotone ki-element-11 text-white fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="fw-bold fs-2x text-gray-900">{{ $stats['total'] ?? 0 }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1 fs-7">Total Masuk</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}"
                                class="card bg-light-warning border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-warning shadow-sm">
                                                <i class="ki-duotone ki-time text-white fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="fw-bold fs-2x text-gray-900">{{ $stats['menunggu'] ?? 0 }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1 fs-7">Menunggu Respons</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}"
                                class="card bg-light-primary border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-primary shadow-sm">
                                                <i class="ki-duotone ki-timer text-white fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="fw-bold fs-2x text-gray-900">{{ $stats['diproses'] ?? 0 }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1 fs-7">Diproses</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}"
                                class="card bg-light-success border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-success shadow-sm">
                                                <i class="ki-duotone ki-verify text-white fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="fw-bold fs-2x text-gray-900">{{ $stats['selesai'] ?? 0 }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1 fs-7">Selesai</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl col-md-6">
                            <a href="{{ route('admin.history-laporan.index') }}"
                                class="card bg-light-danger border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-danger shadow-sm">
                                                <i class="ki-duotone ki-cross-circle text-white fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <div class="fw-bold fs-2x text-gray-900">{{ $stats['ditolak'] ?? 0 }}</div>
                                        <div class="fw-semibold text-gray-700 mt-1 fs-7">Ditolak</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl-8">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Distribusi Status Laporan</div>
                                    <div
                                        class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width: 240px; height: 240px;">
                                            <canvas id="adminStatusChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center"
                                                style="pointer-events: none;">
                                                <div class="text-muted fw-bold fs-8 text-uppercase">Total</div>
                                                <div class="text-gray-900 fw-bolder fs-1">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-3" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#ffc700"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Menunggu Respons</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $stats['menunggu'] ?? 0 }}</span>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#009ef7"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Diproses</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $stats['diproses'] ?? 0 }}</span>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#50cd89"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Selesai</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $stats['selesai'] ?? 0 }}</span>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#f1416c"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Ditolak</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $stats['ditolak'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Tipe Pelapor</div>
                                    <div
                                        class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width:220px;height:220px;">
                                            <canvas id="tipePelaporChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center"
                                                style="pointer-events: none;">
                                                <div class="text-muted fw-bold fs-8 text-uppercase">Total</div>
                                                <div class="text-gray-900 fw-bolder fs-1">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tipePelaporLegend" class="d-flex flex-column gap-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-lg-8">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <div class="text-gray-900 fw-bolder fs-5 mb-4">Tren Laporan Bulanan</div>
                                            <div class="text-muted fs-7">Jumlah laporan masuk per bulan — 12 bulan terakhir
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                data-bs-toggle="dropdown" title="Download">
                                                <i class="fas fa-bars fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                <li><a class="dropdown-item"
                                                        onclick="downloadChart('trenChart', 'Tren Bulanan', 'png')"
                                                        href="javascript:void(0)">PNG</a></li>
                                                <li><a class="dropdown-item"
                                                        onclick="downloadChart('trenChart', 'Tren Bulanan', 'jpeg')"
                                                        href="javascript:void(0)">JPEG</a></li>
                                                <li><a class="dropdown-item"
                                                        onclick="downloadChart('trenChart', 'Tren Bulanan', 'pdf')"
                                                        href="javascript:void(0)">PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="position-relative w-100" style="height: 300px;">
                                        <canvas id="trenChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Privasi Laporan</div>
                                    <div
                                        class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width:220px;height:220px;">
                                            <canvas id="privasiChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center"
                                                style="pointer-events: none;">
                                                <div class="text-muted fw-bold fs-8 text-uppercase">Total</div>
                                                <div class="text-gray-900 fw-bolder fs-1">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3">
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#8b5cf6"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Anonim</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $anonimData['anonim'] ?? 0 }}</span>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0"
                                                    style="background:#f59e0b"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Rahasia</span>
                                            </div>
                                            <span
                                                class="text-gray-900 fw-bolder text-nowrap">{{ $anonimData['rahasia'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-12">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-6">
                                        <div>
                                            <div class="text-gray-900 fw-bolder fs-5 mb-4">Filter Unit Laporan</div>
                                            <div class="text-muted fs-7">Pilih unit untuk melihat grafik laporan per
                                                kategori dan sub kategori</div>
                                        </div>
                                        <div>
                                            <select id="unitSelect" class="form-select form-select-sm w-400px"
                                                data-control="select2" data-placeholder="Pilih Unit">
                                                <option value="">-- Pilih Unit --</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}
                                                        ({{ $unit->singkatan }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="chartPlaceholder" class="text-center py-12">
                                        <div class="mb-4">
                                            <i class="ki-duotone ki-chart-line fs-3x text-muted">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <h4 class="text-gray-700 fw-bold">Pilih Unit Terlebih Dahulu</h4>
                                        <p class="text-gray-400 fs-6">Silakan pilih unit pada opsi di atas untuk melihat
                                            data grafik kategori dan sub kategori.</p>
                                    </div>

                                    <div id="chartsContainer" class="d-none">
                                        <div class="row g-5">
                                            <div class="col-12">
                                                <div class="card border border-dashed border-gray-300">
                                                    <div class="card-body">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-5">
                                                            <h3 class="card-title fw-bold text-gray-800 fs-5 mb-0">Laporan
                                                                per Kategori</h3>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                                    data-bs-toggle="dropdown" title="Download">
                                                                    <i class="fas fa-bars fs-4"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                                    <li><a class="dropdown-item"
                                                                            onclick="downloadChart('kategoriUnitChart', 'Per Kategori', 'png')"
                                                                            href="javascript:void(0)">PNG</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="downloadChart('kategoriUnitChart', 'Per Kategori', 'jpeg')"
                                                                            href="javascript:void(0)">JPEG</a></li>
                                                                    <li><a class="dropdown-item"
                                                                            onclick="downloadChart('kategoriUnitChart', 'Per Kategori', 'pdf')"
                                                                            href="javascript:void(0)">PDF</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div style="position:relative; height:320px;">
                                                            <canvas id="kategoriUnitChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card border border-dashed border-gray-300">
                                                    <div class="card-body">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-5">
                                                            <h3 class="card-title fw-bold text-gray-800 fs-5 mb-0">Laporan
                                                                per Sub Kategori</h3>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="w-200px">
                                                                    <select class="form-select form-select-sm w-100"
                                                                        id="kategoriFilter" data-control="select2"
                                                                        data-placeholder="Semua Kategori"
                                                                        data-allow-clear="true">
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                                        data-bs-toggle="dropdown" title="Download">
                                                                        <i class="fas fa-bars fs-4"></i>
                                                                    </button>
                                                                    <ul
                                                                        class="dropdown-menu dropdown-menu-end min-w-125px">
                                                                        <li><a class="dropdown-item"
                                                                                onclick="downloadChart('subKategoriUnitChart', 'Per Sub Kategori', 'png')"
                                                                                href="javascript:void(0)">PNG</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                onclick="downloadChart('subKategoriUnitChart', 'Per Sub Kategori', 'jpeg')"
                                                                                href="javascript:void(0)">JPEG</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                onclick="downloadChart('subKategoriUnitChart', 'Per Sub Kategori', 'pdf')"
                                                                                href="javascript:void(0)">PDF</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="position:relative; height:420px;">
                                                            <canvas id="subKategoriUnitChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
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
            // Chart instances for dynamic updates
            let adminStatusChartInstance = null;
            let trenChartInstance = null;
            let tipePelaporChartInstance = null;
            let privasiChartInstance = null;
            let kategoriUnitChartInstance = null;
            let subKategoriUnitChartInstance = null;

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
                adminStatusChartInstance = new Chart(chartElement, {
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
                            backgroundColor: [colors.warning, colors.primary, colors.success, colors
                                .danger
                            ],
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

            // 1. Tren Laporan Bulanan
            const trenChartEl = document.getElementById('trenChart');
            if (trenChartEl) {
                const trenLabels = {!! json_encode(collect($bulanData)->pluck('bulan')) !!};
                const trenData = {!! json_encode(collect($bulanData)->pluck('jumlah')) !!};

                trenChartInstance = new Chart(trenChartEl, {
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
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: tooltipOptions
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: colors.gray500
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: colors.gray200,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    stepSize: 1,
                                    color: colors.gray500
                                }
                            }
                        }
                    }
                });
            }

            // 2. Tipe Pelapor
            const tipePelaporChartEl = document.getElementById('tipePelaporChart');
            if (tipePelaporChartEl) {
                const tipeLabels = {!! json_encode($tipePelapor->pluck('tipe_pelapor')) !!};
                const tipeData = {!! json_encode($tipePelapor->pluck('jumlah')) !!};
                const tipeColorMap = {
                    'Dosen': '#2563eb',
                    'Mahasiswa': '#7c3aed',
                    'Tenaga Pendidik': '#059669',
                    'Masyarakat/Umum': '#d97706'
                };
                const tipeColors = tipeLabels.map(label => tipeColorMap[label] || colors.danger);

                tipePelaporChartInstance = new Chart(tipePelaporChartEl, {
                    type: 'doughnut',
                    data: {
                        labels: tipeLabels,
                        datasets: [{
                            data: tipeData,
                            backgroundColor: tipeColors,
                            borderColor: colors.body,
                            borderWidth: 4,
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

                const legendContainer = document.getElementById('tipePelaporLegend');
                if (legendContainer) {
                    legendContainer.innerHTML = tipeLabels.map((label, i) => `
                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:${tipeColors[i]}"></span>
                                <span class="text-gray-600 fw-bold fs-6">${label}</span>
                            </div>
                            <span class="text-gray-900 fw-bolder text-nowrap">${tipeData[i]}</span>
                        </div>
                    `).join('');
                }
            }

            // 3. Privasi Laporan
            const privasiChartEl = document.getElementById('privasiChart');
            if (privasiChartEl) {
                const anonData = [{{ $anonimData['anonim'] ?? 0 }}, {{ $anonimData['rahasia'] ?? 0 }}];
                const anonLabels = ['Anonim', 'Rahasia'];
                const anonColors = ['#8b5cf6', '#f59e0b'];

                privasiChartInstance = new Chart(privasiChartEl, {
                    type: 'doughnut',
                    data: {
                        labels: anonLabels,
                        datasets: [{
                            data: anonData,
                            backgroundColor: anonColors,
                            borderColor: colors.body,
                            borderWidth: 4,
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

            // 4. Filter Unit AJAX & Charts
            const unitSelect = document.getElementById('unitSelect');
            const chartPlaceholder = document.getElementById('chartPlaceholder');
            const chartsContainer = document.getElementById('chartsContainer');

            let isFetching = false;

            if (unitSelect) {
                const handleUnitChange = function() {
                    const unitId = unitSelect.value;
                    const kategoriFilter = document.getElementById('kategoriFilter');
                    const kategoriId = kategoriFilter ? kategoriFilter.value : '';

                    if (!unitId) {
                        chartsContainer.classList.add('d-none');
                        chartPlaceholder.classList.remove('d-none');
                        if (kategoriFilter) {
                            $(kategoriFilter).val(null).trigger('change.select2');
                        }
                        return;
                    }

                    // Prevent concurrent requests
                    if (isFetching) return;
                    isFetching = true;

                    let url =
                        `{{ route('admin.dashboard.unit-data', [], false) }}?unit_id=${encodeURIComponent(unitId)}`;
                    if (kategoriId) {
                        url += `&kategori_id=${encodeURIComponent(kategoriId)}`;
                    }

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok: ' + res.status);
                            return res.json();
                        })
                        .then(data => {
                            // Show container first
                            chartPlaceholder.classList.add('d-none');
                            chartsContainer.classList.remove('d-none');

                            // Delay rendering until after browser reflows the now-visible container
                            requestAnimationFrame(function() {
                                requestAnimationFrame(function() {

                                    // Render Kategori Chart
                                    const katCanvas = document.getElementById(
                                        'kategoriUnitChart');
                                    if (katCanvas) {
                                        if (kategoriUnitChartInstance) {
                                            kategoriUnitChartInstance.destroy();
                                            kategoriUnitChartInstance = null;
                                        }
                                        const katLabels = Array.isArray(data
                                                .kategoriLabels) ? data.kategoriLabels :
                                            Object
                                            .values(data.kategoriLabels);
                                        const katValues = Array.isArray(data
                                                .kategoriValues) ? data.kategoriValues :
                                            Object
                                            .values(data.kategoriValues);

                                        kategoriUnitChartInstance = new Chart(katCanvas
                                            .getContext('2d'), {
                                                type: 'bar',
                                                data: {
                                                    labels: katLabels,
                                                    datasets: [{
                                                        label: 'Jumlah Laporan',
                                                        data: katValues,
                                                        backgroundColor: katLabels
                                                            .map((_, i) =>
                                                                palette[i %
                                                                    palette
                                                                    .length]),
                                                        borderRadius: 6
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    maintainAspectRatio: false,
                                                    indexAxis: 'y',
                                                    plugins: {
                                                        legend: {
                                                            display: false
                                                        },
                                                        tooltip: tooltipOptions
                                                    },
                                                    scales: {
                                                        x: {
                                                            beginAtZero: true,
                                                            grid: {
                                                                color: colors.gray200
                                                            },
                                                            ticks: {
                                                                stepSize: 1,
                                                                color: colors.gray500
                                                            }
                                                        },
                                                        y: {
                                                            grid: {
                                                                display: false
                                                            },
                                                            ticks: {
                                                                autoSkip: false,
                                                                color: colors.gray700,
                                                                font: {
                                                                    weight: '600',
                                                                    size: 10
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                    }

                                    const kategoriFilterEl = $('#kategoriFilter');
                                    const currentKatVal = kategoriFilterEl.val();

                                    kategoriFilterEl.empty().append('<option></option>');
                                    if (data.kategoriList) {
                                        data.kategoriList.forEach(function(kat) {
                                            const option = new Option(kat.nama, kat
                                                .id, false, kat.id ==
                                                currentKatVal);
                                            kategoriFilterEl.append(option);
                                        });
                                    }
                                    kategoriFilterEl.trigger('change');

                                    // Render Sub Kategori Chart
                                    const subCanvas = document.getElementById(
                                        'subKategoriUnitChart');
                                    if (subCanvas) {
                                        if (subKategoriUnitChartInstance) {
                                            subKategoriUnitChartInstance.destroy();
                                            subKategoriUnitChartInstance = null;
                                        }
                                        const subLabels = Array.isArray(data.subLabels) ?
                                            data.subLabels : Object.values(data.subLabels);
                                        const subValues = Array.isArray(data.subValues) ?
                                            data.subValues : Object.values(data.subValues);

                                        subKategoriUnitChartInstance = new Chart(subCanvas
                                            .getContext('2d'), {
                                                type: 'bar',
                                                data: {
                                                    labels: subLabels,
                                                    datasets: [{
                                                        label: 'Jumlah Laporan',
                                                        data: subValues,
                                                        backgroundColor: subLabels
                                                            .map((_, i) =>
                                                                palette[(i +
                                                                        3) %
                                                                    palette
                                                                    .length]),
                                                        borderRadius: 6
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    maintainAspectRatio: false,
                                                    indexAxis: 'y',
                                                    plugins: {
                                                        legend: {
                                                            display: false
                                                        },
                                                        tooltip: tooltipOptions
                                                    },
                                                    scales: {
                                                        x: {
                                                            beginAtZero: true,
                                                            grid: {
                                                                color: colors.gray200
                                                            },
                                                            ticks: {
                                                                stepSize: 1,
                                                                color: colors.gray500
                                                            }
                                                        },
                                                        y: {
                                                            grid: {
                                                                display: false
                                                            },
                                                            ticks: {
                                                                autoSkip: false,
                                                                color: colors.gray700,
                                                                font: {
                                                                    weight: '600',
                                                                    size: 10
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                    }

                                    isFetching = false;
                                });
                            });
                        })
                        .catch(err => {
                            console.error('Error fetching unit chart data:', err);
                            chartPlaceholder.classList.remove('d-none');
                            chartPlaceholder.innerHTML = `
                            <div class="mb-4">
                                <i class="ki-duotone ki-information-3 fs-3x text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <h4 class="text-gray-700 fw-bold">Gagal Memuat Data</h4>
                            <p class="text-gray-400 fs-6">Terjadi kesalahan saat memuat data. Silakan coba lagi.</p>
                        `;
                            isFetching = false;
                        });
                };

                // Gunakan event spesifik Select2 untuk kompatibilitas yang lebih baik
                $(unitSelect).on('select2:select', function(e) {
                    const kategoriFilter = document.getElementById('kategoriFilter');
                    if (kategoriFilter) $(kategoriFilter).val(null).trigger('change.select2');
                    handleUnitChange();
                });
                $(unitSelect).on('select2:clear', function(e) {
                    const kategoriFilter = document.getElementById('kategoriFilter');
                    if (kategoriFilter) $(kategoriFilter).val(null).trigger('change.select2');
                    handleUnitChange();
                });

                $('#kategoriFilter').on('select2:select', function(e) {
                    handleUnitChange();
                });
                $('#kategoriFilter').on('select2:clear', function(e) {
                    handleUnitChange();
                });

                // Auto-trigger jika select sudah ada nilainya saat halaman dimuat
                if (unitSelect.value) {
                    setTimeout(handleUnitChange, 300);
                }
            }
        });

        function downloadChart(canvasId, filename, format) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;

            if (format === 'pdf') {
                if (typeof window.jspdf === 'undefined' && typeof jspdf === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
                    script.onload = function() {
                        downloadChart(canvasId, filename, format);
                    };
                    document.head.appendChild(script);
                    return;
                }
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF('l', 'mm', 'a4');
                const imgData = canvas.toDataURL('image/png');
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save(filename + '.pdf');
            } else {
                const link = document.createElement('a');
                link.download = filename + '.' + format;

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
        }
    </script>
@endsection
