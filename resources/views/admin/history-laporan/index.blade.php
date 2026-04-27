@extends('layouts.main')

@section('title', 'List History Laporan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <style>
        .table-row-dashed tr {
            border-bottom: 1px dashed #cccccc !important;
        }

        #example thead tr th {
            vertical-align: middle;
            border-bottom: 1px dashed #cccccc !important;
        }

        #example th,
        #example td {
            vertical-align: middle !important;
        }

        #example td.dt-control:before,
        #example th.dt-control:before {
            display: none !important;
            content: "" !important;
        }

        #example.dataTable td.dt-control,
        #example.dataTable th.dt-control {
            position: relative !important;
            width: 28px !important;
            min-width: 28px !important;
            padding: 0 !important;
            text-align: center !important;
            vertical-align: middle !important;
        }

        #example.dataTable.collapsed tbody tr:not(.child) td.dt-control:before,
        #example.dataTable.collapsed tbody tr:not(.child) th.dt-control:before {
            display: inline-flex !important;
            content: "+" !important;
            position: absolute !important;
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, calc(-50% + 7px)) !important;
            width: 18px !important;
            height: 18px !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 999px !important;
            color: #fff !important;
            font-weight: 900 !important;
            font-size: 13px !important;
            line-height: 1 !important;
            background: #0d6efd !important;
            box-shadow: 0 0 0 2px #ffffff, 0 2px 6px rgba(0, 0, 0, .18) !important;
        }

        #example.dataTable.collapsed tbody tr.parent td.dt-control:before,
        #example.dataTable.collapsed tbody tr.parent th.dt-control:before {
            content: "–" !important;
            background: #dc3545 !important;
        }

        #example.dataTable td:nth-child(2),
        #example.dataTable th:nth-child(2) {
            padding-left: .25rem !important;
        }

        #example .action-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .5rem .6rem;
            background: #f5f8fa;
            border-radius: .5rem;
            white-space: nowrap;
        }

        #example .action-wrap .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        #example .action-wrap i {
            line-height: 1 !important;
        }
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap gap-3">
                    <div class="page-title d-flex flex-column me-3">
                        <h1 class="text-dark fw-bold fs-3 mb-1">Manajemen History Laporan</h1>
                        <span class="text-muted fw-semibold fs-7">Kelola riwayat penanganan dan hubungkan dengan data laporan</span>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="row g-5 g-xl-10 mb-5">
                        <div class="col-12">
                            <div class="card card-flush h-md-100 shadow-sm border-dark rounded border border-dashed">

                                <div class="card-header pt-6">
                                    <div class="card-title">
                                        <h3 class="card-label fw-bold fs-3 mb-1">List History Laporan</h3>
                                    </div>
                                </div>

                                <div class="separator my-4"></div>

                                <div class="px-9 pb-4">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="fw-bold fs-7 text-gray-700 mb-1 d-block">Kategori:</label>
                                            <select id="filter_kategori"
                                                class="form-select form-select-sm form-select-solid w-100"
                                                data-control="select2"
                                                data-placeholder="Semua Kategori"
                                                data-allow-clear="true">
                                                <option value="">Semua</option>
                                                @foreach ($kategoris as $kat)
                                                    <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="fw-bold fs-7 text-gray-700 mb-1 d-block">Status:</label>
                                            <select id="filter_status"
                                                class="form-select form-select-sm form-select-solid w-100"
                                                data-control="select2"
                                                data-placeholder="Semua Status"
                                                data-allow-clear="true">
                                                <option value="">Semua</option>
                                                <option value="menunggu">Menunggu</option>
                                                <option value="diproses">Diproses</option>
                                                <option value="selesai">Selesai</option>
                                                <option value="ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-4">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="example">
                                        <thead>
                                            <tr class="text-start text-gray-600 fw-semibold fs-7 text-uppercase gs-0">
                                                <th class="text-center p-0" style="width:28px; min-width:28px;"></th>
                                                <th class="text-center ps-1 min-w-175px">Aksi</th>
                                                <th class="min-w-100px">Kode Tiket</th>
                                                <th class="min-w-200px">Judul Laporan</th>
                                                <th class="min-w-150px">Kategori</th>
                                                <th class="min-w-120px">Status</th>
                                                <th class="min-w-150px">Pelapor</th>
                                                <th class="min-w-150px">Unit Penangan</th>
                                                <th class="min-w-150px">Lampiran Bukti</th>
                                                <th class="min-w-200px">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold text-gray-800"></tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.history-laporan.edit')
            @include('admin.history-laporan.show')
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

    @include('admin.history-laporan.script.index')
    @include('admin.history-laporan.script.edit')
    @include('admin.history-laporan.script.show')
@endsection