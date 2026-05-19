@extends('pages.app')

@section('content')
    <section id="buat-laporan" class="py-10 py-lg-15 bg-light">
        <div class="container">
            <div class="row align-items-start g-10">

                <div class="col-lg-5">
                    <div class="mb-7">
                        <div class="hero-badge d-inline-flex align-items-center gap-2 mb-4">
                            <i class="ki-duotone ki-pencil fs-4 text-primary">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span class="fw-semibold text-gray-800">Form Pengaduan & Aspirasi</span>
                        </div>

                        <h2 class="fw-bold text-gray-900 mb-3" style="letter-spacing:-0.03em;">
                            Buat Laporan Baru
                        </h2>
                        <p class="text-muted fs-6 mb-0">
                            Isi data dengan singkat dan jelas. Sertakan bukti agar laporan lebih cepat diverifikasi.
                        </p>
                    </div>

                    <div class="card border-0 shadow-sm bg-white bg-opacity-75 mb-6">
                        <div class="card-body p-7 p-lg-9">

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-6">
                                <div>
                                    <div class="fw-bold text-gray-900 fs-3 mb-1">Panduan cepat</div>
                                    <div class="text-gray-600">Ikuti 4 langkah agar laporan cepat diproses</div>
                                </div>
                                <span class="badge badge-light-primary d-inline-flex align-items-center">
                                    <span class="bullet bullet-dot bg-primary me-2"></span>
                                    Praktis & jelas
                                </span>
                            </div>

                            <div class="timeline-label">
                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">01</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-category fs-2 text-primary">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Pilih unit & kategori</span>
                                            <span class="badge badge-light-primary fs-8 px-3 py-2">Diterima</span>
                                        </div>
                                        <div class="text-gray-600">Pilih unit tujuan, lalu pilih kategori.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">02</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-notepad-edit fs-2 text-warning">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Tulis kronologi</span>
                                            <span class="badge badge-light-warning fs-8 px-3 py-2">Diverifikasi</span>
                                        </div>
                                        <div class="text-gray-600">Apa, kapan, di mana, dampak, dan harapan.</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">03</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-file-added fs-2 text-info">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Upload bukti</span>
                                            <span class="badge badge-light-info fs-8 px-3 py-2">Diproses</span>
                                        </div>
                                        <div class="text-gray-600">Foto/screenshot/PDF (maks. 5MB).</div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-700 fs-6">04</div>
                                    <div class="timeline-badge">
                                        <i class="ki-duotone ki-send fs-2 text-success">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </div>
                                    <div class="timeline-content ps-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                            <span class="fw-bold text-gray-900">Kirim & dapatkan kode tiket</span>
                                            <span class="badge badge-light-success fs-8 px-3 py-2">Selesai</span>
                                        </div>
                                        <div class="text-gray-600">Pantau progres dari menu Lacak.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card elapor-card elapor-card-hover">
                        <div class="card-body p-7 p-lg-9">

                            <div class="d-flex align-items-center justify-content-between mb-6">
                                <div>
                                    <div class="fw-bold fs-4 text-gray-900">Form Laporan</div>
                                    <div class="text-muted">Lengkapi data berikut untuk membuat tiket laporan.</div>
                                </div>
                                <span class="badge badge-light-primary">E-Lapor</span>
                            </div>

                            @php $ssoUser = session('sso_user'); @endphp

                            @if ($ssoUser)
                                <div class="d-flex align-items-start gap-3 p-4 rounded-3 mb-5"
                                    style="background-color: #e8f5e9; border: 1px solid #a5d6a7;">
                                    <i class="fas fa-user-check text-success fs-3 mt-1"></i>
                                    <div>
                                        <span class="fw-bold text-success d-block mb-1">Login via SSO UNUJA</span>
                                        <span class="text-gray-700 fs-7">Halo, <strong>{{ $ssoUser['nama'] }}</strong>! Data
                                            identitas Anda sudah terisi otomatis dari SSO.</span>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data"
                                class="d-flex flex-column gap-5" id="form_laporan">
                                @csrf

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Unit Tujuan</label>
                                        <select id="unit_id" name="unit_id" class="form-select form-select-sm"
                                            data-control="select2" required>
                                            <option value="" disabled selected>Pilih Unit Tujuan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Kategori Laporan</label>
                                        <select id="kategori_id" name="kategori_id" class="form-select form-select-sm"
                                            data-control="select2" required disabled>
                                            <option value="" disabled selected>Pilih unit terlebih dahulu</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="required form-label fw-semibold">Judul Laporan</label>
                                    <input type="text" name="judul_laporan" class="form-control form-control-sm"
                                        placeholder="Contoh: AC Ruang Lab 2 Gedung D tidak berfungsi"
                                        value="{{ old('judul_laporan') }}" required>
                                    <div class="text-muted fs-8 mt-1">Buat judul ringkas dan spesifik.</div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Tanggal & Waktu Kejadian</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt fs-5"></i>
                                            </span>
                                            <input type="text" id="tgl_kejadian" name="tgl_kejadian"
                                                class="form-control form-control-sm" placeholder="Pilih tanggal & waktu"
                                                value="{{ old('tgl_kejadian') }}" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Gedung</label>
                                        <select id="gedung_id" name="gedung_id" class="form-select form-select-sm"
                                            data-control="select2" required>
                                            <option value="" disabled selected>Pilih Gedung</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Lantai</label>
                                        <select id="lantai_id" name="lantai_id" class="form-select form-select-sm"
                                            data-control="select2" required disabled>
                                            <option value="" disabled selected>Pilih gedung terlebih dahulu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Ruangan</label>
                                        <select id="ruangan_id" name="ruangan_id" class="form-select form-select-sm"
                                            data-control="select2" required disabled>
                                            <option value="" disabled selected>Pilih lantai terlebih dahulu</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="required form-label fw-semibold">Kronologi / Deskripsi</label>
                                    <textarea name="deskripsi_laporan" id="desc" rows="5" class="form-control form-control-sm"
                                        placeholder="Tuliskan apa yang terjadi, kronologi, dampak, dan harapan..." required>{{ old('deskripsi_laporan') }}</textarea>
                                    <div class="d-flex justify-content-end mt-1">
                                        <div class="text-muted fs-8"><span id="descCount">0</span>/2000</div>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Lampiran Bukti <span class="text-muted fw-normal">(opsional)</span></label>
                                    <input type="file" name="lampiran_file" id="lampiran_file"
                                        class="form-control form-control-sm" accept=".jpg,.jpeg,.png,.pdf">
                                    <div class="text-muted fs-8 mt-1">
                                        Format: JPG / PNG / PDF. Maksimal ukuran file: <strong>5MB</strong>.
                                    </div>
                                    <div id="file_error" class="text-danger fs-8 mt-1" style="display:none;"></div>
                                </div>

                                <div class="separator"></div>

                                <div>
                                    <div class="fw-bold text-gray-900 mb-2">Privasi Laporan</div>
                                    <div class="d-flex flex-column gap-2">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="is_anonymous"
                                                value="t" checked>
                                            <span class="form-check-label">
                                                <span class="fw-semibold text-gray-800">Rahasia</span>
                                                <span class="text-muted fs-8 d-block">Identitas hanya terlihat petugas
                                                    berwenang.</span>
                                            </span>
                                        </label>


                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="is_anonymous"
                                                value="y" {{ old('is_anonymous') == 'y' ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                <span class="fw-semibold text-gray-800">Anonim</span>
                                                <span class="text-muted fs-8 d-block">Tanpa identitas pelapor (jika
                                                    diizinkan kebijakan).</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div id="anonEmailBlock" style="display:none;">
                                    <label class="form-label fw-semibold">Email <span
                                            class="text-muted fw-normal">(opsional)</span></label>
                                    <input type="email" id="email_anonim" name="email_anonim"
                                        class="form-control form-control-sm" placeholder="nama@gmail.com"
                                        value="{{ old('email_anonim') }}">
                                    <div class="d-flex align-items-start gap-2 mt-2 p-3 rounded-2"
                                        style="background-color: #f1f5ff;">
                                        <i class="fas fa-shield-alt text-primary fs-6 mt-1" style="min-width: 16px;"></i>
                                        <span class="text-muted fs-8">
                                            Alamat email Anda akan dirahasiakan dan hanya digunakan oleh sistem untuk
                                            mengirimkan notifikasi terkait perkembangan progress laporan.
                                        </span>
                                    </div>
                                </div>


                                <div id="identityBlock" class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Nama Pelapor</label>
                                        <input type="text" id="nama_pelapor" name="nama_pelapor"
                                            class="form-control form-control-sm" placeholder="Nama lengkap"
                                            value="{{ $ssoUser['nama'] ?? old('nama_pelapor') }}"
                                            {{ $ssoUser ? 'readonly' : '' }} required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Email</label>
                                        <input type="email" id="email_pelapor" name="email_pelapor"
                                            class="form-control form-control-sm" placeholder="nama@gmail.com"
                                            value="{{ $ssoUser['email'] ?? old('email_pelapor') }}"
                                            {{ $ssoUser && !empty($ssoUser['email']) ? 'readonly' : '' }} required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">No. Telepon</label>
                                        <input type="text" id="no_telp_pelapor" name="no_telp_pelapor"
                                            class="form-control form-control-sm" placeholder="08xxxxxxxxxx"
                                            value="{{ $ssoUser['no_telp'] ?? old('no_telp_pelapor') }}"
                                            {{ $ssoUser && !empty($ssoUser['no_telp']) ? 'readonly' : '' }}>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Profesi/Tipe Pelapor</label>
                                        <select name="{{ $ssoUser ? '' : 'tipe_pelapor' }}" id="tipe_pelapor"
                                            class="form-select form-select-sm" data-control="select2"
                                            {{ $ssoUser ? 'disabled' : '' }}>
                                            <option value="" disabled
                                                {{ !$ssoUser && !old('tipe_pelapor') ? 'selected' : '' }}>
                                                Pilih profesi</option>
                                            <option value="Dosen"
                                                {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Dosen' ? 'selected' : '' }}>
                                                Dosen</option>
                                            <option value="Mahasiswa"
                                                {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Mahasiswa' ? 'selected' : '' }}>
                                                Mahasiswa
                                            </option>
                                            <option value="Tenaga Pendidik"
                                                {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Tenaga Pendidik' ? 'selected' : '' }}>
                                                Tenaga
                                                Pendidik</option>
                                            <option value="Masyarakat/Umum"
                                                {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Masyarakat/Umum' ? 'selected' : '' }}>
                                                Masyarakat/Umum</option>
                                        </select>
                                        @if ($ssoUser)
                                            <input type="hidden" name="tipe_pelapor" value="{{ $ssoUser['tipe'] }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="separator"></div>

                                <div>
                                    <div class="fw-bold text-gray-900 mb-3">Verifikasi Captcha</div>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <div class="bg-light-primary border border-primary border-dashed rounded-3 px-4 py-3 d-flex align-items-center justify-content-center"
                                            style="min-width: 160px;">
                                            <span id="captcha_question" class="fw-bold fs-4 text-primary">Memuat...</span>
                                        </div>
                                        <button type="button" id="btn_refresh_captcha"
                                            class="btn btn-sm btn-icon btn-light-primary" title="Refresh Captcha">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                    <input type="number" name="captcha" id="captcha_answer"
                                        class="form-control form-control-sm" placeholder="Masukkan jawaban" required>
                                </div>

                                <label class="form-check form-check-sm form-check-custom">
                                    <input class="form-check-input" type="checkbox" name="agreement" value="1"
                                        required>
                                    <span class="form-check-label text-muted">
                                        Saya menyatakan informasi yang saya kirimkan benar dan dapat dipertanggungjawabkan.
                                    </span>
                                </label>

                                <div class="d-flex flex-wrap gap-3 pt-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <span class="indicator-label">
                                            <i class="ki-duotone ki-send fs-4 me-2">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                            Kirim Laporan
                                        </span>
                                        <span class="indicator-progress" style="display:none;">
                                            Mengirim...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="text-muted fs-8">
                                    Setelah terkirim, kamu akan mendapatkan <b>kode tiket</b> untuk pelacakan.
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>


        (function() {
            const desc = document.getElementById('desc');
            const descCount = document.getElementById('descCount');
            const radios = document.querySelectorAll('input[name="is_anonymous"]');
            const identityBlock = document.getElementById('identityBlock');
            const anonEmailBlock = document.getElementById('anonEmailBlock');
            const namaPelapor = document.getElementById('nama_pelapor');
            const emailPelapor = document.getElementById('email_pelapor');
            const emailAnonim = document.getElementById('email_anonim');

            function updateCount() {
                const len = (desc?.value || '').length;
                if (descCount) descCount.textContent = len;
                if (len > 2000) desc.value = desc.value.substring(0, 2000);
            }

            function toggleIdentity() {
                const val = document.querySelector('input[name="is_anonymous"]:checked')?.value || 't';
                const isAnon = (val === 'y');

                if (identityBlock) {
                    identityBlock.style.display = isAnon ? 'none' : '';
                    identityBlock.querySelectorAll('input, select').forEach(inp => {
                        if (isAnon) inp.setAttribute('disabled', 'disabled');
                        else inp.removeAttribute('disabled');
                    });
                }

                if (anonEmailBlock) {
                    anonEmailBlock.style.display = isAnon ? '' : 'none';
                    if (emailAnonim) {
                        if (!isAnon) emailAnonim.value = '';
                    }
                }

                if (isAnon) {
                    if (namaPelapor) namaPelapor.value = 'Anonymous';
                    if (emailPelapor) emailPelapor.value = 'Anonymous';
                    document.getElementById('no_telp_pelapor').value = 'Anonymous';
                    document.getElementById('tipe_pelapor').value = '';
                } else {
                    if (namaPelapor && namaPelapor.value === 'Anonymous') namaPelapor.value = '';
                    if (emailPelapor && emailPelapor.value === 'Anonymous') emailPelapor.value = '';
                    const noTelp = document.getElementById('no_telp_pelapor');
                    if (noTelp && noTelp.value === 'Anonymous') noTelp.value = '';
                }

                if (namaPelapor) isAnon ? namaPelapor.removeAttribute('required') : namaPelapor.setAttribute('required',
                    'required');
                if (emailPelapor) isAnon ? emailPelapor.removeAttribute('required') : emailPelapor.setAttribute(
                    'required', 'required');
            }

            if (desc) {
                desc.addEventListener('input', updateCount);
                updateCount();
            }

            radios.forEach(r => r.addEventListener('change', toggleIdentity));
            toggleIdentity();

            const lampiranInput = document.getElementById('lampiran_file');
            const fileError = document.getElementById('file_error');
            const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            const maxSize = 5 * 1024 * 1024;

            if (lampiranInput) {
                lampiranInput.addEventListener('change', function() {
                    const file = this.files[0];
                    fileError.style.display = 'none';
                    fileError.textContent = '';

                    if (!file) return;

                    if (!allowedTypes.includes(file.type)) {
                        fileError.textContent = 'Format file tidak didukung. Gunakan JPG, PNG, atau PDF.';
                        fileError.style.display = 'block';
                        this.value = '';
                        return;
                    }

                    if (file.size > maxSize) {
                        fileError.textContent = 'Ukuran file terlalu besar. Maksimal 5MB.';
                        fileError.style.display = 'block';
                        this.value = '';
                        return;
                    }
                });
            }
        })();

        KTUtil.onDOMContentLoaded(function() {
            const unitSelect = document.getElementById('unit_id');
            const kategoriSelect = document.getElementById('kategori_id');
            const tglKejadianEl = document.querySelector('#tgl_kejadian');

            // Initialize Select2 for Unit
            if (typeof jQuery !== 'undefined' && jQuery(unitSelect).length) {
                jQuery(unitSelect).select2({
                    placeholder: 'Pilih Unit Tujuan',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Initialize Select2 for Kategori (disabled initially)
            if (typeof jQuery !== 'undefined' && jQuery(kategoriSelect).length) {
                jQuery(kategoriSelect).select2({
                    placeholder: 'Pilih Kategori Laporan',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Load Units
            fetch('{{ route('lapor.units') }}')
                .then(res => res.json())
                .then(data => {
                    data.forEach(unit => {
                        const option = document.createElement('option');
                        option.value = unit.id;
                        option.textContent = unit.nama;
                        unitSelect.appendChild(option);
                    });
                });

            // When Unit is selected, load filtered categories
            jQuery(unitSelect).on('select2:select', function() {
                const selectedUnitId = this.value;

                // Reset & disable kategori
                kategoriSelect.innerHTML = '<option value="" disabled selected>Memuat kategori...</option>';
                kategoriSelect.disabled = true;
                jQuery(kategoriSelect).val(null).trigger('change');

                if (!selectedUnitId) return;

                fetch('{{ route('lapor.categories') }}?unit_id=' + selectedUnitId)
                    .then(res => res.json())
                    .then(data => {
                        kategoriSelect.innerHTML = '<option value="" disabled selected>-- Pilih kategori --</option>';

                        data.forEach(cat => {
                            const option = document.createElement('option');
                            option.value = cat.id;
                            option.textContent = cat.nama;
                            kategoriSelect.appendChild(option);
                        });

                        kategoriSelect.disabled = false;
                        jQuery(kategoriSelect).prop('disabled', false).trigger('change');
                    });
            });

            // When Unit is cleared, reset kategori
            jQuery(unitSelect).on('select2:clear', function() {
                kategoriSelect.innerHTML = '<option value="" disabled selected>Pilih unit terlebih dahulu</option>';
                kategoriSelect.disabled = true;
                jQuery(kategoriSelect).val(null).trigger('change');
            });

            // ===== CASCADING: Gedung → Lantai → Ruangan =====
            const gedungSelect = document.getElementById('gedung_id');
            const lantaiSelect = document.getElementById('lantai_id');
            const ruanganSelect = document.getElementById('ruangan_id');

            // Initialize Select2 for Gedung
            if (typeof jQuery !== 'undefined' && jQuery(gedungSelect).length) {
                jQuery(gedungSelect).select2({
                    placeholder: 'Pilih Gedung',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Initialize Select2 for Lantai (disabled initially)
            if (typeof jQuery !== 'undefined' && jQuery(lantaiSelect).length) {
                jQuery(lantaiSelect).select2({
                    placeholder: 'Pilih Lantai',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Initialize Select2 for Ruangan (disabled initially)
            if (typeof jQuery !== 'undefined' && jQuery(ruanganSelect).length) {
                jQuery(ruanganSelect).select2({
                    placeholder: 'Pilih Ruangan',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Load Gedungs
            fetch('{{ route('lapor.gedungs') }}')
                .then(res => res.json())
                .then(data => {
                    data.forEach(gedung => {
                        const option = document.createElement('option');
                        option.value = gedung.id;
                        option.textContent = gedung.nama;
                        gedungSelect.appendChild(option);
                    });
                });

            // Helper: reset lantai & ruangan
            function resetLantai() {
                lantaiSelect.innerHTML = '<option value="" disabled selected>Pilih gedung terlebih dahulu</option>';
                lantaiSelect.disabled = true;
                jQuery(lantaiSelect).val(null).trigger('change');
            }

            function resetRuangan() {
                ruanganSelect.innerHTML = '<option value="" disabled selected>Pilih lantai terlebih dahulu</option>';
                ruanganSelect.disabled = true;
                jQuery(ruanganSelect).val(null).trigger('change');
            }

            // When Gedung is selected, load Lantai
            jQuery(gedungSelect).on('select2:select', function() {
                const selectedGedungId = this.value;
                resetLantai();
                resetRuangan();

                if (!selectedGedungId) return;

                lantaiSelect.innerHTML = '<option value="" disabled selected>Memuat lantai...</option>';

                fetch('{{ route('lapor.lantai') }}?gedung_id=' + selectedGedungId)
                    .then(res => res.json())
                    .then(data => {
                        lantaiSelect.innerHTML = '<option value="" disabled selected>-- Pilih Lantai --</option>';

                        data.forEach(lantai => {
                            const option = document.createElement('option');
                            option.value = lantai.id;
                            option.textContent = lantai.nama;
                            lantaiSelect.appendChild(option);
                        });

                        lantaiSelect.disabled = false;
                        jQuery(lantaiSelect).prop('disabled', false).trigger('change');
                    });
            });

            // When Gedung is cleared
            jQuery(gedungSelect).on('select2:clear', function() {
                resetLantai();
                resetRuangan();
            });

            // When Lantai is selected, load Ruangan
            jQuery(lantaiSelect).on('select2:select', function() {
                const selectedLantaiId = this.value;
                resetRuangan();

                if (!selectedLantaiId) return;

                ruanganSelect.innerHTML = '<option value="" disabled selected>Memuat ruangan...</option>';

                fetch('{{ route('lapor.ruangan') }}?lantai_id=' + selectedLantaiId)
                    .then(res => res.json())
                    .then(data => {
                        ruanganSelect.innerHTML = '<option value="" disabled selected>-- Pilih Ruangan --</option>';

                        data.forEach(ruangan => {
                            const option = document.createElement('option');
                            option.value = ruangan.id;
                            option.textContent = ruangan.nama + (ruangan.fungsi ? ' (' + ruangan.fungsi + ')' : '');
                            ruanganSelect.appendChild(option);
                        });

                        ruanganSelect.disabled = false;
                        jQuery(ruanganSelect).prop('disabled', false).trigger('change');
                    });
            });

            // When Lantai is cleared
            jQuery(lantaiSelect).on('select2:clear', function() {
                resetRuangan();
            });

            if (tglKejadianEl && typeof flatpickr !== 'undefined') {
                flatpickr(tglKejadianEl, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: "Y-m-d H:i",
                    allowInput: true
                });
            }

            function loadCaptcha() {
                fetch('{{ route('lapor.captcha') }}')
                    .then(res => res.json())
                    .then(data => {
                        const el = document.getElementById('captcha_question');
                        if (el) el.textContent = data.question;
                        const input = document.getElementById('captcha_answer');
                        if (input) input.value = '';
                    })
                    .catch(() => {
                        const el = document.getElementById('captcha_question');
                        if (el) el.textContent = 'Gagal memuat';
                    });
            }

            const btnRefresh = document.getElementById('btn_refresh_captcha');
            if (btnRefresh) btnRefresh.addEventListener('click', loadCaptcha);
            loadCaptcha();

            const formLaporan = document.getElementById('form_laporan');
            if (formLaporan) {
                formLaporan.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const captchaInput = document.getElementById('captcha_answer');
                    if (!captchaInput || !captchaInput.value.trim()) {
                        Swal.fire({
                            title: 'Captcha Belum Diisi',
                            text: 'Silakan jawab pertanyaan captcha terlebih dahulu.',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#1F4788'
                        });
                        return;
                    }

                    const fileError = document.getElementById('file_error');
                    if (fileError && fileError.style.display === 'block') {
                        Swal.fire({
                            title: 'File Tidak Valid',
                            text: fileError.textContent,
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#1F4788'
                        });
                        return;
                    }

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const indicatorLabel = submitBtn.querySelector('.indicator-label');
                    const indicatorProgress = submitBtn.querySelector('.indicator-progress');

                    submitBtn.disabled = true;
                    indicatorLabel.style.display = 'none';
                    indicatorProgress.style.display = 'inline-block';

                    fetch('{{ route('lapor.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.content || ''
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw res;
                            return res.json();
                        })
                        .then(data => {
                            submitBtn.disabled = false;
                            indicatorLabel.style.display = 'inline-block';
                            indicatorProgress.style.display = 'none';

                            if (data.success) {
                                Swal.fire({
                                    title: 'Laporan Berhasil Dibuat!',
                                    html: `
                                        <div class="text-start">
                                            <p class="mb-3 fw-semibold text-gray-800">Kode Tiket Anda:</p>
                                            <div class="bg-light-primary p-4 rounded-3 mb-3">
                                                <h5 class="text-center fw-bold fs-2 text-primary" style="user-select:all; cursor:pointer;" title="Klik untuk menyalin">${data.kode_tiket}</h5>
                                            </div>
                                            <div class="d-flex align-items-start gap-2 p-3 rounded-2 mb-3" style="background-color:#fff3cd; border:1px solid #ffecb5;">
                                                <i class="fas fa-exclamation-triangle text-warning fs-4 mt-1" style="min-width:20px;"></i>
                                                <div>
                                                    <span class="fw-bold text-dark d-block mb-1">Penting! Simpan Kode Tiket Ini</span>
                                                    <span class="text-gray-700 fs-7">Harap <b>Catat</b>, <b>Salin</b>, <b>Cek Email</b> kode tiket di atas untuk melacak status laporan Anda.</span>
                                                </div>
                                            </div>
                                        </div>
                                    `,
                                    icon: 'success',
                                    confirmButtonText: 'Lacak Sekarang',
                                    confirmButtonColor: '#1F4788',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = data.redirect;
                                    }
                                });
                            } else {
                                loadCaptcha();
                                Swal.fire({
                                    title: 'Terjadi Kesalahan!',
                                    text: data.message || 'Gagal membuat laporan.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi',
                                    confirmButtonColor: '#F64E60'
                                });
                            }
                        })
                        .catch(async err => {
                            submitBtn.disabled = false;
                            indicatorLabel.style.display = 'inline-block';
                            indicatorProgress.style.display = 'none';
                            loadCaptcha();

                            try {
                                const errData = await err.json();
                                const errors = errData.errors || {};
                                const messages = Object.values(errors).flat();

                                if (messages.length > 0) {
                                    const htmlList = messages.map(m =>
                                        `<li class="text-start">${m}</li>`).join('');
                                    Swal.fire({
                                        title: 'Validasi Gagal!',
                                        html: `<ul class="ps-4 mb-0">${htmlList}</ul>`,
                                        icon: 'warning',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#1F4788'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Terjadi Kesalahan!',
                                        text: errData.message || 'Gagal membuat laporan.',
                                        icon: 'error',
                                        confirmButtonText: 'Coba Lagi',
                                        confirmButtonColor: '#F64E60'
                                    });
                                }
                            } catch {
                                Swal.fire({
                                    title: 'Terjadi Kesalahan!',
                                    text: 'Kesalahan jaringan. Silakan coba lagi.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi',
                                    confirmButtonColor: '#F64E60'
                                });
                            }
                        });
                });
            }
        });
    </script>
@endsection
