<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        let currentEditId = null;
        let categoriesData = [];

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

        const updateUnitTujuan = function(kategoriId) {
            const unit = categoriesData.find(k => k.id_kategori == kategoriId)?.unit;
            const unitTujuanEl = document.getElementById('edit_unit_tujuan');
            const unitIdEl = document.getElementById('edit_unit_id');

            if (unit && unitTujuanEl) {
                unitTujuanEl.value = unit.nama_unit || '';
                if (unitIdEl) unitIdEl.value = unit.id_unit || '';
            } else if (unitTujuanEl) {
                unitTujuanEl.value = '';
                if (unitIdEl) unitIdEl.value = '';
            }
        };

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');
                currentEditId = id;

                $.ajax({
                    url: '/admin/laporan/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        categoriesData = data.kategoris;

                        document.getElementById('edit_kode_tiket').value = data.laporan
                            .kode_tiket || '';
                        document.getElementById('edit_judul_laporan').value = data.laporan
                            .judul_laporan || '';
                        let lokasi = '-';
                        if (data.laporan.ruangan) {
                            let parts = [];
                            if (data.laporan.ruangan.lantai && data.laporan.ruangan.lantai.gedung) {
                                parts.push(data.laporan.ruangan.lantai.gedung.nama_gedung);
                            }
                            if (data.laporan.ruangan.lantai) {
                                parts.push(data.laporan.ruangan.lantai.nama_lantai);
                            }
                            parts.push(data.laporan.ruangan.nama_ruangan);
                            lokasi = parts.join(' - ');
                        }
                        document.getElementById('edit_lokasi_kejadian').value = lokasi;
                        document.getElementById('edit_deskripsi_laporan').value = data
                            .laporan.deskripsi_laporan || '';
                        document.getElementById('edit_nama_pelapor').value = data.laporan
                            .nama_pelapor || '';
                        document.getElementById('edit_email_pelapor').value = data.laporan
                            .email_pelapor || '';
                        document.getElementById('edit_no_telp_pelapor').value = data.laporan
                            .no_telp_pelapor || '';
                        document.getElementById('edit_tipe_pelapor').value = data.laporan
                            .tipe_pelapor || '';

                        document.querySelector('input[name="is_anonymous"][value="' + (data
                            .laporan.is_anonymous || 't') + '"]').checked = true;

                        const kategoriSelect = document.getElementById('edit_kategori_id');
                        if (kategoriSelect.options.length === 1) {
                            data.kategoris.forEach(kat => {
                                const option = document.createElement('option');
                                option.value = kat.id_kategori;
                                option.textContent = kat.nama_kategori;
                                kategoriSelect.appendChild(option);
                            });
                        }

                        setTimeout(() => {
                            jQuery('#edit_kategori_id').val(data.laporan
                                .kategori_id).trigger('change');
                            jQuery('#edit_status').val(data.laporan.status).trigger(
                                'change');
                            jQuery('#edit_tipe_pelapor').val(data.laporan
                                .tipe_pelapor || '').trigger('change');
                            updateUnitTujuan(data.laporan.kategori_id);
                        }, 100);

                        const tglKejadian = data.laporan.tgl_kejadian ? data.laporan
                            .tgl_kejadian.replace('T', ' ').substring(0, 16) : '';
                        document.getElementById('edit_tgl_kejadian').value = tglKejadian;

                        document.getElementById('edit_lampiran_file_preview').innerHTML =
                            getFilePreview(data.laporan.lampiran_file);

                        form.action = '/admin/laporan/' + id;

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

        if (typeof jQuery !== 'undefined') {
            jQuery('#edit_kategori_id').select2({
                placeholder: '-- Pilih Kategori --',
                allowClear: true,
                width: '100%',
                dropdownParent: jQuery(modalEl)
            });

            jQuery('#edit_kategori_id').on('select2:select', function() {
                updateUnitTujuan(this.value);
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
        });

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
