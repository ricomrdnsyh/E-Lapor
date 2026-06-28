@extends('layouts.main')

@section('title', 'Panduan')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid mt-7">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-7">
                        <i class="ki-duotone ki-book text-primary fs-2tx me-4">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                        </i>
                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                            <div class="mb-3 mb-md-0 fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Panduan Sistem</h4>
                                <div class="fs-6 text-gray-700 pe-7">Daftar panduan dan petunjuk penggunaan sistem untuk Anda. Pilih tab di bawah ini untuk melihat dokumen panduan yang tersedia.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border border-dashed border-dark rounded">
                        <div class="card-body">
                            @if($panduans->count() > 0)
                                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                    @foreach($panduans as $index => $p)
                                        <li class="nav-item">
                                            <a class="nav-link text-active-primary fw-bolder {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#tab_panduan_{{ $p->id_panduan }}">{{ $p->judul }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    @foreach($panduans as $index => $p)
                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="tab_panduan_{{ $p->id_panduan }}" role="tabpanel">
                                            <div class="border rounded">
                                                <iframe src="{{ asset('storage/' . $p->file) }}" width="100%" height="700px" style="border: none;"></iframe>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-10">
                                    <img src="{{ asset('assets/media/illustrations/sketchy-1/5.png') }}" alt="" class="mw-100 mb-5" style="height: 150px;">
                                    <div class="fs-4 fw-bold text-gray-500">Belum ada panduan tersedia.</div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            
            @include('layouts.footer')
        </div>
    </div>
@endsection
