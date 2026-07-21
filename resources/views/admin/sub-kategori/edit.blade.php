<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" id="bt_submit_edit" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Nama Sub Kategori</span>
                                </label>
                                <input type="text" name="nama_sub" id="edit_nama_sub"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('nama_sub') is-invalid @enderror"
                                    value="{{ old('nama_sub') }}" required autofocus>

                                @error('nama_sub')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Nama sub kategori wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kategori</span>
                                </label>
                                <select name="kategori_id" id="edit_kategori_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('kategori_id') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}">
                                            {{ $kategori->nama_kategori }} - {{ $kategori->unit->nama_unit ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Kategori wajib dipilih.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Unit <span class="text-muted fw-normal">(opsional)</span></span>
                                </label>
                                <select name="unit_id" id="edit_unit_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('unit_id') is-invalid @enderror"
                                    data-control="select2">
                                    <option value="">-- Pilih Unit (sama dengan kategori jika kosong) --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id_unit }}">
                                            {{ $unit->nama_unit }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('unit_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
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
