@extends('layouts.main')

@section('title', 'Dashboard Unit')

@section('css')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-9">
            <div class="col-md-12">
                <div class="page-title d-flex flex-column">
                    <h1 class="d-flex align-items-center fw-bolder fs-3 my-0">
                        <i class="icon-duotone icon-dashboard me-2"></i>Dashboard
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('unit.dashboard.index') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-6 mb-6">
            {{-- Total Laporan Card --}}
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end"
                    style="background-color: #F3F6F9">
                    <div class="card-body">
                        <i class="ki-duotone ki-element-11 fs-2x opacity-75" style="color: #009EF7">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-dark fw-bolder fs-2 mb-2 mt-5">{{ $stats['total'] ?? 0 }}</div>
                        <div class="fw-bold text-gray-400">Total Laporan</div>
                    </div>
                </div>
            </div>

            {{-- Menunggu Card --}}
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end"
                    style="background-color: #FFF5ED">
                    <div class="card-body">
                        <i class="ki-duotone ki-clock fs-2x opacity-75" style="color: #FFC700">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-dark fw-bolder fs-2 mb-2 mt-5">{{ $stats['menunggu'] ?? 0 }}</div>
                        <div class="fw-bold text-gray-400">Menunggu Respons</div>
                    </div>
                </div>
            </div>

            {{-- Diproses Card --}}
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end"
                    style="background-color: #E7F7FF">
                    <div class="card-body">
                        <i class="ki-duotone ki-timer fs-2x opacity-75" style="color: #50BDEF">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-dark fw-bolder fs-2 mb-2 mt-5">{{ $stats['diproses'] ?? 0 }}</div>
                        <div class="fw-bold text-gray-400">Sedang Diproses</div>
                    </div>
                </div>
            </div>

            {{-- Selesai Card --}}
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end"
                    style="background-color: #E8F5E9">
                    <div class="card-body">
                        <i class="ki-duotone ki-verify fs-2x opacity-75" style="color: #1BC47D">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-dark fw-bolder fs-2 mb-2 mt-5">{{ $stats['selesai'] ?? 0 }}</div>
                        <div class="fw-bold text-gray-400">Selesai</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bold">Informasi Unit</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="fw-bold text-gray-800">Unit:</span>
                                    <span class="text-gray-600">{{ Auth::user()->unit->nama_unit ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <span class="fw-bold text-gray-800">Nama:</span>
                                    <span class="text-gray-600">{{ Auth::user()->nama }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
