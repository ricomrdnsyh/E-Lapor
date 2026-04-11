<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);
        const formatTanggal = function(dateStr) {
            if (!dateStr) return '-';
            const bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const normalized = dateStr.replace('T', ' ');
            const datePart = normalized.substring(0, 10);
            const timePart = normalized.substring(11, 16);

            if (!datePart || !timePart) return dateStr;

            const [year, month, day] = datePart.split('-');
            const monthName = bulan[parseInt(month, 10) - 1];

            if (!year || !monthName || !day) return dateStr;

            return `${day} ${monthName} ${year}, ${timePart}`;
        };
        const getFilePreview = function(filename) {
            if (!filename) return '-';
            const ext = filename.split('.').pop().toLowerCase();
            const filePath = '/uploads/laporan/' + filename;
            const imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            const docExts = ['pdf'];

            if (imageExts.includes(ext)) {
                return `<img src="${filePath}" alt="Lampiran" style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #dee2e6;">`;
            } else if (docExts.includes(ext)) {
                return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf fs-4 me-1"></i>Lihat PDF</a>`;
            }

            return '-';
        };

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/unit/history-laporan/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const history = data.history;
                        const laporan = history.laporan || {};
                        const privasi = laporan.is_anonymous === 'y' ? 'Anonim' : 'Terbuka / Rahasia';

                        document.getElementById('show_kode_tiket').value = laporan.kode_tiket || '';
                        document.getElementById('show_kategori').value = laporan.kategori?.nama_kategori || '-';
                        document.getElementById('show_unit_tujuan').value = laporan.kategori?.unit?.nama_unit || '-';
                        document.getElementById('show_status').value = history.status ? history.status.charAt(0).toUpperCase() + history.status.slice(1) : '-';
                        document.getElementById('show_judul_laporan').value = laporan.judul_laporan || '-';
                        document.getElementById('show_nama_pelapor').value = laporan.nama_pelapor || '-';
                        document.getElementById('show_email_pelapor').value = laporan.email_pelapor || '-';
                        document.getElementById('show_no_telp_pelapor').value = laporan.no_telp_pelapor || '-';
                        document.getElementById('show_tipe_pelapor').value = laporan.tipe_pelapor || '-';
                        document.getElementById('show_is_anonymous').value = privasi;
                        document.getElementById('show_tgl_kejadian').value = laporan.tgl_kejadian ? formatTanggal(laporan.tgl_kejadian) : '-';
                        document.getElementById('show_lokasi_kejadian').value = laporan.lokasi_kejadian || '-';
                        document.getElementById('show_deskripsi_laporan').value = laporan.deskripsi_laporan || '-';
                        document.getElementById('show_lampiran_file').innerHTML = getFilePreview(laporan.lampiran_file);
                        document.getElementById('show_created_at').value = data.created_at_formatted || '-';
                        document.getElementById('show_updated_at').value = data.updated_at_formatted || '-';
                        document.getElementById('show_catatan').value = history.catatan || '-';

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
    });
</script>
