<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = document.getElementById('btn_submit_edit');
        const modal = new bootstrap.Modal(modalEl);
        const statusSelectEl = document.getElementById('edit_status');
        const lampiranWrapperEl = document.getElementById('edit_lampiran_bukti_wrapper');
        const lampiranInputEl = document.getElementById('edit_lampiran_bukti');

        const initStatusSelect = function() {
            if (typeof jQuery === 'undefined' || !statusSelectEl) return;

            const statusSelect = jQuery(statusSelectEl);

            if (statusSelect.hasClass('select2-hidden-accessible')) {
                statusSelect.select2('destroy');
            }

            statusSelect.select2({
                placeholder: '-- Pilih Status --',
                allowClear: false,
                width: '100%',
                language: 'id',
                dropdownParent: jQuery(modalEl)
            });
        };

        const formatTanggal = function(dateStr) {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            if (isNaN(date.getTime())) return dateStr;

            const bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const day = String(date.getDate()).padStart(2, '0');
            const monthName = bulan[date.getMonth()];
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            return `${day} ${monthName} ${year}, ${hours}:${minutes}`;
        };

        const getFilePreview = function(filename, folder = 'laporan') {
            if (!filename) return '-';

            const ext = filename.split('.').pop().toLowerCase();
            const filePath = '/uploads/' + folder + '/' + filename;
            const imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            const docExts = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];

            if (imageExts.includes(ext)) {
                return `<img src="${filePath}" alt="Lampiran" style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #dee2e6;">`;
            }

            if (docExts.includes(ext)) {
                return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-file fs-4 me-1"></i>Lihat File</a>`;
            }

            return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-light-primary">Unduh File</a>`;
        };

        const toggleLampiranBukti = function() {
            if (!statusSelectEl || !lampiranWrapperEl) return;
            const isSelesai = statusSelectEl.value === 'selesai';
            lampiranWrapperEl.style.display = isSelesai ? 'block' : 'none';
            if (lampiranInputEl) {
                lampiranInputEl.required = isSelesai;
                lampiranInputEl.classList.toggle('is-invalid', false);
            }
        };

        initStatusSelect();

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/unit/history-laporan/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const history = data.history;
                        const laporan = history.laporan || {};
                        const privasi = laporan.is_anonymous === 'y' ? 'Anonim' : 'Rahasia';

                        document.getElementById('edit_kode_tiket').value = laporan.kode_tiket || '';
                        document.getElementById('edit_kategori').value = laporan.kategori?.nama_kategori || '-';
                        document.getElementById('edit_sub_kategori').value = laporan.sub_kategori?.nama_sub || '-';
                        document.getElementById('edit_unit_tujuan').value = laporan.kategori?.unit?.nama_unit || '-';
                        document.getElementById('edit_judul_laporan').value = laporan.judul_laporan || '';
                        document.getElementById('edit_tgl_kejadian').value = laporan.tgl_kejadian ? formatTanggal(laporan.tgl_kejadian) : '-';

                        document.getElementById('edit_nama_gedung').value = laporan.ruangan
                            ?.lantai?.gedung?.nama_gedung || '-';
                        document.getElementById('edit_nama_lantai').value = laporan.ruangan
                            ?.lantai?.nama_lantai || '-';
                        document.getElementById('edit_nama_ruangan').value = laporan.ruangan
                            ?.nama_ruangan || '-';

                        document.getElementById('edit_deskripsi_laporan').value = laporan.deskripsi_laporan || '';
                        document.getElementById('edit_nama_pelapor').value = laporan.nama_pelapor || '-';
                        document.getElementById('edit_email_pelapor').value = laporan.is_anonymous === 'y' ? 'Anonymous' : (laporan.email_pelapor || '-');
                        document.getElementById('edit_no_telp_pelapor').value = laporan.no_telp_pelapor || '-';
                        document.getElementById('edit_tipe_pelapor').value = laporan.tipe_pelapor || '-';
                        document.getElementById('edit_is_anonymous').value = privasi;
                        document.getElementById('edit_lampiran_file_preview').innerHTML = getFilePreview(laporan.lampiran_file);

                        const currentStatus = history.status || laporan.status || '';
                        const statusLabels = { 'menunggu': 'Menunggu', 'diproses': 'Diproses', 'selesai': 'Selesai', 'ditolak': 'Ditolak' };
                        document.getElementById('edit_status_sekarang').value = statusLabels[currentStatus] || currentStatus;

                        document.getElementById('edit_lampiran_bukti_preview').innerHTML = getFilePreview(history.lampiran_file, 'history-laporan');
                        document.getElementById('edit_lampiran_bukti').value = '';
                        document.getElementById('edit_catatan').value = history.catatan || '';
                        form.action = '/unit/history-laporan/' + id;

                        if (typeof jQuery !== 'undefined') {
                            initStatusSelect();
                            jQuery(statusSelectEl).val(history.status || laporan.status || '').trigger('change');
                        } else {
                            statusSelectEl.value = history.status || laporan.status || '';
                        }

                        toggleLampiranBukti();

                        modal.show();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data history laporan'
                        });
                    }
                });
            }
        });

        form.addEventListener('submit', function(e) {
            const isSelesai = statusSelectEl && statusSelectEl.value === 'selesai';
            const hasLampiran = lampiranInputEl && lampiranInputEl.files && lampiranInputEl.files.length > 0;

            if (isSelesai && !hasLampiran) {
                e.preventDefault();
                e.stopPropagation();
                lampiranInputEl.classList.add('is-invalid');

                Swal.fire({
                    icon: 'warning',
                    title: 'Lampiran wajib diisi',
                    text: 'Lampiran file wajib diunggah ketika status diubah menjadi selesai.'
                });

                return;
            }

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

        modalEl.addEventListener('shown.bs.modal', function() {
            if (typeof jQuery !== 'undefined') {
                jQuery(statusSelectEl).trigger('change');
            }
        });

        if (statusSelectEl) {
            statusSelectEl.addEventListener('change', toggleLampiranBukti);

            if (typeof jQuery !== 'undefined') {
                jQuery(statusSelectEl).on('change', toggleLampiranBukti);
            }
        }

        if (lampiranInputEl) {
            lampiranInputEl.addEventListener('change', function() {
                lampiranInputEl.classList.toggle('is-invalid', lampiranInputEl.required && lampiranInputEl.files.length === 0);
            });
        }
    });
</script>
