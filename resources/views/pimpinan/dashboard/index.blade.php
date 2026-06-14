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
                                                    Pantau seluruh statistik, status, dan progres penanganan laporan secara terpusat.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center fw-bold px-4 py-2" style="background-color: #F8F9FA; color: #64748B; border-radius: 6px; font-size: 0.95rem;">
                                                <i class="ki-duotone ki-bank me-2" style="color: #64748B;"><span class="path1"></span><span class="path2"></span></i>
                                                Pimpinan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl col-md-6">
                            <a href="{{ route('pimpinan.history-laporan.index') }}"
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
                            <a href="{{ route('pimpinan.history-laporan.index') }}"
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
                            <a href="{{ route('pimpinan.history-laporan.index') }}"
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
                            <a href="{{ route('pimpinan.history-laporan.index') }}"
                                class="card border border-dashed border-gray-400 shadow-sm hover-elevate-up text-decoration-none h-md-100"
                                style="background-color: rgba(114, 57, 234, 0.12) !important;">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="symbol symbol-40px">
                                            <span class="symbol-label bg-info shadow-sm">
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
                            <a href="{{ route('pimpinan.history-laporan.index') }}"
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
                                    <div class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width: 240px; height: 240px;">
                                            <canvas id="unitStatusChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none;">
                                                <div class="text-muted fw-bold fs-8 text-uppercase">Total</div>
                                                <div class="text-gray-900 fw-bolder fs-1">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-3" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#f59e0b"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Menunggu Respons</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $stats['menunggu'] ?? 0 }}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#0ea5e9"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Diproses</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $stats['diproses'] ?? 0 }}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#22c55e"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Selesai</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $stats['selesai'] ?? 0 }}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#ef4444"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Ditolak</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $stats['ditolak'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card h-md-100 h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Informasi Akun Pimpinan</div>
                                    <div class="d-flex flex-column gap-4">
                                        <div class="d-flex align-items-center gap-3 pb-1">
                                            <div class="w-60px h-60px rounded-3 d-inline-flex align-items-center justify-content-center bg-light-primary border border-primary border-opacity-25 text-primary flex-shrink-0">
                                                <i class="ki-duotone ki-profile-user">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <div class="text-gray-500 fw-bold fs-8 text-uppercase mb-1">Akun Aktif</div>
                                                <div class="text-gray-900 fw-bolder fs-5 mb-1">{{ $user->nama }}</div>
                                                <p class="text-gray-600 fs-6 m-0">{{ $user->unit->singkatan ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-3">
                                            <div class="bg-body border border-gray-300 rounded-3 px-4 py-3 hover-elevate-up">
                                                <div class="text-gray-500 fw-bold fs-8 text-uppercase mb-1">Unit</div>
                                                <div class="text-gray-900 fw-bold fs-6 text-break">{{ $user->unit->nama_unit ?? 'N/A' }}</div>
                                            </div>
                                            <div class="bg-body border border-gray-300 rounded-3 px-4 py-3 hover-elevate-up">
                                                <div class="text-gray-500 fw-bold fs-8 text-uppercase mb-1">Nama</div>
                                                <div class="text-gray-900 fw-bold fs-6 text-break">{{ $user->nama }}</div>
                                            </div>
                                            <div class="bg-body border border-gray-300 rounded-3 px-4 py-3 hover-elevate-up">
                                                <div class="text-gray-500 fw-bold fs-8 text-uppercase mb-1">Username</div>
                                                <div class="text-gray-900 fw-bold fs-6 text-break">{{ $user->username }}</div>
                                            </div>
                                            <div class="bg-body border border-gray-300 rounded-3 px-4 py-3 hover-elevate-up">
                                                <div class="text-gray-500 fw-bold fs-8 text-uppercase mb-1">Status Akses</div>
                                                <div class="text-gray-900 fw-bold fs-6 text-break">Aktif Sebagai Akun Pimpinan</div>
                                            </div>
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
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div>
                                            <div class="text-gray-900 fw-bolder fs-5 mb-4 mb-0">Tren Laporan Bulanan</div>
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
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="text-gray-900 fw-bolder fs-5 mb-4 mb-0">Laporan per Kategori</div>
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
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Privasi Laporan</div>
                                    <div class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width:220px;height:220px;">
                                            <canvas id="privasiChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none;">
                                                <div class="text-muted fw-bold fs-8 text-uppercase">Total</div>
                                                <div class="text-gray-900 fw-bolder fs-1">{{ $stats['total'] ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#8b5cf6"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Anonim</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $privasiData['anonim'] ?? 0 }}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:#f59e0b"></span>
                                                <span class="text-gray-600 fw-bold fs-6">Rahasia</span>
                                            </div>
                                            <span class="text-gray-900 fw-bolder text-nowrap">{{ $privasiData['rahasia'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-xl-8">
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="text-gray-900 fw-bolder fs-5 mb-4 mb-0">Laporan per Sub Kategori</div>
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
                            <div class="card h-md-100 border border-dashed border-gray-400">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-5 mb-4">Tipe Pelapor</div>
                                    <div class="position-relative d-flex align-items-center justify-content-center pt-2 pb-4">
                                        <div class="position-relative mx-auto" style="width:220px;height:220px;">
                                            <canvas id="tipePelaporChart"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none;">
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
                        <div class="d-flex align-items-center justify-content-between gap-3 px-4 py-3 bg-light border border-dashed border-gray-300 rounded-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="w-10px h-10px rounded-circle flex-shrink-0" style="background:${tipeColors[i]}"></span>
                                <span class="text-gray-600 fw-bold fs-6">${label}</span>
                            </div>
                            <span class="text-gray-900 fw-bolder text-nowrap">${tipeValues[i]}</span>
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








