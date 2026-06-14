<div class="modal fade" id="form_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail History Laporan</h5>
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
                                    <h6 class="fw-bold fs-6 mb-0 text-primary">Kategori Laporan</h6>
                                </div>
                            </div>
                            <div class="card-body pt-4 pb-7">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Kode Tiket</span>
                                        </label>
                                        <input type="text" id="show_kode_tiket"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Unit Tujuan</span>
                                        </label>
                                        <input type="text" id="show_unit_tujuan"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Kategori Laporan</span>
                                        </label>
                                        <input type="text" id="show_kategori"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Sub Kategori Laporan</span>
                                        </label>
                                        <input type="text" id="show_sub_kategori"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
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
                                            <span>Nama Gedung</span>
                                        </label>
                                        <input type="text" id="show_nama_gedung"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Lantai</span>
                                        </label>
                                        <input type="text" id="show_nama_lantai"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Ruangan</span>
                                        </label>
                                        <input type="text" id="show_nama_ruangan"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
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
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Judul Laporan</span>
                                        </label>
                                        <input type="text" id="show_judul_laporan"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Tanggal & Waktu Kejadian</span>
                                        </label>
                                        <input type="text" id="show_tgl_kejadian"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Status Saat Ini</span>
                                        </label>
                                        <div id="show_status" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark d-flex align-items-center" style="background-color: #e9ecef; cursor: not-allowed; min-height: 34px;"></div>
                                    </div>
                                    <div class="col-12">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Kronologi / Deskripsi</span>
                                        </label>
                                        <textarea id="show_deskripsi_laporan" rows="4" class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark"
                                            disabled></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Lampiran Bukti</span>
                                        </label>
                                        <div id="show_lampiran_laporan" class="text-gray-600 fs-8">-</div>
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
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Privasi Laporan</span>
                                        </label>
                                        <input type="text" id="show_is_anonymous"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Nama Pelapor</span>
                                        </label>
                                        <input type="text" id="show_nama_pelapor"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Email Pelapor</span>
                                        </label>
                                        <input type="text" id="show_email_pelapor"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>No. Telepon Pelapor</span>
                                        </label>
                                        <input type="text" id="show_no_telp_pelapor"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                            <span>Tipe Pelapor</span>
                                        </label>
                                        <input type="text" id="show_tipe_pelapor"
                                            class="form-control form-control-sm fs-sm-8 fs-lg-6 text-dark" disabled>
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
                                        <i class="ki-duotone ki-arrows-circle fs-4 text-white">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <h6 class="fw-bold fs-6 mb-0 text-primary">Riwayat Penanganan</h6>
                                </div>
                            </div>
                            <div class="card-body pt-4 pb-7" id="show_timeline_container">
                                <!-- Timeline will be injected here via AJAX -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

<style>
.track-timeline {
    position: relative;
    display: grid;
    gap: 14px;
    padding-left: 40px;
}
.track-timeline::before {
    content: "";
    position: absolute;
    left: 15px;
    top: 10px;
    bottom: 10px;
    width: 2px;
    background: linear-gradient(180deg, rgba(0, 66, 137, .26), rgba(15, 23, 42, .08));
}
.track-timeline-item {
    position: relative;
    padding: 16px 18px;
    border-radius: 22px;
    background: #fff;
    border: 1px solid #e8edf3;
}
.track-timeline-badge {
    position: absolute;
    left: -40px;
    top: 16px;
    width: 30px;
    height: 30px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e8edf3;
    background: #fff;
    box-shadow: 0 8px 18px rgba(15, 23, 42, .08);
}
.track-timeline-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    flex-wrap: wrap;
}
.track-timeline-item-title {
    color: #0f172a;
    font-size: .98rem;
    font-weight: 800;
    margin-bottom: .35rem;
}
.track-timeline-item-text,
.track-timeline-note {
    color: #64748b;
    font-size: .9rem;
    line-height: 1.75;
}
.track-timeline-note {
    margin-top: .45rem;
    font-size: .8rem;
}
.track-timeline-meta {
    min-width: 150px;
    text-align: right;
}
.track-timeline-date {
    color: #64748b;
    font-size: .8rem;
    font-weight: 700;
    margin-bottom: .45rem;
}
@media (max-width: 991.98px) {
    .track-timeline { padding-left: 0; }
    .track-timeline::before, .track-timeline-badge { display: none; }
    .track-timeline-meta { min-width: 0; text-align: left; }
}
</style>

            <div class="modal-footer py-4">
                <button type="button" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
