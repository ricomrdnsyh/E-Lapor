<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        let currentEditId = null;
        let unitsLoaded = false;
        let gedungsLoaded = false;
        let preload = { unitId: null, kategoriId: null, subKategoriId: null, gedungId: null, lantaiId: null, ruanganId: null };

        const unitSelect = document.getElementById('edit_unit_id');
        const kategoriSelect = document.getElementById('edit_kategori_id');
        const subKategoriSelect = document.getElementById('edit_sub_kategori_id');
        const gedungSelect = document.getElementById('edit_gedung_id');
        const lantaiSelect = document.getElementById('edit_lantai_id');
        const ruanganSelect = document.getElementById('edit_ruangan_id');

        const getFilePreview = function(filename) {
            if (!filename) return '-';
            const ext = filename.split('.').pop().toLowerCase();
            const filePath = '/uploads/laporan/' + filename;
            const imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            const docExts = ['pdf'];

            if (imageExts.includes(ext)) {
                return `<img src="${filePath}" alt="Lampiran"
        style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #dee2e6;">`;
            } else if (docExts.includes(ext)) {
                return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-danger">
        <i class="fas fa-file-pdf fs-4 me-1"></i>
        Lihat PDF
    </a>`;
            } else {
                return '-';
            }
        };

        // ========== UNIT → KATEGORI → SUB KATEGORI ==========

        function resetKategori() {
            kategoriSelect.innerHTML = '<option value="">-- Pilih Unit Terlebih Dahulu --</option>';
            kategoriSelect.disabled = true;
            if (typeof jQuery !== 'undefined') {
                jQuery(kategoriSelect).val(null).trigger('change');
                jQuery(kategoriSelect).prop('disabled', true).trigger('change');
            }
        }

        function resetSubKategori() {
            subKategoriSelect.innerHTML = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
            subKategoriSelect.disabled = true;
            if (typeof jQuery !== 'undefined') {
                jQuery(subKategoriSelect).val(null).trigger('change');
                jQuery(subKategoriSelect).prop('disabled', true).trigger('change');
            }
        }

        function loadUnits(unitIdToSelect) {
            if (unitsLoaded) {
                if (unitIdToSelect) {
                    jQuery(unitSelect).val(unitIdToSelect).trigger('change');
                }
                return;
            }
            fetch('/lapor/data/units')
                .then(res => res.json())
                .then(data => {
                    data.forEach(unit => {
                        const option = document.createElement('option');
                        option.value = unit.id;
                        option.textContent = unit.nama;
                        unitSelect.appendChild(option);
                    });
                    unitsLoaded = true;
                    if (unitIdToSelect) {
                        jQuery(unitSelect).val(unitIdToSelect).trigger('change');
                    }
                });
        }

        function loadCategories(unitId, kategoriIdToSelect) {
            resetKategori();
            if (!unitId) return;

            kategoriSelect.innerHTML = '<option value="">Memuat kategori...</option>';

            fetch('/lapor/data/categories?unit_id=' + unitId)
                .then(res => res.json())
                .then(data => {
                    kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                    data.forEach(cat => {
                        const option = document.createElement('option');
                        option.value = cat.id;
                        option.textContent = cat.nama;
                        kategoriSelect.appendChild(option);
                    });
                    kategoriSelect.disabled = false;
                    jQuery(kategoriSelect).prop('disabled', false).trigger('change');

                    if (kategoriIdToSelect) {
                        jQuery(kategoriSelect).val(kategoriIdToSelect).trigger('change');
                    }
                });
        }

        function loadSubCategories(kategoriId, subKategoriIdToSelect) {
            resetSubKategori();
            if (!kategoriId) return;

            subKategoriSelect.innerHTML = '<option value="">Memuat sub kategori...</option>';

            fetch('/lapor/data/subkategori?kategori_id=' + kategoriId)
                .then(res => res.json())
                .then(data => {
                    subKategoriSelect.innerHTML = '<option value=""></option>';
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.nama;
                        subKategoriSelect.appendChild(option);
                    });
                    subKategoriSelect.disabled = false;
                    jQuery(subKategoriSelect).prop('disabled', false).trigger('change');

                    if (subKategoriIdToSelect) {
                        jQuery(subKategoriSelect).val(subKategoriIdToSelect).trigger('change');
                    }
                });
        }

        // ========== GEDUNG → LANTAI → RUANGAN ==========

        function resetLantai() {
            lantaiSelect.innerHTML = '<option value="">-- Pilih Gedung Terlebih Dahulu --</option>';
            lantaiSelect.disabled = true;
            if (typeof jQuery !== 'undefined') {
                jQuery(lantaiSelect).val(null).trigger('change');
                jQuery(lantaiSelect).prop('disabled', true).trigger('change');
            }
        }

        function resetRuangan() {
            ruanganSelect.innerHTML = '<option value="">-- Pilih Lantai Terlebih Dahulu --</option>';
            ruanganSelect.disabled = true;
            if (typeof jQuery !== 'undefined') {
                jQuery(ruanganSelect).val(null).trigger('change');
                jQuery(ruanganSelect).prop('disabled', true).trigger('change');
            }
        }

        function loadGedungs(gedungIdToSelect) {
            if (gedungsLoaded) {
                if (gedungIdToSelect) {
                    jQuery(gedungSelect).val(gedungIdToSelect).trigger('change');
                }
                return;
            }
            fetch('/lapor/data/gedungs')
                .then(res => res.json())
                .then(data => {
                    data.forEach(gedung => {
                        const option = document.createElement('option');
                        option.value = gedung.id;
                        option.textContent = gedung.nama;
                        gedungSelect.appendChild(option);
                    });
                    gedungsLoaded = true;
                    if (gedungIdToSelect) {
                        jQuery(gedungSelect).val(gedungIdToSelect).trigger('change');
                    }
                });
        }

        function loadLantai(gedungId, lantaiIdToSelect) {
            resetLantai();
            if (!gedungId) return;

            lantaiSelect.innerHTML = '<option value="">Memuat lantai...</option>';

            fetch('/lapor/data/lantai?gedung_id=' + gedungId)
                .then(res => res.json())
                .then(data => {
                    lantaiSelect.innerHTML = '<option value="">-- Pilih Lantai --</option>';
                    data.forEach(lantai => {
                        const option = document.createElement('option');
                        option.value = lantai.id;
                        option.textContent = lantai.nama;
                        lantaiSelect.appendChild(option);
                    });
                    lantaiSelect.disabled = false;
                    jQuery(lantaiSelect).prop('disabled', false).trigger('change');

                    if (lantaiIdToSelect) {
                        jQuery(lantaiSelect).val(lantaiIdToSelect).trigger('change');
                    }
                });
        }

        function loadRuangan(lantaiId, ruanganIdToSelect) {
            resetRuangan();
            if (!lantaiId) return;

            ruanganSelect.innerHTML = '<option value="">Memuat ruangan...</option>';

            fetch('/lapor/data/ruangan?lantai_id=' + lantaiId)
                .then(res => res.json())
                .then(data => {
                    ruanganSelect.innerHTML = '<option value="">-- Pilih Ruangan --</option>';
                    data.forEach(ruangan => {
                        const option = document.createElement('option');
                        option.value = ruangan.id;
                        option.textContent = ruangan.nama + (ruangan.fungsi ? ' (' + ruangan.fungsi + ')' : '');
                        ruanganSelect.appendChild(option);
                    });
                    ruanganSelect.disabled = false;
                    jQuery(ruanganSelect).prop('disabled', false).trigger('change');

                    if (ruanganIdToSelect) {
                        jQuery(ruanganSelect).val(ruanganIdToSelect).trigger('change');
                    }
                });
        }

        // ========== SELECT2 INITIALIZATION ==========

        if (typeof jQuery !== 'undefined') {
            jQuery(unitSelect).select2({
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery(kategoriSelect).select2({
                placeholder: '-- Pilih Kategori --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery(subKategoriSelect).select2({
                placeholder: '-- Pilih Sub Kategori --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery(gedungSelect).select2({
                placeholder: '-- Pilih Gedung --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery(lantaiSelect).select2({
                placeholder: '-- Pilih Lantai --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery(ruanganSelect).select2({
                placeholder: '-- Pilih Ruangan --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            // Unit → Kategori cascade
            jQuery(unitSelect).on('select2:select', function() {
                const selectedUnitId = this.value;
                const kategoriToSelect = preload.kategoriId;
                preload.kategoriId = null;
                preload.subKategoriId = null;
                resetKategori();
                resetSubKategori();
                if (selectedUnitId) {
                    loadCategories(selectedUnitId, kategoriToSelect);
                }
            });

            jQuery(unitSelect).on('select2:clear', function() {
                preload.kategoriId = null;
                preload.subKategoriId = null;
                resetKategori();
                resetSubKategori();
            });

            // Kategori → SubKategori cascade
            jQuery(kategoriSelect).on('select2:select', function() {
                const selectedKategoriId = this.value;
                const subKategoriToSelect = preload.subKategoriId;
                preload.subKategoriId = null;
                resetSubKategori();
                if (selectedKategoriId) {
                    loadSubCategories(selectedKategoriId, subKategoriToSelect);
                }
            });

            jQuery(kategoriSelect).on('select2:clear', function() {
                preload.subKategoriId = null;
                resetSubKategori();
            });

            // Gedung → Lantai cascade
            jQuery(gedungSelect).on('select2:select', function() {
                const selectedGedungId = this.value;
                const lantaiToSelect = preload.lantaiId;
                preload.lantaiId = null;
                preload.ruanganId = null;
                resetLantai();
                resetRuangan();
                if (selectedGedungId) {
                    loadLantai(selectedGedungId, lantaiToSelect);
                }
            });

            jQuery(gedungSelect).on('select2:clear', function() {
                preload.lantaiId = null;
                preload.ruanganId = null;
                resetLantai();
                resetRuangan();
            });

            // Lantai → Ruangan cascade
            jQuery(lantaiSelect).on('select2:select', function() {
                const selectedLantaiId = this.value;
                const ruanganToSelect = preload.ruanganId;
                preload.ruanganId = null;
                resetRuangan();
                if (selectedLantaiId) {
                    loadRuangan(selectedLantaiId, ruanganToSelect);
                }
            });

            jQuery(lantaiSelect).on('select2:clear', function() {
                preload.ruanganId = null;
                resetRuangan();
            });

            jQuery('#edit_status').select2({
                placeholder: '-- Pilih Status --',
                allowClear: false,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery('#edit_tipe_pelapor').select2({
                placeholder: '-- Pilih Tipe --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });
        }

        if (typeof flatpickr !== 'undefined') {
            flatpickr('#edit_tgl_kejadian', {
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
                allowInput: true
            });
        }

        // ========== EDIT BUTTON CLICK ==========

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');
                currentEditId = id;

                preload = { unitId: null, kategoriId: null, subKategoriId: null, gedungId: null, lantaiId: null, ruanganId: null };

                $.ajax({
                    url: '/admin/laporan/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const laporan = data.laporan;

                        document.getElementById('edit_kode_tiket').value = laporan.kode_tiket || '';
                        document.getElementById('edit_lampiran_file').value = '';
                        document.getElementById('edit_judul_laporan').value = laporan.judul_laporan || '';

                        document.getElementById('edit_deskripsi_laporan').value = laporan.deskripsi_laporan || '';
                        document.getElementById('edit_nama_pelapor').value = laporan.nama_pelapor || '';
                        document.getElementById('edit_email_pelapor').value = laporan.email_pelapor || '';
                        document.getElementById('edit_no_telp_pelapor').value = laporan.no_telp_pelapor || '';
                        document.getElementById('edit_tipe_pelapor').value = laporan.tipe_pelapor || '';

                        document.querySelector('input[name="is_anonymous"][value="' + (laporan.is_anonymous || 't') + '"]').checked = true;

                        const tglKejadian = laporan.tgl_kejadian ? laporan.tgl_kejadian.replace('T', ' ').substring(0, 16) : '';
                        document.getElementById('edit_tgl_kejadian').value = tglKejadian;

                        document.getElementById('edit_lampiran_file_preview').innerHTML = getFilePreview(laporan.lampiran_file);

                        form.action = '/admin/laporan/' + id;

                        preload = {
                            unitId: laporan.kategori?.unit?.id_unit || null,
                            kategoriId: laporan.kategori_id || null,
                            subKategoriId: laporan.sub_kategori_id || null,
                            gedungId: laporan.ruangan?.lantai?.gedung?.id_gedung || null,
                            lantaiId: laporan.ruangan?.lantai?.id_lantai || null,
                            ruanganId: laporan.ruangan?.id_ruangan || null
                        };

                        loadUnits(preload.unitId);
                        loadGedungs(preload.gedungId);

                        setTimeout(() => {
                            jQuery('#edit_status').val(laporan.status).trigger('change');
                            jQuery('#edit_tipe_pelapor').val(laporan.tipe_pelapor || '').trigger('change');
                        }, 100);

                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data laporan'
                        });
                    }
                });
            }
        });

        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            submitButton.disabled = true;
            submitButton.querySelector('.indicator-label').style.display = 'none';
            submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
        });

        modalEl.addEventListener('hidden.bs.modal', function() {
            form.classList.remove('was-validated');
            submitButton.disabled = false;
            submitButton.querySelector('.indicator-label').style.display = 'inline-block';
            submitButton.querySelector('.indicator-progress').style.display = 'none';
            currentEditId = null;
            preload = { unitId: null, kategoriId: null, subKategoriId: null, gedungId: null, lantaiId: null, ruanganId: null };
            resetKategori();
            resetSubKategori();
            resetLantai();
            resetRuangan();
            if (typeof jQuery !== 'undefined') {
                if (unitsLoaded) jQuery(unitSelect).val(null).trigger('change');
                if (gedungsLoaded) jQuery(gedungSelect).val(null).trigger('change');
            }
        });

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
