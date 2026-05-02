@extends('pages.app')

@section('css')
    <style>
        .stat-hero {
            background: linear-gradient(145deg, var(--bs-body-bg) 0%, var(--bs-gray-100) 58%, var(--bs-gray-200) 100%);
        }

        .stat-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(var(--bs-gray-400) 1px, transparent 1px);
            background-size: 22px 22px;
            opacity: .22;
            pointer-events: none;
        }

        .stat-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--bs-body-bg) 0%, transparent 18%, transparent 82%, var(--bs-gray-100) 100%);
            pointer-events: none;
        }

        .stat-blob {
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            filter: blur(1px);
        }

        .stat-total-card {
            min-width: 220px;
        }

        .chart-holder {
            position: relative;
            width: 100%;
        }

        .chart-holder-trend {
            height: 300px;
        }

        .chart-holder-donut {
            height: 260px;
        }

        .chart-holder-bar {
            height: var(--chart-height);
        }

        .chart-holder-pie {
            height: 280px;
        }

        .chart-legend-swatch {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        @media (max-width: 991.98px) {
            .stat-total-card {
                min-width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="bg-light">

        <section class="py-8 py-lg-12">
            <div class="container">
                <div class="card card-flush border-0 shadow-sm overflow-hidden position-relative rounded-4 stat-hero">
                    <span class="stat-blob bg-success opacity-10 w-250px h-250px top-0 end-0 translate-middle-y"></span>
                    <span
                        class="stat-blob bg-primary opacity-10 w-200px h-200px bottom-0 end-100px translate-middle-y"></span>
                    <span class="stat-blob bg-info opacity-10 w-150px h-150px top-50px end-200px"></span>
                    <span
                        class="stat-blob bg-warning opacity-10 w-175px h-175px bottom-0 start-100px translate-middle-y"></span>

                    <div class="card-body p-8 p-lg-12 position-relative" style="z-index:2;">
                        <div class="row align-items-center g-8">
                            <div class="col-lg-7">
                                <div class="badge badge-light-primary fw-bold text-uppercase mb-5">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    Data Publik · Diperbarui Otomatis
                                </div>

                                <h1 class="fw-bolder text-gray-900 mb-4 lh-sm"
                                    style="font-size:clamp(1.8rem,3.5vw,2.8rem);">
                                    Statistik Laporan<br>
                                    <span class="text-primary fw-bolder">E-LAPOR</span> UNUJA
                                </h1>

                                <div class="fs-6 text-gray-600 mw-550px">
                                    Visualisasi data laporan yang telah dipublikasikan — tren bulanan, distribusi kategori,
                                    profil pelapor, dan perbandingan laporan anonim versus terbuka.
                                </div>

                                <div class="d-flex flex-wrap gap-3 mt-7">
                                    <div
                                        class="d-flex align-items-center bg-body border border-gray-300 rounded-3 px-4 py-3 shadow-sm">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-chart-line fs-2 text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fs-8 text-gray-500">Tren Bulanan</div>
                                            <div class="fs-7 fw-bold text-gray-900">12 bulan</div>
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center bg-body border border-gray-300 rounded-3 px-4 py-3 shadow-sm">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-category fs-2 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fs-8 text-gray-500">Kategori</div>
                                            <div class="fs-7 fw-bold text-gray-900">{{ count($laporanPerKategori) }} unit
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center bg-body border border-gray-300 rounded-3 px-4 py-3 shadow-sm">
                                        <div class="symbol symbol-35px me-3">
                                            <div class="symbol-label bg-light-warning">
                                                <i class="ki-duotone ki-people fs-2 text-warning">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fs-8 text-gray-500">Tipe Pelapor</div>
                                            <div class="fs-7 fw-bold text-gray-900">{{ count($tipePelapor) }} tipe</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 d-flex justify-content-lg-end">
                                <div class="card border border-gray-300 shadow-sm rounded-4 stat-total-card">
                                    <div
                                        class="card-body text-center px-8 py-8 border-top border-3 border-primary rounded-top">
                                        <div class="fs-4x fw-bolder text-gray-900 counter-value lh-1"
                                            data-target="{{ $totalLaporan }}">0</div>
                                        <div class="fs-8 fw-bold text-gray-500 text-uppercase mt-3">Total Laporan Masuk
                                        </div>
                                        <div class="separator separator-dashed border-primary opacity-50 w-50 mx-auto mt-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-12">
            <div class="container">
                <div class="mb-8">
                    <h2 class="fs-2 fw-bolder text-gray-900 mb-0">Ringkasan Data Laporan</h2>
                </div>

                <div class="row g-5 mb-5">
                    <div class="col-lg-8">
                        <div class="card card-flush h-100 border border-gray-200 shadow-sm">
                            <div class="card-header align-items-center border-0 pt-6 pb-0">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold text-gray-900 mb-1 fs-5">Tren Laporan Bulanan</h3>
                                    <span class="text-gray-500 fs-7">Jumlah laporan masuk per bulan — 12 bulan
                                        terakhir</span>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="d-flex flex-wrap gap-3 mb-5">
                                    <span class="d-flex align-items-center text-gray-600 fs-7">
                                        <span class="chart-legend-swatch bg-success me-2"></span>
                                        Jumlah laporan
                                    </span>
                                </div>
                                <div class="chart-holder chart-holder-trend">
                                    <canvas id="trenChart" role="img"
                                        aria-label="Grafik garis tren laporan bulanan selama 12 bulan terakhir">
                                        Data tren laporan bulanan.
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-flush h-100 border border-gray-200 shadow-sm">
                            <div class="card-header align-items-center border-0 pt-6 pb-0">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold text-gray-900 mb-1 fs-5">Anonim vs Terbuka</h3>
                                    <span class="text-gray-500 fs-7">Pilihan privasi pelapor</span>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div id="anonimLegend" class="d-flex flex-wrap justify-content-center gap-3 mb-5"></div>
                                <div class="chart-holder chart-holder-donut">
                                    <canvas id="anonimChart" role="img"
                                        aria-label="Diagram donat perbandingan laporan anonim dan terbuka">
                                        Perbandingan laporan anonim dan terbuka.
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="card card-flush h-100 border border-gray-200 shadow-sm">
                            <div class="card-header align-items-center border-0 pt-6 pb-0">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold text-gray-900 mb-1 fs-5">Laporan per Kategori</h3>
                                    <span class="text-gray-500 fs-7">Distribusi berdasarkan kategori laporan</span>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="chart-holder chart-holder-bar"
                                    style="--chart-height: {{ max(280, count($laporanPerKategori) * 46) }}px;">
                                    <canvas id="kategoriChart" role="img"
                                        aria-label="Grafik batang horizontal distribusi laporan per kategori">
                                        Distribusi laporan per kategori.
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-flush h-100 border border-gray-200 shadow-sm">
                            <div class="card-header align-items-center border-0 pt-6 pb-0">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold text-gray-900 mb-1 fs-5">Tipe Pelapor</h3>
                                    <span class="text-gray-500 fs-7">Profil berdasarkan kategori pengguna</span>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div id="tipeLegend" class="d-flex flex-wrap justify-content-center gap-3 mb-5"></div>
                                <div class="chart-holder chart-holder-pie">
                                    <canvas id="tipePelaporChart" role="img"
                                        aria-label="Diagram lingkaran tipe pelapor berdasarkan kategori pengguna">
                                        Profil tipe pelapor.
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

            function animateCounter(el, target, duration) {
                const formatter = new Intl.NumberFormat('id-ID');
                const startTime = performance.now();

                function update(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    el.textContent = formatter.format(Math.floor(ease * target));

                    if (progress < 1) {
                        requestAnimationFrame(update);
                    }
                }

                requestAnimationFrame(update);
            }

            const io = new IntersectionObserver(function(entries, obs) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target, parseInt(entry.target.dataset.target) || 0,
                            2000);
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.3
            });

            document.querySelectorAll('.counter-value').forEach(function(el) {
                io.observe(el);
            });

            const tooltip = {
                backgroundColor: colors.dark,
                titleColor: colors.body,
                bodyColor: colors.gray500,
                padding: 12,
                cornerRadius: 8,
                displayColors: true,
                boxPadding: 5,
                titleFont: {
                    weight: '700',
                    size: 12
                },
                bodyFont: {
                    size: 12
                }
            };

            const palette = [
                colors.primary,
                colors.success,
                colors.info,
                colors.warning,
                colors.danger,
                '#7239ea',
                '#43ced7',
                '#ff6f1e'
            ];

            function rgba(hex, alpha) {
                const value = hex.replace('#', '');
                const r = parseInt(value.substring(0, 2), 16);
                const g = parseInt(value.substring(2, 4), 16);
                const b = parseInt(value.substring(4, 6), 16);
                return `rgba(${r},${g},${b},${alpha})`;
            }

            function createLegend(el, labels, data, legendColors) {
                const total = data.reduce(function(a, b) {
                    return a + Number(b);
                }, 0);

                labels.forEach(function(label, index) {
                    const item = document.createElement('span');
                    const swatch = document.createElement('span');
                    const percent = total > 0 ? Math.round(Number(data[index]) / total * 100) : 0;

                    item.className = 'd-flex align-items-center text-gray-600 fs-7';
                    swatch.className = 'chart-legend-swatch me-2';
                    swatch.style.backgroundColor = legendColors[index % legendColors.length];

                    item.appendChild(swatch);
                    item.appendChild(document.createTextNode(`${label} ${percent}%`));
                    el.appendChild(item);
                });
            }

            const trenLabels = {!! json_encode(collect($bulanData)->pluck('bulan')) !!};
            const trenData = {!! json_encode(collect($bulanData)->pluck('jumlah')) !!};

            new Chart(document.getElementById('trenChart'), {
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
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: colors.gray500,
                                autoSkip: false,
                                maxRotation: 0
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: colors.gray200,
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 11
                                },
                                color: colors.gray500
                            }
                        }
                    }
                }
            });

            const katLabels = {!! json_encode($laporanPerKategori->pluck('nama_kategori')) !!};
            const katData = {!! json_encode($laporanPerKategori->pluck('jumlah_laporan')) !!};

            new Chart(document.getElementById('kategoriChart'), {
                type: 'bar',
                data: {
                    labels: katLabels,
                    datasets: [{
                        label: 'Laporan',
                        data: katData,
                        backgroundColor: katLabels.map(function(_, index) {
                            return palette[index % palette.length];
                        }),
                        borderRadius: 6,
                        borderSkipped: false,
                        barThickness: 24
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
                        tooltip
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: colors.gray200,
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 11
                                },
                                color: colors.gray500
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    weight: '600'
                                },
                                color: colors.gray700
                            }
                        }
                    }
                }
            });

            const tipeLabels = {!! json_encode($tipePelapor->pluck('tipe_pelapor')) !!};
            const tipeData = {!! json_encode($tipePelapor->pluck('jumlah')) !!};
            const tipeColors = [
                colors.primary,
                colors.danger,
                colors.success,
                colors.warning,
                colors.info,
                '#7239ea',
                '#43ced7'
            ];

            const tipeLabelsClean = tipeLabels.map(function(label) {
                return label ? label.charAt(0).toUpperCase() + label.slice(1) : 'Tidak Diketahui';
            });

            createLegend(document.getElementById('tipeLegend'), tipeLabelsClean, tipeData, tipeColors);

            new Chart(document.getElementById('tipePelaporChart'), {
                type: 'pie',
                data: {
                    labels: tipeLabelsClean,
                    datasets: [{
                        data: tipeData,
                        backgroundColor: tipeLabelsClean.map(function(_, index) {
                            return tipeColors[index % tipeColors.length];
                        }),
                        borderColor: colors.body,
                        borderWidth: 3,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip
                    }
                }
            });

            const anonData = [{{ $anonimData['anonim'] }}, {{ $anonimData['terbuka'] }}];
            const anonLabels = ['Anonim', 'Terbuka'];
            const anonColors = [colors.primary, colors.success];

            createLegend(document.getElementById('anonimLegend'), anonLabels, anonData, anonColors);

            new Chart(document.getElementById('anonimChart'), {
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
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip
                    }
                }
            });
        });
    </script>
@endsection
