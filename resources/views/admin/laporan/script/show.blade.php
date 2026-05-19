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
                return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf fs-4 me-1"></i>
                    Lihat PDF
                </a>`;
            } else {
                return '-';
            }
        };

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/laporan/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const laporan = data.laporan;

                        document.getElementById('show_kode_tiket').value = laporan
                            .kode_tiket || '';
                        document.getElementById('show_kategori').value = laporan.kategori
                            ?.nama_kategori || '-';
                        document.getElementById('show_unit_tujuan').value = laporan.kategori
                            ?.unit?.nama_unit || '-';
                        document.getElementById('show_status').value = laporan.status || '';
                        document.getElementById('show_judul_laporan').value = laporan
                            .judul_laporan || '';
                        document.getElementById('show_deskripsi_laporan').value = laporan
                            .deskripsi_laporan || '';
                        document.getElementById('show_nama_pelapor').value = laporan
                            .nama_pelapor || '-';
                        document.getElementById('show_email_pelapor').value = laporan
                            .email_pelapor || '-';
                        document.getElementById('show_no_telp_pelapor').value = laporan
                            .no_telp_pelapor || '-';
                        document.getElementById('show_tipe_pelapor').value = laporan
                            .tipe_pelapor || '-';
                        let lokasi = '-';
                        if (laporan.ruangan) {
                            let parts = [];
                            if (laporan.ruangan.lantai && laporan.ruangan.lantai.gedung) {
                                parts.push(laporan.ruangan.lantai.gedung.nama_gedung);
                            }
                            if (laporan.ruangan.lantai) {
                                parts.push(laporan.ruangan.lantai.nama_lantai);
                            }
                            parts.push(laporan.ruangan.nama_ruangan);
                            lokasi = parts.join(' - ');
                        }
                        document.getElementById('show_lokasi_kejadian').value = lokasi;

                        const tglKejadian = formatTanggal(laporan.tgl_kejadian);
                        document.getElementById('show_tgl_kejadian').value = tglKejadian;

                        const privasi = laporan.is_anonymous === 'y' ? 'Anonim' :
                            'Rahasia';
                        document.getElementById('show_is_anonymous').value = privasi;

                        const createdAtFormatted = formatTanggal(laporan.created_at);
                        document.getElementById('show_created_at').value =
                            createdAtFormatted;

                        document.getElementById('show_lampiran_file').innerHTML =
                            getFilePreview(laporan.lampiran_file);

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
    });
</script>
