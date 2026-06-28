<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" action="{{ route('admin.panduan.store') }}" id="bt_submit_create" novalidate>
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Panduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Judul Panduan</span>
                                </label>
                                <input type="text" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                    name="judul" id="judul" required autofocus>
                                <div class="invalid-feedback">Judul panduan wajib diisi.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span class="required" id="label_file">Upload File (PDF, Max 10MB)</span>
                                </label>
                                <input type="file" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                    name="file" id="file" accept="application/pdf" required>
                                <div class="text-muted fs-8 mt-1" id="file_help">Format yang didukung: PDF.</div>
                                <div class="invalid-feedback">File panduan wajib diunggah.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Target Audience</span>
                                </label>
                                <select class="form-select form-select-sm fs-sm-8 fs-lg-6" name="target_audience"
                                    id="target_audience_create" data-control="select2"
                                    data-dropdown-parent="#form_create" data-placeholder="Pilih target audience" data-allow-clear="true" required>
                                    <option value=""></option>
                                    <option value="semua">Semua</option>
                                    <option value="unit">Unit</option>
                                    <option value="pimpinan">Pimpinan</option>
                                </select>
                                <div class="invalid-feedback">Target audience wajib dipilih.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fs-sm-8 fs-lg-6" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6">
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
