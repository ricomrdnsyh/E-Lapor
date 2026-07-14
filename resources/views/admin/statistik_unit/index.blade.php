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
                                <div class="d-flex align-items-center gap-3">
                                    <span class="symbol symbol-40px">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-chart-pie-3 text-primary fs-3">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <span class="fs-3 fw-bolder text-gray-900 mb-1">Statistik Laporan</span>
                                        <span class="text-gray-500 fw-semibold fs-7">Pilih rentang tanggal untuk melihat
                                            distribusi laporan di seluruh unit dan sub kategori.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-6">
                            <form id="filterForm">
                                <div class="row align-items-end g-3">
                                    <div class="col-md-5">
                                        <label class="form-label text-gray-700 fw-bold">Dari Tanggal</label>
                                        <div class="position-relative">
                                            <i
                                                class="ki-duotone ki-calendar-8 fs-2 position-absolute top-50 translate-middle-y ms-4">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span>
                                            </i>
                                            <input type="text" id="startDate" class="form-control ps-12"
                                                placeholder="Pilih Tanggal Mulai" required />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label text-gray-700 fw-bold">Sampai Tanggal</label>
                                        <div class="position-relative">
                                            <i
                                                class="ki-duotone ki-calendar-8 fs-2 position-absolute top-50 translate-middle-y ms-4">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span>
                                            </i>
                                            <input type="text" id="endDate" class="form-control ps-12"
                                                placeholder="Pilih Tanggal Selesai" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" id="btnFilter" class="btn btn-primary w-100">
                                            <span class="indicator-label">
                                                <i class="ki-duotone ki-filter fs-2">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                                Filter Data
                                            </span>
                                            <span class="indicator-progress">
                                                Memproses... <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="emptyState"
                        class="card card-flush border border-dashed border-primary shadow-sm py-15 text-center mb-5"
                        style="background-color: rgba(245, 248, 250, 0.5);">
                        <div class="card-body">
                            <div class="mb-7">
                                <div class="symbol symbol-100px symbol-circle">
                                    <div class="symbol-label bg-light-primary" style="border: 2px dashed #009EF7;">
                                        <i class="ki-duotone ki-calendar-8 fs-2qx text-primary">
                                            <span class="path1"></span><span class="path2"></span><span
                                                class="path3"></span><span class="path4"></span><span
                                                class="path5"></span><span class="path6"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-gray-900 fw-bolder fs-2 mb-3">Tentukan Rentang Waktu</h3>
                            <p class="text-gray-500 fs-5 fw-semibold mb-0">
                                Silakan pilih <strong>Tanggal Mulai</strong> dan <strong>Tanggal Selesai</strong> pada form
                                di atas <br>
                                untuk merender visualisasi data statistik dan grafik laporan.
                            </p>
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
                                        <div class="card-toolbar d-flex align-items-center flex-nowrap gap-2">
                                            <select id="filterKategoriUnit" class="form-select form-select-sm w-250px"
                                                data-control="select2">
                                                <option value="all">Semua Kategori</option>
                                                @foreach ($kategoris as $kat)
                                                    <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <span class="card-label fw-bold text-gray-800">Grafik Laporan per
                                                Kategori</span>
                                        </h3>
                                        <div class="card-toolbar d-flex align-items-center flex-nowrap gap-2">
                                            <select id="filterUnitKat" class="form-select form-select-sm w-250px"
                                                data-control="select2">
                                                <option value="all">Semua Unit</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id_unit }}">
                                                        {{ $unit->nama_unit ?: $unit->singkatan }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-light-primary flex-shrink-0"
                                                    data-bs-toggle="dropdown" title="Download">
                                                    <i class="fas fa-bars fs-4"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end min-w-125px">
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('kategoriChart', 'Grafik Kategori', 'png')"
                                                            href="javascript:void(0)">PNG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('kategoriChart', 'Grafik Kategori', 'jpeg')"
                                                            href="javascript:void(0)">JPEG</a></li>
                                                    <li><a class="dropdown-item"
                                                            onclick="downloadChart('kategoriChart', 'Grafik Kategori', 'pdf')"
                                                            href="javascript:void(0)">PDF</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div style="position: relative; height: 400px;">
                                            <canvas id="kategoriChart"></canvas>
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
                                                    <tr class="fw-bold text-muted text-center">
                                                        <th class="min-w-50px text-start">No</th>
                                                        <th class="min-w-200px text-start">Unit Tujuan</th>
                                                        <th class="min-w-100px">Menunggu</th>
                                                        <th class="min-w-100px">Diproses</th>
                                                        <th class="min-w-100px">Selesai</th>
                                                        <th class="min-w-100px">Ditolak</th>
                                                        <th class="min-w-100px">Total Laporan</th>
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
            const btnFilter = document.getElementById('btnFilter');
            const dataContainer = document.getElementById('dataContainer');
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#statistikTable tbody');
            let chartInstance = null;

            if (typeof flatpickr !== 'undefined') {
                flatpickr('#startDate', {
                    dateFormat: "Y-m-d",
                    allowInput: true
                });
                flatpickr('#endDate', {
                    dateFormat: "Y-m-d",
                    allowInput: true
                });
            }

            function fetchAllData(showIndicator = false) {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const unitId = document.getElementById('filterUnitKat').value;
                const kategoriId = document.getElementById('filterKategoriUnit').value;

                if (showIndicator && btnFilter) {
                    btnFilter.setAttribute('data-kt-indicator', 'on');
                    btnFilter.disabled = true;
                }

                fetch(
                        `{{ route('admin.statistik-unit.data') }}?start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&unit_id=${encodeURIComponent(unitId)}&kategori_id=${encodeURIComponent(kategoriId)}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (startDate && endDate) {
                            dataContainer.classList.remove('d-none');
                            emptyState.classList.add('d-none');
                        } else {
                            dataContainer.classList.add('d-none');
                            emptyState.classList.remove('d-none');
                        }

                        updateChart(data.labels, data.values);
                        updateKategoriChart(data.katLabels, data.katValues);
                        updateTable(data.tableData);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert('Gagal mengambil data statistik.');
                    })
                    .finally(() => {
                        if (btnFilter) {
                            btnFilter.removeAttribute('data-kt-indicator');
                            btnFilter.disabled = false;
                        }
                    });
            }

            // Fetch on load without spinner
            fetchAllData(false);

            document.getElementById('filterForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                const start = new Date(startDate);
                const end = new Date(endDate);
                if (start > end) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                    return;
                }

                // Fetch with spinner when button is clicked
                fetchAllData(true);
            });

            $('#filterUnitKat').on('change', function() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const unitId = $(this).val();

                fetch(
                        `{{ route('admin.statistik-unit.kategori-data') }}?start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&unit_id=${encodeURIComponent(unitId)}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        updateKategoriChart(data.katLabels, data.katValues);
                    });
            });

            $('#filterKategoriUnit').on('change', function() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const kategoriId = $(this).val();

                fetch(
                        `{{ route('admin.statistik-unit.unit-data') }}?start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&kategori_id=${encodeURIComponent(kategoriId)}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        updateChart(data.labels, data.values);
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

            let katChartInstance = null;

            function updateKategoriChart(labels, values) {
                const ctx = document.getElementById('kategoriChart');

                if (katChartInstance) {
                    katChartInstance.destroy();
                }

                const successColor = getComputedStyle(document.documentElement).getPropertyValue('--bs-success')
                    .trim() || '#50cd89';

                katChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: values,
                            backgroundColor: successColor,
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
                        '<tr><td colspan="7" class="text-center text-muted">Tidak ada data unit</td></tr>';
                    return;
                }

                tableData.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.classList.add('text-center');
                    tr.innerHTML = `
                    <td class="text-start">
                        <span class="text-gray-800 fw-bold fs-6">${index + 1}</span>
                    </td>
                    <td class="text-start">
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-900 fw-bold fs-6">${item.nama_unit}</span>
                                ${item.singkatan ? `<span class="text-muted fw-semibold text-muted d-block fs-7">${item.singkatan}</span>` : ''}
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-light-warning fs-6 fw-bold px-3 py-2">${item.menunggu}</span>
                    </td>
                    <td>
                        <span class="badge badge-light-info fs-6 fw-bold px-3 py-2">${item.proses}</span>
                    </td>
                    <td>
                        <span class="badge badge-light-success fs-6 fw-bold px-3 py-2">${item.selesai}</span>
                    </td>
                    <td>
                        <span class="badge badge-light-danger fs-6 fw-bold px-3 py-2">${item.ditolak}</span>
                    </td>
                    <td>
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
