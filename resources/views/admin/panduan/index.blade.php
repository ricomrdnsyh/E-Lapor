@extends('layouts.main')

@section('title', 'Panduan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
    <style>
        .table-row-dashed tr { border-bottom: 1px dashed #cccccc !important; }
        #table_panduan thead tr th { vertical-align: middle; border-bottom: 1px dashed #cccccc !important; }
        #table_panduan th, #table_panduan td { vertical-align: middle !important; }
        
        #table_panduan td.dt-control:before, #table_panduan th.dt-control:before { display: none !important; content: "" !important; }
        #table_panduan.dataTable td.dt-control, #table_panduan.dataTable th.dt-control {
            position: relative !important; width: 28px !important; min-width: 28px !important; padding: 0 !important; text-align: center !important; vertical-align: middle !important;
        }
        #table_panduan.dataTable.collapsed tbody tr:not(.child) td.dt-control:before,
        #table_panduan.dataTable.collapsed tbody tr:not(.child) th.dt-control:before {
            display: inline-flex !important; content: "+" !important; position: absolute !important; left: 50% !important; top: 50% !important; transform: translate(-50%, calc(-50% + 7px)) !important;
            width: 18px !important; height: 18px !important; align-items: center !important; justify-content: center !important; border-radius: 999px !important; color: #fff !important; font-weight: 900 !important; font-size: 13px !important; line-height: 1 !important; background: #0d6efd !important; box-shadow: 0 0 0 2px #ffffff, 0 2px 6px rgba(0, 0, 0, .18) !important;
        }
        #table_panduan.dataTable.collapsed tbody tr.parent td.dt-control:before,
        #table_panduan.dataTable.collapsed tbody tr.parent th.dt-control:before {
            content: "–" !important; background: #dc3545 !important;
        }
        #table_panduan.dataTable td:nth-child(2), #table_panduan.dataTable th:nth-child(2) { padding-left: .25rem !important; }
        
        #table_panduan .action-wrap {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem; padding: .5rem .6rem; background: #f5f8fa; border-radius: .5rem; white-space: nowrap;
        }
        #table_panduan .action-wrap .btn { display: inline-flex; align-items: center; justify-content: center; }
        #table_panduan .action-wrap i { line-height: 1 !important; }
    </style>
@endsection

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Manajemen Panduan
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">Master Data</li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-primary">Panduan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card shadow-sm border border-dashed border-dark rounded">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0 text-gray-900">List Panduan</h3>
                            </div>
                            <div class="card-toolbar">
                                <a type="button" class="btn btn-sm btn-primary m-0" onclick="addPanduan()" title="Tambah Panduan">
                                    <i class="fas fa-plus me-2"></i>Tambah Panduan
                                </a>
                            </div>
                        </div>

                        <div class="card-body py-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_panduan">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center p-0" style="width:28px; min-width:28px;"></th>
                                            <th class="text-center ps-1 min-w-175px">Aksi</th>
                                            <th class="min-w-200px">Judul</th>
                                            <th class="min-w-100px text-center">File</th>
                                            <th class="min-w-100px text-center">Target</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-800"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.panduan.create')
            @include('admin.panduan.edit')
            @include('layouts.footer')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.js') }}"></script>

    @include('admin.panduan.script.index')
    @include('admin.panduan.script.create')
    @include('admin.panduan.script.edit')
@endsection
