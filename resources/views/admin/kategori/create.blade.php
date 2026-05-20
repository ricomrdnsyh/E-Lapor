<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" action="{{ route('admin.kategori.store') }}" id="bt_submit_create" novalidate>
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Kategori</span>
                                </label>
                                <input type="text" name="nama_kategori" id="nama_kategori"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('nama_kategori') is-invalid @enderror"
                                    value="{{ old('nama_kategori') }}" required autofocus>

                                @error('nama_kategori')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Nama kategori wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Unit</span>
                                </label>
                                <select name="unit_id" id="unit_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('unit_id') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id_unit }}"
                                            {{ old('unit_id') == $unit->id_unit ? 'selected' : '' }}>
                                            {{ $unit->nama_unit }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('unit_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Unit wajib dipilih.</div>
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
