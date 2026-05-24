<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" id="bt_submit_edit" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-6 py-5 pb-8" style="max-height: 600px; overflow-y: auto;">
                    <div class="row g-5">

                        <div class="col-12">
                            <div class="card card-flush shadow-sm border border-gray-300 rounded-4 mb-0">
                                <div class="card-header py-3 bg-light-primary border-bottom border-gray-200 rounded-top-4">
                                    <div class="card-title d-flex align-items-center gap-2 mb-0">
                                        <span class="badge badge-primary p-2">
                                            <i class="ki-duotone ki-tag fs-4 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <h6 class="fw-bold fs-6 mb-0 text-primary">Klasifikasi Laporan</h6>
                                    </div>
                                </div>
                                <div class="card-body pt-4 pb-7">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Kode Tiket</span>
                                            </label>
                                            <input type="text" id="edit_kode_tiket"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Unit Tujuan</span>
                                            </label>
                                            <select name="unit_id" id="edit_unit_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" required>
                                                <option value="">-- Pilih Unit --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Kategori Laporan</span>
                                            </label>
                                            <select name="kategori_id" id="edit_kategori_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" required disabled>
                                                <option value="">-- Pilih Unit Terlebih Dahulu --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Sub Kategori Laporan</span>
                                            </label>
                                            <select name="sub_kategori_id" id="edit_sub_kategori_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" disabled>
                                                <option value="">-- Pilih Kategori Terlebih Dahulu --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-flush shadow-sm border border-gray-300 rounded-4 mb-0">
                                <div class="card-header py-3 bg-light-primary border-bottom border-gray-200 rounded-top-4">
                                    <div class="card-title d-flex align-items-center gap-2 mb-0">
                                        <span class="badge badge-primary p-2">
                                            <i class="ki-duotone ki-document fs-4 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <h6 class="fw-bold fs-6 mb-0 text-primary">Detail Laporan</h6>
                                    </div>
                                </div>
                                <div class="card-body pt-4 pb-7">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Judul Laporan</span>
                                            </label>
                                            <input type="text" name="judul_laporan" id="edit_judul_laporan"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Tanggal & Waktu Kejadian</span>
                                            </label>
                                            <input type="text" id="edit_tgl_kejadian"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6" name="tgl_kejadian" required>
                                        </div>
                                        <div class="col-md-6">
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
                                        <div class="col-12">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                                <span>Kronologi / Deskripsi</span>
                                            </label>
                                            <textarea name="deskripsi_laporan" id="edit_deskripsi_laporan" rows="4"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Lampiran Bukti Saat Ini</span>
                                            </label>
                                            <div id="edit_lampiran_file_preview" class="text-gray-600 fs-8">-</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Ganti Lampiran Bukti</span>
                                            </label>
                                            <input type="file" name="lampiran_file" id="edit_lampiran_file"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <small class="text-muted mt-1 d-block">Format: JPG / JPEG / PNG / PDF. Max. 5 MB.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-flush shadow-sm border border-gray-300 rounded-4 mb-0">
                                <div class="card-header py-3 bg-light-primary border-bottom border-gray-200 rounded-top-4">
                                    <div class="card-title d-flex align-items-center gap-2 mb-0">
                                        <span class="badge badge-primary p-2">
                                            <i class="ki-duotone ki-geolocation fs-4 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <h6 class="fw-bold fs-6 mb-0 text-primary">Lokasi Kejadian</h6>
                                    </div>
                                </div>
                                <div class="card-body pt-4 pb-7">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Gedung</span>
                                            </label>
                                            <select name="gedung_id" id="edit_gedung_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2">
                                                <option value="">-- Pilih Gedung --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Lantai</span>
                                            </label>
                                            <select name="lantai_id" id="edit_lantai_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" disabled>
                                                <option value="">-- Pilih Gedung Terlebih Dahulu --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Ruangan</span>
                                            </label>
                                            <select name="ruangan_id" id="edit_ruangan_id"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2" disabled>
                                                <option value="">-- Pilih Lantai Terlebih Dahulu --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-flush shadow-sm border border-gray-300 rounded-4 mb-0">
                                <div class="card-header py-3 bg-light-primary border-bottom border-gray-200 rounded-top-4">
                                    <div class="card-title d-flex align-items-center gap-2 mb-0">
                                        <span class="badge badge-primary p-2">
                                            <i class="ki-duotone ki-user fs-4 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <h6 class="fw-bold fs-6 mb-0 text-primary">Data Pelapor</h6>
                                    </div>
                                </div>
                                <div class="card-body pt-4 pb-7">
                                    <div class="row g-3">
                                        <div class="col-12">
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
                                        <div class="col-md-6">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Nama Pelapor</span>
                                            </label>
                                            <input type="text" name="nama_pelapor" id="edit_nama_pelapor"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Email Pelapor</span>
                                            </label>
                                            <input type="email" name="email_pelapor" id="edit_email_pelapor"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>No. Telepon Pelapor</span>
                                            </label>
                                            <input type="text" name="no_telp_pelapor" id="edit_no_telp_pelapor"
                                                class="form-control form-control-sm fs-sm-8 fs-lg-6">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                                <span>Tipe Pelapor</span>
                                            </label>
                                            <select name="tipe_pelapor" id="edit_tipe_pelapor"
                                                class="form-select form-select-sm fs-sm-8 fs-lg-6" data-control="select2">
                                                <option value="">-- Pilih Tipe --</option>
                                                <option value="Dosen">Dosen</option>
                                                <option value="Mahasiswa">Mahasiswa</option>
                                                <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                                <option value="Masyarakat/Umum">Masyarakat/Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer py-4">
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
