@extends('layouts.main')

@section('title', 'List Laporan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <style>
        /* Essential DataTables responsive +/- toggle fixes (DO NOT REMOVE) */
        .table-row-dashed tr { border-bottom: 1px dashed #cccccc !important; }
        #example thead tr th { vertical-align: middle; border-bottom: 1px dashed #cccccc !important; }
        #example th, #example td { vertical-align: middle !important; }
        #example td.dt-control:before, #example th.dt-control:before { display: none !important; content: "" !important; }
        
        #example.dataTable td.dt-control, #example.dataTable th.dt-control {
            position: relative !important; width: 28px !important; min-width: 28px !important;
            padding: 0 !important; text-align: center !important; vertical-align: middle !important;
        }
        
        #example.dataTable.collapsed tbody tr:not(.child) td.dt-control:before,
        #example.dataTable.collapsed tbody tr:not(.child) th.dt-control:before {
            display: inline-flex !important; content: "+" !important; position: absolute !important;
            left: 50% !important; top: 50% !important; transform: translate(-50%, calc(-50% + 7px)) !important;
            width: 18px !important; height: 18px !important; align-items: center !important;
            justify-content: center !important; border-radius: 999px !important; color: #fff !important;
            font-weight: 900 !important; font-size: 13px !important; line-height: 1 !important;
            background: #0d6efd !important; box-shadow: 0 0 0 2px #ffffff, 0 2px 6px rgba(0, 0, 0, .18) !important;
        }

        #example.dataTable.collapsed tbody tr.parent td.dt-control:before,
        #example.dataTable.collapsed tbody tr.parent th.dt-control:before {
            content: "–" !important; background: #dc3545 !important;
        }

        #example.dataTable td:nth-child(2), #example.dataTable th:nth-child(2) { padding-left: .25rem !important; }

        /* Custom minimal tweaks for actions */
        #example .action-wrap {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
            padding: .5rem; background: #f5f8fa; border-radius: .5rem; white-space: nowrap;
        }
        #example .action-wrap .btn { display: inline-flex; align-items: center; justify-content: center; }
        #example .action-wrap i { line-height: 1 !important; }

        /* Metronic-style enhancements */
        .filter-container {
            background-color: var(--bs-light-primary);
            border-radius: 0.75rem;
            border: 1px dashed var(--bs-primary);
        }
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">



            <div id="kt_app_content" class="app-content flex-column-fluid mt-7">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card shadow-sm border border-dashed border-dark rounded">
                        
                        <div class="card-header border-0 pt-6">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0 text-gray-900">List Laporan</h3>
                            </div>
                        </div>

                        <div class="card-body py-4">
                            <div class="filter-container p-6 mb-7">
                                <div class="d-flex align-items-center mb-4">
                                    <i class="ki-duotone ki-filter fs-3 text-primary me-2"><span class="path1"></span><span class="path2"></span></i>
                                    <h4 class="fw-bold text-primary m-0 fs-5">Filter Data</h4>
                                </div>
                                <div class="row g-5">
                                    <div class="col-12 col-lg-3">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Unit</label>
                                        <select id="filter_unit"
                                            class="form-select form-select-sm"
                                            data-control="select2"
                                            data-placeholder="Pilih Unit"
                                            data-allow-clear="true">
                                            <option value="">Semua</option>
                                            @foreach ($units as $u)
                                                <option value="{{ $u->id_unit }}">{{ $u->nama_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Kategori Laporan</label>
                                        <select id="filter_kategori"
                                            class="form-select form-select-sm"
                                            data-control="select2"
                                            data-placeholder="Pilih Kategori"
                                            data-allow-clear="true">
                                            <option value="">Semua</option>
                                            @foreach ($kategoris as $kat)
                                                <option value="{{ $kat->id_kategori }}" data-unit-id="{{ $kat->unit_id }}">
                                                    {{ $kat->nama_kategori }}{{ $kat->unit ? ' — ' . $kat->unit->nama_unit : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Sub Kategori</label>
                                        <select id="filter_sub_kategori"
                                            class="form-select form-select-sm"
                                            data-control="select2"
                                            data-placeholder="Pilih Sub Kategori"
                                            data-allow-clear="true" disabled>
                                            <option value="">Semua</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Status Penanganan</label>
                                        <select id="filter_status"
                                            class="form-select form-select-sm"
                                            data-control="select2"
                                            data-placeholder="Pilih Status"
                                            data-allow-clear="true">
                                            <option value="">Semua</option>
                                            <option value="menunggu">Menunggu</option>
                                            <option value="diproses">Diproses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Tanggal Awal</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light-primary border-end-0">
                                                <i class="fas fa-calendar-alt text-primary"></i>
                                            </span>
                                            <input type="text" id="filter_start_date" class="form-control form-control-sm border-start-0" placeholder="Pilih Tanggal Awal" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label fw-semibold fs-7 text-gray-700">Tanggal Akhir</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light-primary border-end-0">
                                                <i class="fas fa-calendar-alt text-primary"></i>
                                            </span>
                                            <input type="text" id="filter_end_date" class="form-control form-control-sm border-start-0" placeholder="Pilih Tanggal Akhir" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="example">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center p-0" style="width:28px; min-width:28px;"></th>
                                            <th class="text-center ps-1 min-w-150px">Aksi</th>
                                            <th class="min-w-100px">Kode Tiket</th>
                                            <th class="min-w-150px">Judul Laporan</th>
                                            <th class="min-w-150px">Unit Tujuan</th>
                                            <th class="min-w-150px">Kategori Laporan</th>
                                            <th class="min-w-150px">Sub Kategori</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-150px">Pelapor</th>
                                            <th class="min-w-150px">Tanggal Kejadian</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-800"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.laporan.edit')
            @include('admin.laporan.show')
            @include('layouts.footer')

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/print.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.js') }}"></script>

    @include('admin.laporan.script.index')
    @include('admin.laporan.script.edit')
    @include('admin.laporan.script.show')
@endsection