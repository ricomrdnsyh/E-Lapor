<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" action="{{ route('admin.unit.store') }}" id="bt_submit_create" novalidate>
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Unit</span>
                                </label>
                                <input type="text" name="nama_unit" id="nama_unit"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('nama_unit') is-invalid @enderror"
                                    value="{{ old('nama_unit') }}" required autofocus>

                                @error('nama_unit')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Nama unit wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Deskripsi</span>
                                </label>
                                <textarea name="deskripsi" id="deskripsi" rows="2"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Deskripsi mitra wajib diisi.</div>
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
                        <span class="indicator-label">Simpan</span>
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
