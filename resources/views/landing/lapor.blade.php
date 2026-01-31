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
                                            <span class="fw-bold text-gray-900">Pilih kategori</span>
                                            <span class="badge badge-light-primary fs-8 px-3 py-2">Diterima</span>
                                        </div>
                                        <div class="text-gray-600">Agar langsung ke unit yang tepat.</div>
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
                                        <div class="text-gray-600">Foto/screenshot/PDF (opsional tapi disarankan).</div>
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

                    <div class="text-muted fs-8">
                        * Opsi anonim/rahasia mengikuti kebijakan kampus. Gunakan bahasa yang sopan dan faktual.
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

                            <form action="#" method="POST" enctype="multipart/form-data"
                                class="d-flex flex-column gap-5">
                                @csrf

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Kategori Laporan</label>
                                        <select name="category" class="form-select form-select-sm" data-control="select2"
                                            required>
                                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih
                                                kategori</option>
                                            <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>
                                                Akademik</option>
                                            <option value="sarpras" {{ old('category') == 'sarpras' ? 'selected' : '' }}>
                                                Sarpras</option>
                                            <option value="tik" {{ old('category') == 'tik' ? 'selected' : '' }}>TIK /
                                                Sistem Informasi</option>
                                            <option value="keamanan" {{ old('category') == 'keamanan' ? 'selected' : '' }}>
                                                Keamanan</option>
                                            <option value="etik" {{ old('category') == 'etik' ? 'selected' : '' }}>Etik /
                                                Perundungan</option>
                                            <option value="kemahasiswaan"
                                                {{ old('category') == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan
                                            </option>
                                            <option value="keuangan" {{ old('category') == 'keuangan' ? 'selected' : '' }}>
                                                Keuangan</option>
                                            <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Tanggal & Waktu Kejadian</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt fs-5"></i>
                                            </span>
                                            <input type="text" id="incident_at" name="incident_at"
                                                class="form-control form-control-sm" placeholder="Pilih tanggal & waktu"
                                                value="{{ old('incident_at') }}" required autocomplete="off" />
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="required form-label fw-semibold">Judul Laporan</label>
                                    <input type="text" name="title" class="form-control form-control-sm"
                                        placeholder="Contoh: AC Ruang Lab 2 Gedung D tidak berfungsi"
                                        value="{{ old('title') }}" required>
                                    <div class="text-muted fs-8 mt-1">Buat judul ringkas dan spesifik.</div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Lokasi</label>
                                        <input type="text" name="location" class="form-control form-control-sm"
                                            placeholder="Gedung / Lantai / Ruangan / Area" value="{{ old('location') }}"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Unit Tujuan</label>
                                        <select name="unit" class="form-select form-select-sm" data-control="select2"
                                            required>
                                            <option value="" disabled {{ old('unit') ? '' : 'selected' }}>Pilih
                                                unit</option>
                                            <option value="akademik" {{ old('unit') == 'akademik' ? 'selected' : '' }}>
                                                Rektorat</option>
                                            <option value="sarpras" {{ old('unit') == 'sarpras' ? 'selected' : '' }}>
                                                Fakultas</option>
                                            <option value="lainnya" {{ old('unit') == 'lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="required form-label fw-semibold">Kronologi / Deskripsi</label>
                                    <textarea name="description" id="desc" rows="5" class="form-control form-control-sm"
                                        placeholder="Tuliskan apa yang terjadi, kronologi, dampak, dan harapan..." required>{{ old('description') }}</textarea>
                                    <div class="d-flex justify-content-between mt-1">
                                        <div class="text-muted fs-8">Saran: sertakan waktu, saksi, dan kondisi sekitar.
                                        </div>
                                        <div class="text-muted fs-8"><span id="descCount">0</span>/2000</div>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Lampiran Bukti (opsional)</label>
                                    <input type="file" name="attachments[]" class="form-control form-control-sm"
                                        multiple accept=".jpg,.jpeg,.png,.pdf">
                                    <div class="text-muted fs-8 mt-1">
                                        Format: JPG/PNG/PDF. Disarankan: foto jelas / screenshot error.
                                    </div>
                                </div>

                                <div class="separator"></div>

                                <div>
                                    <div class="fw-bold text-gray-900 mb-2">Privasi Laporan</div>
                                    <div class="d-flex flex-column gap-2">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                value="terbuka"
                                                {{ old('privacy', 'terbuka') == 'terbuka' ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                <span class="fw-semibold text-gray-800">Terbuka</span>
                                                <span class="text-muted fs-8 d-block">Identitas pelapor tercatat untuk
                                                    verifikasi.</span>
                                            </span>
                                        </label>

                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                value="rahasia" {{ old('privacy') == 'rahasia' ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                <span class="fw-semibold text-gray-800">Rahasia</span>
                                                <span class="text-muted fs-8 d-block">Identitas hanya terlihat petugas
                                                    berwenang.</span>
                                            </span>
                                        </label>

                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="privacy" value="anonim"
                                                {{ old('privacy') == 'anonim' ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                <span class="fw-semibold text-gray-800">Anonim</span>
                                                <span class="text-muted fs-8 d-block">Tanpa identitas pelapor (jika
                                                    diizinkan kebijakan).</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div id="identityBlock" class="row g-4">
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Nama Pelapor</label>
                                        <input type="text" id="reporter_name" name="reporter_name"
                                            class="form-control form-control-sm" placeholder="Nama lengkap"
                                            value="{{ old('reporter_name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Email</label>
                                        <input type="text" id="reporter_id" name="reporter_id"
                                            class="form-control form-control-sm" placeholder="nama@gmail.com"
                                            value="{{ old('reporter_id') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">No. HP (opsional)</label>
                                        <input type="text" id="reporter_phone" name="reporter_phone"
                                            class="form-control form-control-sm" placeholder="08xxxxxxxxxx"
                                            value="{{ old('reporter_phone') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold">Profesi</label>
                                        <select name="profesi" class="form-select form-select-sm" data-control="select2"
                                            required>
                                            <option value="" disabled {{ old('profesi') ? '' : 'selected' }}>Pilih
                                                profesi</option>
                                            <option value="akademik" {{ old('profesi') == 'akademik' ? 'selected' : '' }}>
                                                Dosen</option>
                                            <option value="sarpras" {{ old('profesi') == 'sarpras' ? 'selected' : '' }}>
                                                Mahasiswa</option>
                                            <option value="lainnya" {{ old('profesi') == 'lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="agreement" value="1"
                                        required>
                                    <span class="form-check-label text-muted">
                                        Saya menyatakan informasi yang saya kirimkan benar dan dapat dipertanggungjawabkan.
                                    </span>
                                </label>

                                <div class="d-flex flex-wrap gap-3 pt-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="ki-duotone ki-send fs-4 me-2">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        Kirim Laporan
                                    </button>

                                    <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">
                                        Kembali
                                    </a>
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
            const radios = document.querySelectorAll('input[name="privacy"]');
            const identityBlock = document.getElementById('identityBlock');

            const reporterName = document.getElementById('reporter_name');
            const reporterId = document.getElementById('reporter_id');

            function updateCount() {
                const len = (desc?.value || '').length;
                if (descCount) descCount.textContent = len;
                if (len > 2000) desc.value = desc.value.substring(0, 2000);
            }

            function toggleIdentity() {
                const val = document.querySelector('input[name="privacy"]:checked')?.value || 'terbuka';
                const isAnon = (val === 'anonim');

                if (identityBlock) {
                    identityBlock.style.display = isAnon ? 'none' : '';
                    identityBlock.querySelectorAll('input').forEach(inp => {
                        if (isAnon) inp.setAttribute('disabled', 'disabled');
                        else inp.removeAttribute('disabled');
                    });
                }

                // required hanya jika bukan anonim
                if (reporterName) isAnon ? reporterName.removeAttribute('required') : reporterName.setAttribute(
                    'required', 'required');
                if (reporterId) isAnon ? reporterId.removeAttribute('required') : reporterId.setAttribute('required',
                    'required');
            }

            if (desc) {
                desc.addEventListener('input', updateCount);
                updateCount();
            }

            radios.forEach(r => r.addEventListener('change', toggleIdentity));
            toggleIdentity();
        })();

        KTUtil.onDOMContentLoaded(function() {
            const el = document.querySelector('#incident_at');
            if (!el || typeof flatpickr === 'undefined') return;

            flatpickr(el, {
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
                allowInput: true
            });
        });
    </script>
@endsection
