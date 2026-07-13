@extends('layouts.main')

@section('title', 'Statistik')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid mt-7">
                <div id="kt_app_content_container" class="app-container container-fluid">

                    <div class="card card-flush border border-dashed border-gray-400 mb-7">
                        <div class="card-header pt-6 pb-4">
                            <div class="card-title d-flex flex-column">
                                <h3 class="fw-bold mb-1">Statistik Laporan Berdasarkan Kategori</h3>
                                <div class="fs-6 text-gray-400">Pilih kategori untuk melihat distribusi laporan di seluruh
                                    unit.</div>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-6">
                            <select id="kategoriFilter" class="form-select w-100" data-allow-clear="true"
                                data-control="select2" data-placeholder="Pilih Kategori">
                                <option></option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="dataContainer" class="d-none">
                        <div class="row g-5 g-xl-10 mb-5">
                            <div class="col-xl-12">
                                <div class="card card-flush border border-dashed border-gray-400 h-md-100">
                                    <div class="card-header pt-7 align-items-center">
                                        <h3 class="card-title align-items-start flex-column mb-0">
                                            <span class="card-label fw-bold text-gray-800">Grafik Laporan per Unit</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                    data-bs-toggle="dropdown" title="Download">
                                                    <i class="fas fa-bars fs-4"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('statistikChart', 'Grafik Statistik Unit', 'png')"
                                                            href="javascript:void(0)">PNG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('statistikChart', 'Grafik Statistik Unit', 'jpeg')"
                                                            href="javascript:void(0)">JPEG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('statistikChart', 'Grafik Statistik Unit', 'pdf')"
                                                            href="javascript:void(0)">PDF</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div style="position: relative; height: 350px;">
                                            <canvas id="statistikChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-5 g-xl-10 mb-5">
                            <div class="col-xl-12">
                                <div class="card card-flush border border-dashed border-gray-400 h-md-100">
                                    <div class="card-header pt-7 align-items-center">
                                        <h3 class="card-title align-items-start flex-column mb-0">
                                            <span class="card-label fw-bold text-gray-800">Grafik Laporan per Sub
                                                Kategori</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                    data-bs-toggle="dropdown" title="Download">
                                                    <i class="fas fa-bars fs-4"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('subKategoriChart', 'Grafik Sub Kategori', 'png')"
                                                            href="javascript:void(0)">PNG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('subKategoriChart', 'Grafik Sub Kategori', 'jpeg')"
                                                            href="javascript:void(0)">JPEG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('subKategoriChart', 'Grafik Sub Kategori', 'pdf')"
                                                            href="javascript:void(0)">PDF</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div style="position: relative; height: 350px;">
                                            <canvas id="subKategoriChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-5 g-xl-10">
                            <div class="col-xl-12">
                                <div class="card card-flush border border-dashed border-gray-400">
                                    <div class="card-header pt-7">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Tabel Rincian Laporan</span>
                                        </h3>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                                                id="statistikTable">
                                                <thead>
                                                    <tr class="fw-bold text-muted">
                                                        <th class="min-w-50px">No</th>
                                                        <th class="min-w-200px">Unit Tujuan</th>
                                                        <th class="min-w-100px text-center">Total Laporan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data akan diisi via JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="emptyState" class="card card-flush border border-dashed border-gray-400 py-12 text-center">
                        <div class="card-body">
                            <div class="mb-4">
                                <i class="ki-duotone ki-abstract-26 fs-3x text-muted">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </div>
                            <h4 class="text-gray-700 fw-bold">Pilih Kategori Terlebih Dahulu</h4>
                            <p class="text-gray-400 fs-6">Silakan pilih kategori pada dropdown di atas untuk melihat data
                                statistik unit.</p>
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
            const kategoriFilter = $('#kategoriFilter');
            const dataContainer = document.getElementById('dataContainer');
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#statistikTable tbody');
            let chartInstance = null;

            kategoriFilter.on('change', function() {
                const namaKategori = $(this).val();

                if (!namaKategori) {
                    dataContainer.classList.add('d-none');
                    emptyState.classList.remove('d-none');
                    return;
                }

                // Tampilkan loading state atau blockUI jika perlu (opsional)

                fetch(
                        `{{ route('admin.statistik-unit.data') }}?nama_kategori=${encodeURIComponent(namaKategori)}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        dataContainer.classList.remove('d-none');
                        emptyState.classList.add('d-none');

                        updateChart(data.labels, data.values);
                        updateSubKategoriChart(data.subLabels, data.subValues);
                        updateTable(data.tableData);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert('Gagal mengambil data statistik.');
                    });
            });

            function updateChart(labels, values) {
                const ctx = document.getElementById('statistikChart');

                if (chartInstance) {
                    chartInstance.destroy();
                }

                const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--bs-primary')
                    .trim() || '#009ef7';

                chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: values,
                            backgroundColor: primaryColor,
                            borderRadius: 4,
                            barPercentage: 0.6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            let subChartInstance = null;

            function updateSubKategoriChart(labels, values) {
                const ctx = document.getElementById('subKategoriChart');

                if (subChartInstance) {
                    subChartInstance.destroy();
                }

                const infoColor = getComputedStyle(document.documentElement).getPropertyValue('--bs-info')
                    .trim() || '#7239ea';

                subChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: values,
                            backgroundColor: infoColor,
                            borderRadius: 4,
                            barPercentage: 0.6
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            function updateTable(tableData) {
                tableBody.innerHTML = '';

                if (tableData.length === 0) {
                    tableBody.innerHTML =
                        '<tr><td colspan="3" class="text-center text-muted">Tidak ada data unit</td></tr>';
                    return;
                }

                tableData.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>
                        <span class="text-gray-800 fw-bold fs-6">${index + 1}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-900 fw-bold fs-6">${item.nama_unit}</span>
                                ${item.singkatan ? `<span class="text-muted fw-semibold text-muted d-block fs-7">${item.singkatan}</span>` : ''}
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-light-primary fs-6 fw-bold px-3 py-2">${item.total}</span>
                    </td>
                `;
                    tableBody.appendChild(tr);
                });
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
