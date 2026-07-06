@extends('pages.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
            min-height: var(--chart-height);
            height: 100%;
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

        /* Select2 Customization */
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.75rem !important;
            height: 44px !important;
            transition: all 0.3s;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            outline: none;
            position: relative !important;
        }

        .select2-container .select2-selection--single:hover {
            border-color: #cbd5e1 !important;
        }

        .select2-container.select2-container--open .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 42px !important;
            right: 12px !important;
            top: 1px !important;
            position: absolute !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 20px !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            display: none !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow::after {
            content: "";
            display: block;
            width: 14px;
            height: 14px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
            background-size: cover;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            color: #475569 !important;
            font-weight: 500 !important;
            font-size: 0.875rem !important;
            padding-left: 1rem !important;
            padding-right: 2.5rem !important;
            line-height: 42px !important;
            width: 100% !important;
            display: block !important;
        }

        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            margin-top: 4px !important;
            z-index: 9999 !important;
        }

        .select2-container .select2-results__option {
            padding: 0.6rem 1rem !important;
            font-size: 0.875rem !important;
            color: #475569 !important;
            transition: all 0.2s !important;
        }

        .select2-container .select2-results__option--highlighted[aria-selected] {
            background-color: #f1f5f9 !important;
            color: #1e40af !important;
            font-weight: 600 !important;
        }

        .select2-container .select2-results__option[aria-selected=true] {
            background-color: #e0f2fe !important;
            color: #0369a1 !important;
            font-weight: 600 !important;
        }

        .select2-search--dropdown {
            padding: 0.5rem !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            height: 42px !important;
            display: flex !important;
            align-items: center !important;
            margin-right: 0 !important;
            color: #94a3b8 !important;
            font-size: 1.5rem !important;
            position: absolute !important;
            right: 32px !important;
            top: 0 !important;
            z-index: 10 !important;
            background: transparent !important;
        }

        .select2-container .select2-selection--single .select2-selection__clear:hover {
            color: #ef4444 !important;
        }
    </style>
@endsection

@section('content')
    <div class="flex-1" style="background: linear-gradient(160deg, #f0f7ff, #eff6ff 30%, #ffffff 70%, #f0f7ff);">
        <section class="pt-12 lg:pt-16 pb-8 lg:pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="relative overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-sm">
                    <div class="hero-glow w-[250px] h-[250px] -top-20 -right-20 opacity-10"
                        style="background: radial-gradient(circle, #3b82f6, transparent);"></div>
                    <div class="relative z-10 p-8 lg:p-12">
                        <div class="grid lg:grid-cols-12 gap-8 items-center">
                            <div class="lg:col-span-7">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary-surface border border-primary-mist text-primary text-xs font-bold uppercase mb-5">Data
                                    Diperbarui Otomatis</span>
                                <h1 class="font-black text-primary-darker mb-4 leading-tight"
                                    style="font-size:clamp(1.8rem,3.5vw,2.8rem);">
                                    Statistik Laporan <span class="text-primary-light">E-LAPOR</span> UNUJA
                                </h1>
                                <p class="text-slate-500 max-w-xl">Visualisasi data laporan yang telah dipublikasikan — tren
                                    bulanan, distribusi kategori, profil pelapor, dan perbandingan laporan rahasia versus
                                    anonim.</p>
                                <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-3 mt-6">
                                    <div
                                        class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3 bg-primary-surface rounded-xl p-3 sm:px-4 sm:py-3 text-center sm:text-left">
                                        <div
                                            class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div
                                                class="text-[11px] sm:text-xs text-slate-400 font-medium leading-tight mb-0.5">
                                                Tren Bulanan</div>
                                            <div class="text-xs sm:text-sm font-extrabold text-primary-dark leading-tight">
                                                12 bulan</div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3 bg-primary-surface rounded-xl p-3 sm:px-4 sm:py-3 text-center sm:text-left">
                                        <div
                                            class="w-9 h-9 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M23 21v-2a4 4 0 00-3-3.87" />
                                                <path d="M16 3.13a4 4 0 010 7.75" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div
                                                class="text-[11px] sm:text-xs text-slate-400 font-medium leading-tight mb-0.5">
                                                Tipe Pelapor</div>
                                            <div class="text-xs sm:text-sm font-extrabold text-primary-dark leading-tight">
                                                {{ count($tipePelapor) }}
                                                tipe</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-5 flex justify-center lg:justify-end">
                                <div
                                    class="bg-gradient-to-br from-primary to-primary-dark rounded-2xl shadow-lg min-w-[220px] w-full lg:w-auto">
                                    <div class="text-center px-8 py-8">
                                        <div class="font-black text-white counter-value leading-tight"
                                            style="font-size: 3.5rem;" data-target="{{ $totalLaporan }}">0</div>
                                        <div class="text-xs font-bold text-white/60 uppercase mt-3 tracking-wider">Total
                                            Laporan Sekarang</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-10 lg:pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="mb-5">
                    <h2 class="font-black text-primary-darker text-xl">Ringkasan Data Laporan</h2>
                </div>

                <div class="grid lg:grid-cols-3 gap-5 mb-5">
                    <div class="lg:col-span-2">
                        <div class="h-full bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
                            <div class="px-6 pt-6 pb-0">
                                <h3 class="font-extrabold text-primary-dark text-sm mb-0.5">Tren Laporan Bulanan</h3>
                                <span class="text-slate-400 text-xs">Jumlah laporan masuk per bulan — 12 bulan
                                    terakhir</span>
                            </div>
                            <div class="p-6">
                                <div class="flex flex-wrap gap-3 mb-4">
                                    <span class="flex items-center gap-1.5 text-slate-500 text-xs"><span
                                            class="chart-legend-swatch bg-gradient-to-r from-emerald-400 to-emerald-600"></span>Jumlah
                                        laporan</span>
                                </div>
                                <div class="chart-holder chart-holder-trend"><canvas id="trenChart" role="img"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="h-full bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
                            <div class="px-6 pt-6 pb-0">
                                <h3 class="font-extrabold text-primary-dark text-sm mb-0.5">Rahasia vs Anonim</h3>
                                <span class="text-slate-400 text-xs">Pilihan privasi pelapor</span>
                            </div>
                            <div class="p-6">
                                <div id="anonimLegend" class="grid grid-cols-1 gap-3 mb-6"></div>
                                <div class="chart-holder chart-holder-donut"><canvas id="anonimChart"
                                        role="img"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-cols-3 gap-5 mb-5">
                    <div class="lg:col-span-1 order-1 lg:order-2">
                        <div class="h-full bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
                            <div class="px-6 pt-6 pb-0">
                                <h3 class="font-extrabold text-primary-dark text-sm mb-0.5">Tipe Pelapor</h3>
                                <span class="text-slate-400 text-xs">Profil berdasarkan kategori pengguna</span>
                            </div>
                            <div class="p-6">
                                <div id="tipeLegend" class="grid grid-cols-1 gap-3 mb-6"></div>
                                <div class="chart-holder chart-holder-pie"><canvas id="tipePelaporChart"
                                        role="img"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 order-2 lg:order-1">
                        <div
                            class="h-full bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden flex flex-col">
                            <div class="px-6 pt-6 pb-0 flex items-start justify-between gap-3 shrink-0">
                                <div>
                                    <h3 class="font-extrabold text-primary-dark text-sm mb-0.5">Laporan per Kategori</h3>
                                    <span class="text-slate-400 text-xs">Distribusi berdasarkan kategori laporan</span>
                                </div>
                                <div class="w-[200px] lg:w-[280px] shrink-0">
                                    <select id="unitFilter" class="select2-searchable" data-placeholder="Pilih Unit"
                                        data-allow-clear="true">
                                        <option></option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div id="chartPlaceholder"
                                    class="flex-1 flex flex-col justify-center items-center text-center py-12">
                                    <svg class="w-14 h-14 text-slate-200 mb-4" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <h4 class="text-slate-600 font-bold">Pilih Unit Terlebih Dahulu</h4>
                                    <p class="text-slate-400 text-sm max-w-sm mt-1">Silakan pilih unit pada opsi di atas
                                        untuk melihat data grafik kategori dan sub kategori.</p>
                                </div>
                                <div id="kategoriHolder" class="chart-holder chart-holder-bar hidden flex-1"
                                    style="--chart-height: 280px;"><canvas id="kategoriChart" role="img"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="subkategoriRow" class="hidden">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
                        <div class="px-6 pt-6 pb-0 flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-extrabold text-primary-dark text-sm mb-0.5">Laporan per Sub Kategori</h3>
                                <span class="text-slate-400 text-xs">Distribusi berdasarkan sub kategori laporan</span>
                            </div>
                            <div class="w-[200px] lg:w-[280px] shrink-0">
                                <select id="kategoriFilter" class="select2-searchable" data-placeholder="Semua Kategori"
                                    data-allow-clear="true">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="chart-holder chart-holder-bar" id="subKategoriHolder"
                                style="--chart-height: 280px;"><canvas id="subKategoriChart" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/custom/chartjs/chartjs.bundle.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var colors = {
                primary: '#1e40af',
                pLight: '#3b82f6',
                success: '#10b981',
                info: '#06b6d4',
                warning: '#f59e0b',
                danger: '#ef4444',
                dark: '#0f2744',
                body: '#ffffff',
                gray100: '#f1f5f9',
                gray200: '#e2e8f0',
                gray500: '#64748b',
                gray600: '#475569',
                gray700: '#334155'
            };

            Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
            Chart.defaults.color = colors.gray500;
            Chart.defaults.borderColor = colors.gray200;

            function animateCounter(el, target, duration) {
                var formatter = new Intl.NumberFormat('id-ID');
                var startTime = performance.now();

                function update(now) {
                    var progress = Math.min((now - startTime) / duration, 1);
                    var ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    el.textContent = formatter.format(Math.floor(ease * target));
                    if (progress < 1) requestAnimationFrame(update);
                }
                requestAnimationFrame(update);
            }
            var io = new IntersectionObserver(function(entries, obs) {
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

            var tooltip = {
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
            var palette = [colors.primary, colors.success, colors.info, colors.warning, colors.danger, '#8b5cf6',
                '#2dd4bf', '#f97316'
            ];

            function rgba(hex, alpha) {
                var v = hex.replace('#', '');
                return 'rgba(' + parseInt(v.substring(0, 2), 16) + ',' + parseInt(v.substring(2, 4), 16) + ',' +
                    parseInt(v.substring(4, 6), 16) + ',' + alpha + ')';
            }

            function createLegend(el, labels, data, legendColors) {
                labels.forEach(function(label, i) {
                    var item = document.createElement('div');
                    item.className =
                        'flex items-center justify-between w-full gap-2 px-3 py-2 rounded-xl bg-white border border-slate-200 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow hover:border-slate-300 cursor-default';

                    var leftWrapper = document.createElement('div');
                    leftWrapper.className = 'flex items-center gap-2.5 min-w-0';

                    var swatch = document.createElement('span');
                    swatch.className = 'w-2 h-2 rounded-full flex-shrink-0';
                    swatch.style.backgroundColor = legendColors[i % legendColors.length];
                    swatch.style.boxShadow = '0 0 8px ' + legendColors[i % legendColors.length];

                    var textLabel = document.createElement('span');
                    textLabel.className = 'text-slate-600 font-medium text-xs sm:text-sm truncate';
                    textLabel.textContent = label;

                    leftWrapper.appendChild(swatch);
                    leftWrapper.appendChild(textLabel);

                    var numberNode = document.createElement('span');
                    numberNode.className =
                        'text-slate-800 font-black text-xs sm:text-sm bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100 flex-shrink-0 ml-1';
                    numberNode.textContent = data[i];

                    item.appendChild(leftWrapper);
                    item.appendChild(numberNode);

                    el.appendChild(item);
                });
            }

            var trenLabels = {!! json_encode(collect($bulanData)->pluck('bulan')) !!};
            var trenData = {!! json_encode(collect($bulanData)->pluck('jumlah')) !!};
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
                                color: colors.gray500
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

            var tipeLabels = {!! json_encode($tipePelapor->pluck('tipe_pelapor')) !!};
            var tipeData = {!! json_encode($tipePelapor->pluck('jumlah')) !!};
            var tipeColorMap = {
                'Dosen': colors.primary,
                'Mahasiswa': colors.success,
                'Tenaga Pendidik': colors.warning,
                'Masyarakat/Umum': colors.info
            };
            var tipeColors = tipeLabels.map(function(l) {
                return tipeColorMap[l] || colors.danger;
            });
            createLegend(document.getElementById('tipeLegend'), tipeLabels, tipeData, tipeColors);
            new Chart(document.getElementById('tipePelaporChart'), {
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
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip
                    }
                }
            });

            var anonData = [{{ $anonimData['rahasia'] }}, {{ $anonimData['anonim'] }}];
            createLegend(document.getElementById('anonimLegend'), ['Rahasia', 'Anonim'], anonData, [colors.primary,
                colors.success
            ]);
            new Chart(document.getElementById('anonimChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Rahasia', 'Anonim'],
                    datasets: [{
                        data: anonData,
                        backgroundColor: [colors.primary, colors.success],
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

            function makeBarChart(canvasId, labels, data) {
                var maxDataVal = Math.max.apply(null, data.length ? data : [0]);
                var axisMax = maxDataVal > 0 ? maxDataVal : 1;

                return new Chart(document.getElementById(canvasId), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Laporan',
                            data: data,
                            backgroundColor: labels.map(function(_, i) {
                                return palette[i % palette.length];
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
                        layout: {
                            padding: {
                                right: 20
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: axisMax,
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
            }

            var kategoriChartInstance = null,
                subKategoriChartInstance = null;

            function handleUnitFilter() {
                var unitId = document.getElementById('unitFilter').value,
                    kategoriId = document.getElementById('kategoriFilter').value;
                var subkategoriRow = document.getElementById('subkategoriRow'),
                    chartPlaceholder = document.getElementById('chartPlaceholder'),
                    kategoriHolder = document.getElementById('kategoriHolder');
                if (unitId) {
                    var url = '/statistik/data?unit_id=' + unitId + (kategoriId ? '&kategori_id=' + kategoriId :
                        '');
                    fetch(url).then(function(r) {
                        return r.json();
                    }).then(function(data) {
                        chartPlaceholder.classList.add('hidden');
                        kategoriHolder.classList.remove('hidden');
                        kategoriHolder.style.setProperty('--chart-height', Math.max(280, (data
                            .kategoriLabels || []).length * 46) + 'px');
                        if (kategoriChartInstance) kategoriChartInstance.destroy();
                        kategoriChartInstance = makeBarChart('kategoriChart', data.kategoriLabels || [],
                            data.kategoriValues || []);
                        var kf = $('#kategoriFilter');
                        var cv = kf.val();
                        kf.empty().append('<option></option>');
                        (data.kategoriList || []).forEach(function(k) {
                            kf.append(new Option(k.nama, k.id, false, k.id == cv));
                        });
                        kf.trigger('change');
                        if ((data.subLabels || []).length || kategoriId) {
                            subkategoriRow.classList.remove('hidden');
                            document.getElementById('subKategoriHolder').style.setProperty('--chart-height',
                                Math.max(280, (data.subLabels || []).length * 46) + 'px');
                            if (subKategoriChartInstance) subKategoriChartInstance.destroy();
                            subKategoriChartInstance = makeBarChart('subKategoriChart', data.subLabels ||
                            [], data.subValues || []);
                        } else {
                            subkategoriRow.classList.add('hidden');
                        }
                    }).catch(function(e) {
                        console.error('Gagal memuat data statistik:', e);
                    });
                } else {
                    chartPlaceholder.classList.remove('hidden');
                    kategoriHolder.classList.add('hidden');
                    subkategoriRow.classList.add('hidden');
                    $('#kategoriFilter').val(null).trigger('change.select2');
                    if (kategoriChartInstance) {
                        kategoriChartInstance.destroy();
                        kategoriChartInstance = null;
                    }
                    if (subKategoriChartInstance) {
                        subKategoriChartInstance.destroy();
                        subKategoriChartInstance = null;
                    }
                }
            }
            $('#unitFilter').on('select2:select', function() {
                $('#kategoriFilter').val(null).trigger('change.select2');
                handleUnitFilter();
            });
            $('#unitFilter').on('select2:clear', function() {
                $('#kategoriFilter').val(null).trigger('change.select2');
                handleUnitFilter();
            });
            $('#kategoriFilter').on('select2:select', handleUnitFilter);
            $('#kategoriFilter').on('select2:clear', handleUnitFilter);

            if (typeof jQuery !== 'undefined') {
                $('.select2-searchable').select2({
                    width: '100%',
                    minimumResultsForSearch: 0 // Ensure search box is always shown
                });
            }
        });
    </script>
@endsection
