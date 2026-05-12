<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form action="" method="POST" id="bt_submit_edit" enctype="multipart/form-data" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit History Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @csrf
                @method('PUT')
                <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kode Tiket</span>
                                </label>
                                <input type="text" id="edit_kode_tiket"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kategori</span>
                                </label>
                                <input type="text" id="edit_kategori"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Unit Tujuan</span>
                                </label>
                                <input type="text" id="edit_unit_tujuan"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Judul Laporan</span>
                                </label>
                                <input type="text" id="edit_judul_laporan"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Tanggal & Waktu Kejadian</span>
                                </label>
                                <input type="text" id="edit_tgl_kejadian"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Lokasi Kejadian</span>
                                </label>
                                <input type="text" id="edit_lokasi_kejadian"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Deskripsi Laporan</span>
                                </label>
                                <textarea id="edit_deskripsi_laporan" rows="4" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                    disabled></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Nama Pelapor</span>
                                </label>
                                <input type="text" id="edit_nama_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Email Pelapor</span>
                                </label>
                                <input type="email" id="edit_email_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>No. Telepon Pelapor</span>
                                </label>
                                <input type="text" id="edit_no_telp_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Tipe Pelapor</span>
                                </label>
                                <input type="text" id="edit_tipe_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Lampiran Laporan</span>
                                </label>
                                <div id="edit_lampiran_file_preview" class="text-gray-600 fs-8">-</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Privasi Laporan</span>
                                </label>
                                <input type="text" id="edit_is_anonymous"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Status</span>
                                </label>
                                <select name="status" id="edit_status"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 text-dark"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Lampiran Bukti Penanganan</span>
                                </label>
                                <input type="file" name="lampiran_file" id="edit_lampiran_bukti"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                    accept=".jpg,.jpeg,.png,.pdf">
                                <small class="text-muted mt-1">Format: JPG / JPEG / PNG / PDF. Max. 5 MB. Wajib diunggah saat status diubah menjadi selesai.</small>
                                <div id="edit_lampiran_bukti_preview" class="text-gray-600 fs-8 mt-2">-</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Catatan</span>
                                </label>
                                <textarea name="catatan" id="edit_catatan" rows="4"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                    placeholder="Isi catatan tindak lanjut jika ada..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary fs-sm-8 fs-lg-6" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6" id="btn_submit_edit">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress" style="display: none;">Tunggu sebentar...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
