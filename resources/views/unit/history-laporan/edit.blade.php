@extends('layouts.main')

@section('title', 'Edit History Laporan')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid mt-7">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <form action="{{ route('unit.history-laporan.update', $history->id_history) }}" method="POST" enctype="multipart/form-data" id="form_edit_history">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="form_status" value="{{ $history->status }}">

                        <div class="row g-5">
                            <div class="col-12">
                                <div class="card shadow-sm border border-dashed border-dark rounded-4 mb-0 overflow-hidden">
                                    <div class="card-header py-3 bg-light-primary border-0">
                                        <div class="card-title d-flex align-items-center gap-2 mb-0">
                                            <span class="badge badge-primary p-2">
                                                <i class="ki-duotone ki-tag fs-4 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <h6 class="fw-bold fs-6 mb-0 text-primary">Kategori Laporan</h6>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 pb-7">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Kode Tiket</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->kode_tiket ?? '-' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Unit Tujuan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->kategori->unit->nama_unit ?? '-' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Kategori Laporan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->kategori->nama_kategori ?? '-' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Sub Kategori Laporan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->subKategori->nama_sub_kategori ?? '-' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow-sm border border-dashed border-dark rounded-4 mb-0 overflow-hidden">
                                    <div class="card-header py-3 bg-light-primary border-0">
                                        <div class="card-title d-flex align-items-center gap-2 mb-0">
                                            <span class="badge badge-primary p-2">
                                                <i class="ki-duotone ki-geolocation fs-4 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <h6 class="fw-bold fs-6 mb-0 text-primary">Lokasi Kejadian</h6>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 pb-7">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Nama Gedung</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->ruangan->lantai->gedung->nama_gedung ?? '-' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Lantai</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->ruangan->lantai->nama_lantai ?? '-' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Ruangan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->ruangan->nama_ruangan ?? '-' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow-sm border border-dashed border-dark rounded-4 mb-0 overflow-hidden">
                                    <div class="card-header py-3 bg-light-primary border-0">
                                        <div class="card-title d-flex align-items-center gap-2 mb-0">
                                            <span class="badge badge-primary p-2">
                                                <i class="ki-duotone ki-document fs-4 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <h6 class="fw-bold fs-6 mb-0 text-primary">Detail Laporan</h6>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 pb-7">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Judul Laporan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->judul_laporan ?? '-' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Tanggal & Waktu Kejadian</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->tgl_kejadian ? \Carbon\Carbon::parse($history->laporan->tgl_kejadian)->translatedFormat('d F Y, H:i') : '-' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Status Saat Ini</span>
                                                </label>
                                                <div class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark d-flex align-items-center" style="background-color: #e9ecef; cursor: not-allowed;">
                                                    @php
                                                        $statusLaporan = $history->status ?? $history->laporan->status ?? '-';
                                                        $badgeClass = 'bg-secondary text-white';
                                                        if ($statusLaporan === 'menunggu') $badgeClass = 'bg-warning text-white';
                                                        elseif ($statusLaporan === 'diproses') $badgeClass = 'bg-info text-white';
                                                        elseif ($statusLaporan === 'selesai') $badgeClass = 'bg-success text-white';
                                                        elseif ($statusLaporan === 'ditolak') $badgeClass = 'bg-danger text-white';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }} px-2 py-1">{{ ucfirst($statusLaporan) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Kronologi / Deskripsi</span>
                                                </label>
                                                <textarea rows="4" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>{{ $history->laporan->deskripsi_laporan ?? '-' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Lampiran Bukti (Awal Laporan)</span>
                                                </label>
                                                <div>
                                                    @if($history->laporan->lampiran_file)
                                                        @php
                                                            $ext = strtolower(pathinfo($history->laporan->lampiran_file, PATHINFO_EXTENSION));
                                                        @endphp
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                                                            <img src="{{ asset('uploads/laporan/' . $history->laporan->lampiran_file) }}" alt="Lampiran" style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #dee2e6;">
                                                        @elseif(in_array($ext, ['pdf']))
                                                            <a href="{{ asset('uploads/laporan/' . $history->laporan->lampiran_file) }}" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-file fs-4 me-1"></i>Lihat File</a>
                                                        @else
                                                            <a href="{{ asset('uploads/laporan/' . $history->laporan->lampiran_file) }}" target="_blank" class="btn btn-sm btn-light-primary">Unduh File</a>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-600 fs-8">-</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow-sm border border-dashed border-dark rounded-4 mb-0 overflow-hidden">
                                    <div class="card-header py-3 bg-light-primary border-0">
                                        <div class="card-title d-flex align-items-center gap-2 mb-0">
                                            <span class="badge badge-primary p-2">
                                                <i class="ki-duotone ki-user fs-4 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <h6 class="fw-bold fs-6 mb-0 text-primary">Data Pelapor</h6>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 pb-7">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Privasi Laporan</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->is_anonymous == 'y' ? 'Anonim' : 'Rahasia' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Nama Pelapor</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->nama_pelapor ?? '-' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Email Pelapor</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->is_anonymous == 'y' ? 'Anonymous' : ($history->laporan->email_pelapor ?? '-') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>No. Telepon Pelapor</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->no_telp_pelapor ?? '-' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Tipe Pelapor</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled value="{{ $history->laporan->tipe_pelapor ?? '-' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow-sm border border-dashed border-dark rounded-4 mb-0 overflow-hidden">
                                    <div class="card-header py-3 bg-light-primary border-0">
                                        <div class="card-title d-flex align-items-center gap-2 mb-0">
                                            <span class="badge badge-primary p-2">
                                                <i class="ki-duotone ki-arrows-circle fs-4 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <h6 class="fw-bold fs-6 mb-0 text-primary">Update Status & Catatan</h6>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 pb-8">
                                        <div class="row g-3">
                                            @if($history->status === 'diproses' || $history->status === 'selesai')
                                            <div class="col-12" id="edit_lampiran_bukti_wrapper">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                    <span>Lampiran Bukti Penanganan</span>
                                                </label>
                                                @if($history->lampiran_file)
                                                    <div id="edit_lampiran_bukti_preview" class="text-gray-600 fs-8 mb-2">
                                                        @php
                                                            $hext = strtolower(pathinfo($history->lampiran_file, PATHINFO_EXTENSION));
                                                        @endphp
                                                        @if(in_array($hext, ['jpg', 'jpeg', 'png']))
                                                            <img src="{{ asset('uploads/history-laporan/' . $history->lampiran_file) }}" alt="Lampiran" style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #dee2e6;">
                                                        @elseif(in_array($hext, ['pdf']))
                                                            <a href="{{ asset('uploads/history-laporan/' . $history->lampiran_file) }}" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-file fs-4 me-1"></i>Lihat File</a>
                                                        @else
                                                            <a href="{{ asset('uploads/history-laporan/' . $history->lampiran_file) }}" target="_blank" class="btn btn-sm btn-light-primary">Unduh File</a>
                                                        @endif
                                                    </div>
                                                @endif
                                                <input type="file" name="lampiran_file" id="edit_lampiran_bukti"
                                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                                    accept=".jpg,.jpeg,.png,.pdf">
                                                <small class="text-muted mt-1 d-block">Format: JPG / JPEG / PNG / PDF. Maksimal ukuran file: <b>5MB</b>.</small>
                                                @error('lampiran_file')
                                                    <div class="text-danger mt-1 fs-8">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @endif

                                            <div class="col-12">
                                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                    <span>Catatan Tindak Lanjut</span>
                                                </label>
                                                <textarea name="catatan" id="edit_catatan" rows="4"
                                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                                    placeholder="Isi catatan tindak lanjut jika ada...">{{ old('catatan', $history->catatan) }}</textarea>
                                                @error('catatan')
                                                    <div class="text-danger mt-1 fs-8">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-8 d-flex justify-content-end gap-2">
                                            @if($history->status === 'menunggu')
                                                <button type="button" class="btn btn-danger btn-sm fs-sm-8 fs-lg-6 btn-submit-status" data-status="ditolak">
                                                    <i class="fas fa-times me-1"></i> Tolak Laporan
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm fs-sm-8 fs-lg-6 btn-submit-status" data-status="diproses">
                                                    <i class="fas fa-spinner me-1"></i> Proses Laporan
                                                </button>
                                            @elseif($history->status === 'diproses')
                                                <button type="button" class="btn btn-danger btn-sm fs-sm-8 fs-lg-6 btn-submit-status" data-status="ditolak">
                                                    <i class="fas fa-times me-1"></i> Tolak Laporan
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm fs-sm-8 fs-lg-6 btn-submit-status" data-status="selesai">
                                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.btn-submit-status').click(function(e) {
            e.preventDefault();
            var status = $(this).data('status');
            var form = $('#form_edit_history');
            var btn = $(this);

            // Validation for Selesai
            if (status === 'selesai') {
                var fileInput = $('#edit_lampiran_bukti');
                var hasExistingFile = {!! json_encode(!empty($history->lampiran_file)) !!};

                if (!hasExistingFile && (!fileInput.length || !fileInput[0].files.length)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lampiran wajib diisi',
                        text: 'Lampiran file wajib diunggah ketika status diubah menjadi selesai.'
                    });
                    fileInput.addClass('is-invalid');
                    return;
                }
            }

            var confirmText = '';
            if (status === 'ditolak') confirmText = 'Anda akan menolak laporan ini.';
            else if (status === 'diproses') confirmText = 'Anda akan memproses laporan ini.';
            else if (status === 'selesai') confirmText = 'Anda akan menyelesaikan laporan ini.';

            var confirmBtnClass = 'btn-primary';
            if (status === 'ditolak') confirmBtnClass = 'btn-danger';
            else if (status === 'selesai') confirmBtnClass = 'btn-success';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: confirmText,
                icon: 'question',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn fw-bold ' + confirmBtnClass,
                    cancelButton: 'btn fw-bold btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_status').val(status);

                    // Show loading
                    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                    $('.btn-submit-status').prop('disabled', true);

                    form.submit();
                }
            });
        });

        @if ($errors->any())
            Swal.fire({
                text: @json($errors->first()),
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-sm btn-danger"
                }
            });
        @endif
    });
</script>
@endsection
