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
                    preload.unitId = null;
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
                        preload.unitId = null;
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
                        preload.kategoriId = null;
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
                        preload.subKategoriId = null;
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
                    preload.gedungId = null;
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
                        preload.gedungId = null;
                    }
                });
        }

        // function loadLantai
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
                        preload.lantaiId = null;
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
                        preload.ruanganId = null;
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
            jQuery(unitSelect).on('change', function() {
                const selectedUnitId = this.value;
                const kategoriToSelect = preload.kategoriId;
                if (selectedUnitId) {
                    preload.kategoriId = null;
                    resetKategori();
                    resetSubKategori();
                    loadCategories(selectedUnitId, kategoriToSelect);
                } else {
                    resetKategori();
                    resetSubKategori();
                }
            });

            // Kategori → SubKategori cascade
            jQuery(kategoriSelect).on('change', function() {
                const selectedKategoriId = this.value;
                const subKategoriToSelect = preload.subKategoriId;
                if (selectedKategoriId) {
                    preload.subKategoriId = null;
                    resetSubKategori();
                    loadSubCategories(selectedKategoriId, subKategoriToSelect);
                } else {
                    resetSubKategori();
                }
            });

            // Gedung → Lantai cascade
            jQuery(gedungSelect).on('change', function() {
                const selectedGedungId = this.value;
                const lantaiToSelect = preload.lantaiId;
                if (selectedGedungId) {
                    preload.lantaiId = null;
                    resetLantai();
                    resetRuangan();
                    loadLantai(selectedGedungId, lantaiToSelect);
                } else {
                    resetLantai();
                    resetRuangan();
                }
            });

            // Lantai → Ruangan cascade
            jQuery(lantaiSelect).on('change', function() {
                const selectedLantaiId = this.value;
                const ruanganToSelect = preload.ruanganId;
                if (selectedLantaiId) {
                    preload.ruanganId = null;
                    resetRuangan();
                    loadRuangan(selectedLantaiId, ruanganToSelect);
                } else {
                    resetRuangan();
                }
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

        // ========== PRIVACY TOGGLE ==========
        function togglePrivacyEdit(val) {
            const identityBlock = document.getElementById('edit_identityBlock');
            const anonEmailBlock = document.getElementById('edit_anonEmailBlock');
            const namaPelapor = document.getElementById('edit_nama_pelapor');
            const emailPelapor = document.getElementById('edit_email_pelapor');
            const noTelp = document.getElementById('edit_no_telp_pelapor');
            const tipePelapor = document.getElementById('edit_tipe_pelapor');
            const emailAnonim = document.getElementById('edit_email_anonim');
            const isAnon = (val === 'y');

            if (identityBlock) {
                identityBlock.style.display = isAnon ? 'none' : '';
                identityBlock.querySelectorAll('input, select').forEach(inp => {
                    if (isAnon) {
                        inp.setAttribute('disabled', 'disabled');
                        inp.removeAttribute('required');
                        if (inp.tagName === 'SELECT' && typeof jQuery !== 'undefined') {
                            jQuery(inp).prop('disabled', true).trigger('change');
                        }
                    } else {
                        inp.removeAttribute('disabled');
                        if (inp.id === 'edit_nama_pelapor' || inp.id === 'edit_email_pelapor') {
                            inp.setAttribute('required', 'required');
                        }
                        if (inp.tagName === 'SELECT' && typeof jQuery !== 'undefined') {
                            jQuery(inp).prop('disabled', false).trigger('change');
                        }
                    }
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
                if (tipePelapor && typeof jQuery !== 'undefined') {
                    jQuery(tipePelapor).val('').trigger('change');
                }
            } else {
                if (namaPelapor && namaPelapor.value === 'Anonymous') namaPelapor.value = '';
                if (emailPelapor && emailPelapor.value === 'Anonymous') emailPelapor.value = '';
                if (noTelp && noTelp.value === 'Anonymous') noTelp.value = '';
            }
        }

        document.querySelectorAll('input[name="is_anonymous"]').forEach(radio => {
            radio.addEventListener('change', function() {
                togglePrivacyEdit(this.value);
            });
        });

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

                        const isAnonymousVal = laporan.is_anonymous || 't';
                        document.querySelector('input[name="is_anonymous"][value="' + isAnonymousVal + '"]').checked = true;

                        togglePrivacyEdit(isAnonymousVal);

                        if (isAnonymousVal === 'y') {
                            document.getElementById('edit_email_anonim').value = (laporan.email_pelapor && laporan.email_pelapor !== 'Anonymous') ? laporan.email_pelapor : '';
                            document.getElementById('edit_nama_pelapor').value = 'Anonymous';
                            document.getElementById('edit_email_pelapor').value = 'Anonymous';
                            document.getElementById('edit_no_telp_pelapor').value = 'Anonymous';
                        } else {
                            document.getElementById('edit_nama_pelapor').value = laporan.nama_pelapor || '';
                            document.getElementById('edit_email_pelapor').value = laporan.email_pelapor || '';
                            document.getElementById('edit_no_telp_pelapor').value = laporan.no_telp_pelapor || '';
                        }

                        let tglKejadian = '';
                        if (laporan.tgl_kejadian) {
                            const d = new Date(laporan.tgl_kejadian);
                            if (!isNaN(d.getTime())) {
                                const yyyy = d.getFullYear();
                                const mm = String(d.getMonth() + 1).padStart(2, '0');
                                const dd = String(d.getDate()).padStart(2, '0');
                                const hh = String(d.getHours()).padStart(2, '0');
                                const min = String(d.getMinutes()).padStart(2, '0');
                                tglKejadian = `${yyyy}-${mm}-${dd} ${hh}:${min}`;
                            } else {
                                tglKejadian = laporan.tgl_kejadian.replace('T', ' ').substring(0, 16);
                            }
                        }
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
            document.getElementById('edit_email_anonim').value = '';
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
