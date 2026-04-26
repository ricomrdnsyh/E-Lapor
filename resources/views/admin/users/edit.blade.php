<div class="modal fade" id="form_edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" id="bt_submit_edit" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Pilih Karyawan</span>
                                </label>
                                <select name="edit_karyawan_select" id="edit_karyawan_select"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                </select>
                                <input type="hidden" name="nama" id="edit_nama">
                                <div class="invalid-feedback">Karyawan wajib dipilih.</div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Username</span>
                                </label>
                                <input type="text" name="username" id="edit_username"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 bg-light @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" required readonly>

                                @error('username')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Telegram ID</span>
                                </label>
                                <input type="text" name="telegram_id" id="edit_telegram_id"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                    value="{{ old('telegram_id') }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Role</span>
                                </label>
                                <select name="role" id="edit_role"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('role') is-invalid @enderror"
                                    data-control="select2" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="unit">Unit</option>
                                </select>

                                @error('role')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Role wajib dipilih.</div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6" id="edit_unit_wrapper">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Unit</span>
                                </label>
                                <select name="unit_id" id="edit_unit_id"
                                    class="form-select form-select-sm fs-sm-8 fs-lg-6 @error('unit_id') is-invalid @enderror"
                                    data-control="select2">
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                                    @endforeach
                                </select>

                                @error('unit_id')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Unit wajib dipilih untuk role unit.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1">
                                    <span>Password</span>
                                </label>
                                <input type="password" name="password" id="edit_password"
                                    class="form-control form-control-sm fs-sm-8 fs-lg-6 @error('password') is-invalid @enderror">

                                @error('password')
                                    <div class="small text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
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
