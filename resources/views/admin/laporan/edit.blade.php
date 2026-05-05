<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" id="bt_submit_edit" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kode Tiket</span>
                                </label>
                                <input type="text" id="edit_kode_tiket"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Kategori</span>
                                </label>
                                <select name="kategori_id" id="edit_kategori_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" required>
                                    <option value="">-- Pilih Kategori --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Unit Tujuan</span>
                                </label>
                                <input type="text" id="edit_unit_tujuan"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" disabled readonly>
                                <input type="hidden" id="edit_unit_id" name="unit_id">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Status</span>
                                </label>
                                <select name="status" id="edit_status"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" required>
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
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Judul Laporan</span>
                                </label>
                                <input type="text" name="judul_laporan" id="edit_judul_laporan"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Tanggal & Waktu Kejadian</span>
                                </label>
                                <input type="text" id="edit_tgl_kejadian"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" name="tgl_kejadian" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Lokasi Kejadian</span>
                                </label>
                                <input type="text" name="lokasi_kejadian" id="edit_lokasi_kejadian"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Deskripsi Laporan</span>
                                </label>
                                <textarea name="deskripsi_laporan" id="edit_deskripsi_laporan" rows="4"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Nama Pelapor</span>
                                </label>
                                <input type="text" name="nama_pelapor" id="edit_nama_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Email Pelapor</span>
                                </label>
                                <input type="email" name="email_pelapor" id="edit_email_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>No. Telepon Pelapor</span>
                                </label>
                                <input type="text" name="no_telp_pelapor" id="edit_no_telp_pelapor"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Tipe Pelapor</span>
                                </label>
                                <select name="tipe_pelapor" id="edit_tipe_pelapor"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="Dosen">Dosen</option>\r
                                    <option value="Mahasiswa">Mahasiswa</option>\r
                                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>\r
                                    <option value="Masyarakat/Umum">Masyarakat/Umum</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Lampiran File</span>
                                </label>
                                <div id="edit_lampiran_file_preview" class="text-gray-600 fs-8">-</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Privasi Laporan</span>
                                </label>
                                <div class="d-flex gap-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="is_anonymous"
                                            value="t" id="edit_is_anonymous_t">
                                        <span class="form-check-label">Rahasia</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" name="is_anonymous"
                                            value="y" id="edit_is_anonymous_y">
                                        <span class="form-check-label">Anonim</span>
                                    </label>
                                </div>
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
