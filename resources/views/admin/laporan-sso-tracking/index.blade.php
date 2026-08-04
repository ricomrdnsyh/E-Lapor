@extends('layouts.main')

@section('title', 'Tracking Laporan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <style>
        .table-row-dashed tr {
            border-bottom: 1px dashed #cccccc !important;
        }

        #sso-tracking-table thead tr th {
            vertical-align: middle;
            border-bottom: 1px dashed #cccccc !important;
        }

        #sso-tracking-table th,
        #sso-tracking-table td {
            vertical-align: middle !important;
        }

        #sso-tracking-table td.dt-control:before,
        #sso-tracking-table th.dt-control:before {
            display: none !important;
            content: "" !important;
        }

        #sso-tracking-table.dataTable td.dt-control,
        #sso-tracking-table.dataTable th.dt-control {
            position: relative !important;
            width: 28px !important;
            min-width: 28px !important;
            padding: 0 !important;
            text-align: center !important;
            vertical-align: middle !important;
        }

        #sso-tracking-table.dataTable.collapsed tbody tr:not(.child) td.dt-control:before,
        #sso-tracking-table.dataTable.collapsed tbody tr:not(.child) th.dt-control:before {
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

        #sso-tracking-table.dataTable.collapsed tbody tr.parent td.dt-control:before,
        #sso-tracking-table.dataTable.collapsed tbody tr.parent th.dt-control:before {
            content: "–" !important;
            background: #dc3545 !important;
        }

        #sso-tracking-table.dataTable td:nth-child(2),
        #sso-tracking-table.dataTable th:nth-child(2) {
            padding-left: .25rem !important;
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
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Tracking Laporan</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-5"></div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="sso-tracking-table">
                                    <thead class="">
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="text-center p-0" style="width:28px; min-width:28px;"></th>
                                            <th class="min-w-100px">Kode Tiket</th>
                                            <th class="min-w-150px">Judul Laporan</th>
                                            <th class="min-w-100px">NIM / NIP SSO</th>
                                            <th class="min-w-150px">Nama SSO</th>
                                            <th class="min-w-100px">Status Laporan</th>
                                            <th class="min-w-150px">Waktu Tracking</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-800"></tbody>
                                </table>
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
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#sso-tracking-table').DataTable({
                processing: false,
                serverSide: true,
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                },
                columnDefs: [{
                    targets: 0,
                    className: 'dt-control',
                    orderable: false,
                    searchable: false
                }],
                searchHighlight: true,
                lengthMenu: [
                    [10, 15, 20, 25],
                    [10, 15, 20, 25]
                ],
                ajax: {
                    url: '{{ route('admin.sso-tracking.data') }}',
                },
                columns: [{
                        data: null,
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_tiket',
                        name: 'kode_tiket'
                    },
                    {
                        data: 'judul_laporan',
                        name: 'judul_laporan'
                    },
                    {
                        data: 'sso_nim_nip',
                        name: 'sso_nim_nip'
                    },
                    {
                        data: 'sso_nama',
                        name: 'sso_nama'
                    },
                    {
                        data: 'status_laporan',
                        name: 'status_laporan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                language: {
                    processing: "Memproses...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data yang tersedia pada tabel ini"
                },
                order: [
                    [6, 'desc']
                ] // Order by created_at by default
            });
        });
    </script>
@endsection
