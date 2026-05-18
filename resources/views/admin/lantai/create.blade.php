<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" action="{{ route('admin.lantai.store') }}" id="bt_submit_create" novalidate>
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lantai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Lantai</span>
                                </label>
                                <input type="text" name="nama_lantai" id="nama_lantai"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('nama_lantai') is-invalid @enderror"
                                    value="{{ old('nama_lantai') }}" required autofocus maxlength="50">

                                @error('nama_lantai')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Nama lantai wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Gedung</span>
                                </label>
                                <select name="gedung_id" id="gedung_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('gedung_id') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Gedung --</option>
                                    @foreach ($gedungs as $gedung)
                                        <option value="{{ $gedung->id_gedung }}"
                                            {{ old('gedung_id') == $gedung->id_gedung ? 'selected' : '' }}>
                                            {{ $gedung->nama_gedung }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('gedung_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Gedung wajib dipilih.</div>
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
