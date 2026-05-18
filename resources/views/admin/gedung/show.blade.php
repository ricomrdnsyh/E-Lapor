<div class="modal fade" id="form_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Gedung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Nama Gedung</span>
                            </label>
                            <input type="text" id="show_nama_gedung"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Deskripsi</span>
                            </label>
                            <textarea id="show_deskripsi"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" rows="3" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
