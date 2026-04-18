<div class="modal fade" id="form_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail History Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Kode Tiket</span>
                            </label>
                            <input type="text" id="show_kode_tiket"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Kategori</span>
                            </label>
                            <input type="text" id="show_kategori"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Unit Tujuan</span>
                            </label>
                            <input type="text" id="show_unit_tujuan"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Judul Laporan</span>
                            </label>
                            <input type="text" id="show_judul_laporan"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Tanggal & Waktu Kejadian</span>
                            </label>
                            <input type="text" id="show_tgl_kejadian"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Lokasi Kejadian</span>
                            </label>
                            <input type="text" id="show_lokasi_kejadian"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Deskripsi Laporan</span>
                            </label>
                            <textarea id="show_deskripsi_laporan" rows="4" class="form-control form-control-sm text-black fs-sm-8 fs-lg-6"
                                disabled></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Nama Pelapor</span>
                            </label>
                            <input type="text" id="show_nama_pelapor"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Email Pelapor</span>
                            </label>
                            <input type="text" id="show_email_pelapor"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>No. Telepon Pelapor</span>
                            </label>
                            <input type="text" id="show_no_telp_pelapor"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Tipe Pelapor</span>
                            </label>
                            <input type="text" id="show_tipe_pelapor"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Privasi Laporan</span>
                            </label>
                            <input type="text" id="show_is_anonymous"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Lampiran Laporan</span>
                            </label>
                            <div id="show_lampiran_laporan" class="text-gray-600 fs-8">-</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Status</span>
                            </label>
                            <input type="text" id="show_status"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Lampiran Bukti Penanganan</span>
                            </label>
                            <div id="show_lampiran_bukti" class="text-gray-600 fs-8">-</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>User Penangan</span>
                            </label>
                            <input type="text" id="show_user_penangan"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Catatan</span>
                            </label>
                            <textarea id="show_catatan" rows="3" class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Dibuat</span>
                            </label>
                            <input type="text" id="show_created_at"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2">
                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                <span>Diperbarui</span>
                            </label>
                            <input type="text" id="show_updated_at"
                                class="form-control form-control-sm text-black fs-sm-8 fs-lg-6" disabled>
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
