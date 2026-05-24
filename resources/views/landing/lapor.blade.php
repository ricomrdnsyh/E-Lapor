@extends('pages.app')

@section('content')
    <style>
        .ep-accent {
            position: relative;
            display: inline-block;
        }

        .ep-accent::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #1F4788, #FFC107);
            border-radius: 2px;
        }

        .card {
            border: 1px dashed #cbd5e0 !important;
        }

        .card-header h6 {
            font-weight: 700 !important;
        }

        .card label.fs-7,
        .card .form-label {
            font-weight: 700 !important;
        }

        .ep-stepper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .ep-step-item {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .ep-step-badge {
            width: 26px;
            height: 26px;
            font-size: 12px;
            flex: 0 0 26px;
        }

        .ep-step-label {
            color: #7e8299;
            font-weight: 700;
            line-height: 1.2;
        }

        .ep-step-line {
            width: 28px;
            border-top: 1.5px dashed #cbd5e0;
        }

        .ep-submit-note {
            line-height: 1.5;
            text-align: center;
        }

        .ep-privacy-opt {
            flex: 1;
            border: 1px solid #e4e6ef;
            border-radius: 8px;
            padding: 10px 14px;
            cursor: pointer;
            transition: border-color .15s, background .15s;
        }

        .ep-privacy-opt.active {
            border-color: #1F4788;
            background: #e8f0fe;
        }

        .ep-privacy-opt input {
            display: none;
        }

        .ep-privacy-opt .ep-pt {
            font-size: 13px;
            font-weight: 700;
            color: #181c32;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ep-privacy-opt.active .ep-pt {
            color: #1F4788;
        }

        .ep-privacy-opt .ep-pd {
            font-size: 12px;
            color: #7e8299;
        }

        @media (max-width: 575.98px) {
            .ep-hero {
                min-height: 180px !important;
            }

            .ep-stepper {
                flex-wrap: nowrap;
                justify-content: flex-start;
                overflow-x: auto;
                overflow-y: hidden;
                gap: .4rem;
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
                margin-left: -.25rem;
                margin-right: -.25rem;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .ep-stepper::-webkit-scrollbar {
                display: none;
            }

            .ep-step-item {
                flex: 0 0 auto;
                display: flex;
                align-items: center;
                gap: .35rem;
                min-width: max-content;
            }

            .ep-step-badge {
                width: 23px;
                height: 23px;
                font-size: 11px;
                flex: 0 0 23px;
            }

            .ep-step-label {
                display: inline-block !important;
                font-size: 11px;
                white-space: nowrap;
                line-height: 1.2;
            }

            .ep-step-line {
                display: block;
                width: 16px;
                flex: 0 0 16px;
                border-top: 1.5px dashed #cbd5e0;
            }

            .ep-submit-note {
                display: flex !important;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                gap: .25rem;
                line-height: 1.5;
                text-align: center;
                padding-left: .5rem;
                padding-right: .5rem;
            }

            .ep-submit-note span {
                display: inline;
                max-width: 100%;
            }

            .ep-submit-note strong {
                display: inline;
                margin-left: .2rem !important;
                margin-right: .2rem !important;
            }
        }
    </style>

    <section class="bg-light border-bottom">
        <div class="container d-flex align-items-center justify-content-center py-10 py-lg-16 ep-hero"
            style="min-height:220px;">
            <div class="row justify-content-center text-center w-100">
                <div class="col-lg-7">
                    <div class="mb-3">
                        <span class="badge bg-white text-primary border fw-medium px-3 py-2 rounded-pill fs-7">
                            <i class="fas fa-shield-alt me-1"></i>E-LAPOR Universitas Nurul Jadid
                        </span>
                    </div>
                    <h1 class="fw-bolder mb-3" style="font-size:clamp(2rem,4vw,2.8rem);color:#1a2d50;line-height:1.25;">
                        Sampaikan <span class="text-primary ep-accent">Laporan Anda</span><br>Dengan Mudah
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-3 pb-5">
        <div class="container" style="max-width:960px;">

            <div class="ep-stepper py-6 py-sm-8 mb-3">
                @foreach ([1 => 'Kategori Laporan', 2 => 'Lokasi', 3 => 'Detail', 4 => 'Pelapor', 5 => 'Kirim'] as $n => $label)
                    @if ($n > 1)
                        <div class="ep-step-line"></div>
                    @endif
                    <div class="ep-step-item">
                        <span
                            class="ep-step-badge badge rounded-circle bg-primary fw-semibold text-white d-flex align-items-center justify-content-center">{{ $n }}</span>
                        <span class="small ep-step-label">{{ $label }}</span>
                    </div>
                @endforeach
            </div>

            @php
                $ssoUser = session('sso_user');
                $isAnonOld = old('is_anonymous') === 'y';
            @endphp

            @if ($ssoUser)
                <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 fs-7 mb-3">
                    <i class="fas fa-user-check"></i>
                    <div><strong>Login via SSO UNUJA</strong> — Halo, <strong>{{ $ssoUser['nama'] }}</strong>! Data
                        identitas Anda sudah terisi otomatis dari SSO.</div>
                </div>
            @endif

            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data" id="form_laporan">
                @csrf

                <div class="card shadow-sm mb-3">
                    <div
                        class="card-header d-flex align-items-center justify-content-start gap-2 py-2 bg-light-primary border-bottom text-start">
                        <span
                            class="w-30px h-30px d-flex align-items-center justify-content-center rounded bg-primary flex-shrink-0">
                            <i class="fas fa-tag fs-7 text-white"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-primary">Kategori Laporan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Unit Tujuan</label>
                                <select id="unit_id" name="unit_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih Unit Tujuan" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Kategori Laporan</label>
                                <select id="kategori_id" name="kategori_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih unit terlebih dahulu" required disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2">Sub Kategori</label>
                                <select id="sub_kategori_id" name="sub_kategori_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih kategori terlebih dahulu" disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div
                        class="card-header d-flex align-items-center justify-content-start gap-2 py-2 bg-light-primary border-bottom text-start">
                        <span
                            class="w-30px h-30px d-flex align-items-center justify-content-center rounded bg-primary flex-shrink-0">
                            <i class="fas fa-map-marker-alt fs-7 text-white"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-primary">Lokasi Kejadian</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Gedung</label>
                                <select id="gedung_id" name="gedung_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih Gedung" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Lantai</label>
                                <select id="lantai_id" name="lantai_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih gedung dulu" required disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Ruangan</label>
                                <select id="ruangan_id" name="ruangan_id" class="form-select form-select-sm"
                                    data-control="select2" data-placeholder="Pilih lantai dulu" required disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div
                        class="card-header d-flex align-items-center justify-content-start gap-2 py-2 bg-light-primary border-bottom text-start">
                        <span
                            class="w-30px h-30px d-flex align-items-center justify-content-center rounded bg-primary flex-shrink-0">
                            <i class="fas fa-file-alt fs-7 text-white"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-primary">Detail Laporan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Judul Laporan</label>
                                <input type="text" name="judul_laporan" class="form-control form-control-sm"
                                    placeholder="Contoh: AC Ruang Lab 2 Gedung D tidak berfungsi"
                                    value="{{ old('judul_laporan') }}" required>
                                <div class="text-muted fs-8 mt-1">Buat judul ringkas dan spesifik.</div>
                            </div>
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Tanggal & Waktu Kejadian</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light-primary border-end-0">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                    </span>
                                    <input type="text" id="tgl_kejadian" name="tgl_kejadian"
                                        class="form-control form-control-sm border-start-0"
                                        placeholder="Pilih tanggal & waktu" value="{{ old('tgl_kejadian') }}" required
                                        autocomplete="off">
                                </div>
                                <div class="text-muted fs-8 mt-1">Kapan kejadian ini terjadi?</div>
                            </div>
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Kronologi / Deskripsi</label>
                                <textarea name="deskripsi_laporan" id="desc" rows="5" class="form-control form-control-sm"
                                    placeholder="Tuliskan apa yang terjadi, kronologi, dampak, dan harapan..." required>{{ old('deskripsi_laporan') }}</textarea>
                                <div class="d-flex justify-content-end mt-1">
                                    <span class="text-muted fs-8"><span id="descCount">0</span>/2000</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2">Lampiran Bukti <span
                                        class="text-muted fw-normal">(opsional)</span></label>
                                <input type="file" name="lampiran_file" id="lampiran_file"
                                    class="form-control form-control-sm" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="text-muted fs-8 mt-1">Format: JPG / PNG / PDF. Maksimal ukuran file:
                                    <strong>5MB</strong>.
                                </div>
                                <div id="file_error" class="text-danger fs-8 mt-1" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div
                        class="card-header d-flex align-items-center justify-content-start gap-2 py-2 bg-light-primary border-bottom text-start">
                        <span
                            class="w-30px h-30px d-flex align-items-center justify-content-center rounded bg-primary flex-shrink-0">
                            <i class="fas fa-user fs-7 text-white"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-primary">Data Pelapor</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2">Privasi Laporan</label>
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <label class="ep-privacy-opt {{ !$isAnonOld ? 'active' : '' }}" id="pc-rahasia"
                                        onclick="setPrivacy('t')">
                                        <input type="radio" name="is_anonymous" value="t"
                                            {{ !$isAnonOld ? 'checked' : '' }}>
                                        <div class="ep-pt"><i class="fas fa-lock" style="font-size:13px;"></i> Rahasia
                                        </div>
                                        <div class="ep-pd">Identitas hanya terlihat petugas berwenang</div>
                                    </label>
                                    <label class="ep-privacy-opt {{ $isAnonOld ? 'active' : '' }}" id="pc-anonim"
                                        onclick="setPrivacy('y')">
                                        <input type="radio" name="is_anonymous" value="y"
                                            {{ $isAnonOld ? 'checked' : '' }}>
                                        <div class="ep-pt"><i class="fas fa-user-slash text-muted"
                                                style="font-size:13px;"></i> Anonim</div>
                                        <div class="ep-pd">Tanpa identitas pelapor sama sekali</div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12" id="anonEmailBlock" style="{{ $isAnonOld ? '' : 'display:none;' }}">
                                <label class="fs-7 fw-bold text-gray-700 mb-2">Email <span
                                        class="text-muted fw-normal">(opsional)</span></label>
                                <input type="email" id="email_anonim" name="email_anonim"
                                    class="form-control form-control-sm" placeholder="nama@gmail.com"
                                    value="{{ old('email_anonim') }}">
                                <div class="d-flex align-items-start gap-2 p-2 bg-light-primary rounded mt-2">
                                    <i class="fas fa-shield-alt text-primary fs-7 flex-shrink-0 mt-1"></i>
                                    <span class="fs-8 text-muted">Alamat email Anda akan dirahasiakan dan hanya digunakan
                                        untuk mengirimkan notifikasi perkembangan laporan.</span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-0" id="identityBlock" style="{{ $isAnonOld ? 'display:none;' : '' }}">
                            <div class="col-md-6">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Nama Pelapor</label>
                                <input type="text" id="nama_pelapor" name="nama_pelapor"
                                    class="form-control form-control-sm" placeholder="Nama lengkap"
                                    value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['nama'] ?? old('nama_pelapor') }}"
                                    {{ $ssoUser ? 'readonly' : '' }} {{ $isAnonOld ? '' : 'required' }}>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Email</label>
                                <input type="email" id="email_pelapor" name="email_pelapor"
                                    class="form-control form-control-sm" placeholder="nama@gmail.com"
                                    value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['email'] ?? old('email_pelapor') }}"
                                    {{ $ssoUser && !empty($ssoUser['email']) ? 'readonly' : '' }}
                                    {{ $isAnonOld ? '' : 'required' }}>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-7 fw-bold text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" id="no_telp_pelapor" name="no_telp_pelapor"
                                    class="form-control form-control-sm" placeholder="08xxxxxxxxxx"
                                    value="{{ $isAnonOld ? 'Anonymous' : $ssoUser['no_telp'] ?? old('no_telp_pelapor') }}"
                                    {{ $ssoUser && !empty($ssoUser['no_telp']) ? 'readonly' : '' }}>
                            </div>
                            <div class="col-md-6">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Profesi / Tipe Pelapor</label>
                                <select name="{{ $ssoUser ? '' : 'tipe_pelapor' }}" id="tipe_pelapor"
                                    class="form-select form-select-sm" data-control="select2"
                                    data-placeholder="Pilih profesi" {{ $ssoUser ? 'disabled' : '' }}>
                                    <option value=""></option>
                                    <option value="Dosen"
                                        {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Dosen' ? 'selected' : '' }}>Dosen
                                    </option>
                                    <option value="Mahasiswa"
                                        {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Mahasiswa' ? 'selected' : '' }}>
                                        Mahasiswa</option>
                                    <option value="Tenaga Pendidik"
                                        {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Tenaga Pendidik' ? 'selected' : '' }}>
                                        Tenaga Pendidik</option>
                                    <option value="Masyarakat/Umum"
                                        {{ ($ssoUser['tipe'] ?? old('tipe_pelapor')) == 'Masyarakat/Umum' ? 'selected' : '' }}>
                                        Masyarakat/Umum</option>
                                </select>
                                @if ($ssoUser)
                                    <input type="hidden" name="tipe_pelapor" value="{{ $ssoUser['tipe'] }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3">
                    <div
                        class="card-header d-flex align-items-center justify-content-start gap-2 py-2 bg-light-primary border-bottom text-start">
                        <span
                            class="w-30px h-30px d-flex align-items-center justify-content-center rounded bg-primary flex-shrink-0">
                            <i class="fas fa-shield-alt fs-7 text-white"></i>
                        </span>
                        <h6 class="mb-0 fw-bold text-primary">Verifikasi & Kirim</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="fs-7 fw-bold text-gray-700 mb-2 required">Verifikasi Captcha</label>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="d-inline-flex align-items-center justify-content-center px-4 py-2 bg-light-primary rounded"
                                        style="min-width:140px;border:1px dashed rgba(31,71,136,.4);">
                                        <span class="fw-bold fs-4 text-primary" id="captcha_question">Memuat...</span>
                                    </div>
                                    <button type="button" id="btn_refresh_captcha"
                                        class="btn btn-sm btn-icon btn-light-primary" title="Refresh Captcha">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <input type="number" name="captcha" id="captcha_answer"
                                    class="form-control form-control-sm" style="max-width:220px;"
                                    placeholder="Masukkan jawaban" required>
                            </div>
                            <div class="col-12">
                                <label class="d-flex align-items-start gap-2 p-3 cursor-pointer mb-0" for="agreement">
                                    <input class="form-check-input mt-0 flex-shrink-0" type="checkbox" name="agreement"
                                        id="agreement" value="1" required>
                                    <span class="fs-7 text-muted lh-base fw-bold">Saya menyatakan informasi yang saya
                                        kirimkan benar dan dapat dipertanggungjawabkan.</span>
                                </label>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100" id="btn_submit">
                                    <span class="indicator-label">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                                    </span>
                                    <span class="indicator-progress" style="display:none;">
                                        Mengirim... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <div
                                    class="ep-submit-note d-flex align-items-center justify-content-center flex-wrap gap-1 fs-8 text-muted mt-2">
                                    <i class="fas fa-ticket-alt text-primary"></i>
                                    <span>Setelah terkirim, kamu akan mendapatkan <strong class="mx-1">Kode
                                            Tiket</strong> untuk pelacakan.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        (function() {
            const desc = document.getElementById('desc');
            const descCount = document.getElementById('descCount');

            function updateCount() {
                const len = (desc?.value || '').length;
                if (descCount) descCount.textContent = len;
                if (len > 2000) desc.value = desc.value.substring(0, 2000);
            }

            if (desc) {
                desc.addEventListener('input', updateCount);
                updateCount();
            }

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
                    }
                });
            }
        })();

        window.setPrivacy = function(val) {
            document.getElementById('pc-rahasia').classList.toggle('active', val === 't');
            document.getElementById('pc-anonim').classList.toggle('active', val === 'y');
            document.querySelectorAll('input[name="is_anonymous"]').forEach(r => r.checked = r.value === val);

            const identityBlock = document.getElementById('identityBlock');
            const anonEmailBlock = document.getElementById('anonEmailBlock');
            const namaPelapor = document.getElementById('nama_pelapor');
            const emailPelapor = document.getElementById('email_pelapor');
            const noTelp = document.getElementById('no_telp_pelapor');
            const tipePelapor = document.getElementById('tipe_pelapor');
            const emailAnonim = document.getElementById('email_anonim');
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
                if (!isAnon && emailAnonim) emailAnonim.value = '';
            }

            if (isAnon) {
                if (namaPelapor) namaPelapor.value = 'Anonymous';
                if (emailPelapor) emailPelapor.value = 'Anonymous';
                if (noTelp) noTelp.value = 'Anonymous';
                if (tipePelapor) tipePelapor.value = '';
            } else {
                if (namaPelapor && namaPelapor.value === 'Anonymous') namaPelapor.value = '';
                if (emailPelapor && emailPelapor.value === 'Anonymous') emailPelapor.value = '';
                if (noTelp && noTelp.value === 'Anonymous') noTelp.value = '';
            }

            if (namaPelapor) isAnon ? namaPelapor.removeAttribute('required') : namaPelapor.setAttribute('required',
                'required');
            if (emailPelapor) isAnon ? emailPelapor.removeAttribute('required') : emailPelapor.setAttribute('required',
                'required');
        };

        KTUtil.onDOMContentLoaded(function() {
            const unitSelect = document.getElementById('unit_id');
            const kategoriSelect = document.getElementById('kategori_id');
            const subKategoriSelect = document.getElementById('sub_kategori_id');
            const gedungSelect = document.getElementById('gedung_id');
            const lantaiSelect = document.getElementById('lantai_id');
            const ruanganSelect = document.getElementById('ruangan_id');
            const tglKejadianEl = document.getElementById('tgl_kejadian');
            const checkedPrivacy = document.querySelector('input[name="is_anonymous"]:checked');

            if (checkedPrivacy) window.setPrivacy(checkedPrivacy.value);

            if (typeof jQuery !== 'undefined') {
                [unitSelect, kategoriSelect, subKategoriSelect, gedungSelect, lantaiSelect, ruanganSelect].forEach(
                    function(el) {
                        if (el) jQuery(el).select2({
                            width: '100%'
                        });
                    });
            }

            fetch('{{ route('lapor.units') }}')
                .then(res => res.json())
                .then(data => {
                    data.forEach(unit => {
                        const opt = document.createElement('option');
                        opt.value = unit.id;
                        opt.textContent = unit.nama;
                        unitSelect.appendChild(opt);
                    });
                    jQuery(unitSelect).trigger('change');
                });

            jQuery(unitSelect).on('select2:select', function() {
                const id = this.value;
                kategoriSelect.innerHTML = '<option value=""></option>';
                jQuery(kategoriSelect).val(null).trigger('change');
                kategoriSelect.disabled = true;
                if (!id) return;
                fetch('{{ route('lapor.categories') }}?unit_id=' + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(cat => {
                            const opt = document.createElement('option');
                            opt.value = cat.id;
                            opt.textContent = cat.nama;
                            kategoriSelect.appendChild(opt);
                        });
                        kategoriSelect.disabled = false;
                        jQuery(kategoriSelect).prop('disabled', false).trigger('change');
                    });
            });

            function resetSubKategori() {
                subKategoriSelect.innerHTML = '<option value=""></option>';
                subKategoriSelect.disabled = true;
                jQuery(subKategoriSelect).val(null).trigger('change');
            }

            jQuery(kategoriSelect).on('select2:select', function() {
                const id = this.value;
                resetSubKategori();
                if (!id) return;
                fetch('{{ route('lapor.subkategoris') }}?kategori_id=' + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(sub => {
                            const opt = document.createElement('option');
                            opt.value = sub.id;
                            opt.textContent = sub.nama;
                            subKategoriSelect.appendChild(opt);
                        });
                        subKategoriSelect.disabled = false;
                        jQuery(subKategoriSelect).prop('disabled', false).trigger('change');
                    });
            });

            jQuery(kategoriSelect).on('select2:clear', resetSubKategori);
            jQuery(unitSelect).on('select2:clear', function() {
                kategoriSelect.innerHTML = '<option value=""></option>';
                kategoriSelect.disabled = true;
                jQuery(kategoriSelect).val(null).trigger('change');
                resetSubKategori();
            });

            fetch('{{ route('lapor.gedungs') }}')
                .then(res => res.json())
                .then(data => {
                    data.forEach(gedung => {
                        const opt = document.createElement('option');
                        opt.value = gedung.id;
                        opt.textContent = gedung.nama;
                        gedungSelect.appendChild(opt);
                    });
                    jQuery(gedungSelect).trigger('change');
                });

            function resetLantai() {
                lantaiSelect.innerHTML = '<option value=""></option>';
                lantaiSelect.disabled = true;
                jQuery(lantaiSelect).val(null).trigger('change');
            }

            function resetRuangan() {
                ruanganSelect.innerHTML = '<option value=""></option>';
                ruanganSelect.disabled = true;
                jQuery(ruanganSelect).val(null).trigger('change');
            }

            jQuery(gedungSelect).on('select2:select', function() {
                const id = this.value;
                resetLantai();
                resetRuangan();
                if (!id) return;
                fetch('{{ route('lapor.lantai') }}?gedung_id=' + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(lantai => {
                            const opt = document.createElement('option');
                            opt.value = lantai.id;
                            opt.textContent = lantai.nama;
                            lantaiSelect.appendChild(opt);
                        });
                        lantaiSelect.disabled = false;
                        jQuery(lantaiSelect).prop('disabled', false).trigger('change');
                    });
            });

            jQuery(gedungSelect).on('select2:clear', function() {
                resetLantai();
                resetRuangan();
            });

            jQuery(lantaiSelect).on('select2:select', function() {
                const id = this.value;
                resetRuangan();
                if (!id) return;
                fetch('{{ route('lapor.ruangan') }}?lantai_id=' + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(ruangan => {
                            const opt = document.createElement('option');
                            opt.value = ruangan.id;
                            opt.textContent = ruangan.nama + (ruangan.fungsi ? ' (' + ruangan
                                .fungsi + ')' : '');
                            ruanganSelect.appendChild(opt);
                        });
                        ruanganSelect.disabled = false;
                        jQuery(ruanganSelect).prop('disabled', false).trigger('change');
                    });
            });

            jQuery(lantaiSelect).on('select2:clear', resetRuangan);

            if (tglKejadianEl && typeof flatpickr !== 'undefined') {
                flatpickr(tglKejadianEl, {
                    enableTime: true,
                    time_24hr: true,
                    dateFormat: 'Y-m-d H:i',
                    allowInput: true
                });
            }

            function loadCaptcha() {
                fetch('{{ route('lapor.captcha') }}')
                    .then(res => res.json())
                    .then(data => {
                        const el = document.getElementById('captcha_question');
                        if (el) el.textContent = data.question;
                        const inp = document.getElementById('captcha_answer');
                        if (inp) inp.value = '';
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
                    const submitBtn = document.getElementById('btn_submit');
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
                                    html: `<div class="text-start">
                                        <p class="mb-3 fw-semibold text-gray-800">Kode Tiket Anda:</p>
                                        <div class="bg-light-primary p-4 rounded-3 mb-3">
                                            <h5 class="text-center fw-bold fs-2 text-primary" style="user-select:all;cursor:pointer;" title="Klik untuk menyalin">${data.kode_tiket}</h5>
                                        </div>
                                        <div class="d-flex align-items-start gap-2 p-3 rounded-2 mb-3" style="background-color:#fff3cd;border:1px solid #ffecb5;">
                                            <i class="fas fa-exclamation-triangle text-warning fs-4 mt-1" style="min-width:20px;"></i>
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-1">Penting! Simpan Kode Tiket Ini</span>
                                                <span class="text-gray-700 fs-7">Harap <b>Catat</b>, <b>Salin</b>, atau <b>Cek Email</b> kode tiket di atas untuk melacak status laporan Anda.</span>
                                            </div>
                                        </div>
                                    </div>`,
                                    icon: 'success',
                                    confirmButtonText: 'Lacak Sekarang',
                                    confirmButtonColor: '#1F4788',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) window.location.href = data
                                        .redirect;
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
                                    Swal.fire({
                                        title: 'Validasi Gagal!',
                                        html: `<ul class="ps-4 mb-0">${messages.map(m => `<li class="text-start">${m}</li>`).join('')}</ul>`,
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
