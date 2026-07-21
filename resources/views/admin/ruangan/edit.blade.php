<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" id="bt_submit_edit" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Ruangan</span>
                                </label>
                                <input type="text" name="nama_ruangan" id="edit_nama_ruangan"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('nama_ruangan') is-invalid @enderror"
                                    value="{{ old('nama_ruangan') }}" required autofocus maxlength="100">

                                @error('nama_ruangan')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Nama ruangan wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Lantai</span>
                                </label>
                                <select name="lantai_id" id="edit_lantai_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('lantai_id') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Lantai --</option>
                                    @foreach ($lantais as $lantai)
                                        <option value="{{ $lantai->id_lantai }}">
                                            {{ $lantai->nama_lantai }} - {{ $lantai->gedung->nama_gedung ?? '' }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('lantai_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Lantai wajib dipilih.</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Fungsi Ruangan</span>
                                </label>
                                <select name="jenis_ruangan" id="edit_jenis_ruangan"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('jenis_ruangan') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Fungsi --</option>
                                    @foreach ($fungsiRuangans as $fungsi)
                                        <option value="{{ $fungsi->id_fungsi }}">
                                            {{ $fungsi->nama_fungsi }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('jenis_ruangan')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Fungsi ruangan wajib dipilih.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fs-sm-8 fs-lg-6" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" data-kt-contacts-type="submit"
                        class="btn btn-sm btn-primary fs-sm-8 fs-lg-6">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress" style="display:none;">
                            Tunggu sebentar...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
