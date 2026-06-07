@extends('pages.app')

@php
    $akdIcons = ['ki-book', 'ki-notepad-edit', 'ki-chart-simple', 'ki-magnifier'];
    $akdColors = ['primary', 'warning', 'success', 'info'];
    $nonIcons = [
        'ki-home-2',
        'ki-monitor-mobile',
        'ki-wallet',
        'ki-people',
        'ki-shield',
        'ki-flag',
        'ki-dots-circle',
        'ki-handshake',
        'ki-brush',
        'ki-call',
        'ki-trash',
        'ki-archive',
    ];
    $nonColors = [
        'success',
        'info',
        'warning',
        'dark',
        'danger',
        'primary',
        'info',
        'success',
        'danger',
        'warning',
        'primary',
        'dark',
    ];
@endphp

@section('content')
    <section id="kategori" class="py-10 py-lg-15 bg-light">
        <div class="container">

            @if ($kategoriAkademikUnik->isNotEmpty())
                <h4 class="fw-bold text-gray-800 mb-5">
                    <i class="ki-duotone ki-teacher fs-3 text-primary me-2"><span class="path1"></span><span class="path2"></span></i>Bidang Akademik
                </h4>
                <div class="row g-6 mb-10">
                    @foreach ($kategoriAkademikUnik as $k)
                        @php
                            $i = $loop->index;
                            $c = $akdColors[$i % count($akdColors)];
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                                <div class="card-body p-6 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-4 mb-4">
                                        <div class="symbol symbol-45px bg-light-{{ $c }} flex-shrink-0" style="border-radius: 0.75rem;">
                                            <i class="ki-duotone {{ $akdIcons[$i % count($akdIcons)] }} fs-2 text-{{ $c }}">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <div class="fw-bolder text-gray-900 fs-6 mb-1">{{ $k->nama_kategori }}</div>
                                            <div class="text-muted fs-8" style="line-height: 1.4;">Layanan pengaduan dan aspirasi terkait {{ strtolower($k->nama_kategori) }}.</div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mt-auto">
                                        @foreach ($unitAkademik as $u)
                                            <span class="badge badge-light-{{ $c }} rounded-pill fs-8 px-3 py-2">{{ $u->singkatan }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($kategoriNonAkademik->isNotEmpty())
                <h4 class="fw-bold text-gray-800 mb-4">
                    <i class="ki-duotone ki-flag fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>Bidang Non Akademik
                </h4>
                <div class="row g-6">
                    @foreach ($kategoriNonAkademik as $k)
                        @php
                            $i = $loop->index;
                            $c = $nonColors[$i % count($nonColors)];
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <a href="#kategori" class="card h-100 cat-tile text-decoration-none">
                                <div class="card-body p-6 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-4 mb-4">
                                        <div class="symbol symbol-45px bg-light-{{ $c }} flex-shrink-0" style="border-radius: 0.75rem;">
                                            <i class="ki-duotone {{ $nonIcons[$i % count($nonIcons)] }} fs-2 text-{{ $c }}">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </div>
                                        <div>
                                            <div class="fw-bolder text-gray-900 fs-6 mb-1">{{ $k->nama_kategori }}</div>
                                            <div class="text-muted fs-8" style="line-height: 1.4;">Layanan pengaduan dan aspirasi terkait {{ strtolower($k->nama_kategori) }}.</div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mt-auto">
                                        <span class="badge badge-light-{{ $c }} rounded-pill fs-8 px-3 py-2">
                                            <i class="ki-duotone ki-geolocation fs-8 me-1 text-{{ $c }}"></i>
                                            {{ $k->unit?->singkatan ?? ($k->unit?->nama_unit ?? '-') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection
