<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);
        const showUrlTemplate = @json(route('pimpinan.history-laporan.show', ':id'));

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

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');
                const requestUrl = showUrlTemplate.replace(':id', id);

                $.ajax({
                    url: requestUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const history = data.history || {};
                        const laporan = history.laporan || {};
                        const privasi = laporan.is_anonymous === 'y' ? 'Anonim' : 'Rahasia';

                        document.getElementById('show_kode_tiket').value = laporan
                            .kode_tiket || '';
                        document.getElementById('show_kategori').value = laporan.kategori
                            ?.nama_kategori || '-';
                        document.getElementById('show_sub_kategori').value = laporan
                            .sub_kategori?.nama_sub || '-';
                        document.getElementById('show_unit_tujuan').value = laporan.kategori
                            ?.unit?.nama_unit || '-';
                        document.getElementById('show_judul_laporan').value = laporan
                            .judul_laporan || '-';
                        document.getElementById('show_nama_pelapor').value = laporan
                            .nama_pelapor || '-';
                        document.getElementById('show_email_pelapor').value = laporan
                            .email_pelapor || '-';
                        document.getElementById('show_no_telp_pelapor').value = laporan
                            .no_telp_pelapor || '-';
                        document.getElementById('show_tipe_pelapor').value = laporan
                            .tipe_pelapor || '-';
                        document.getElementById('show_is_anonymous').value = privasi;
                        document.getElementById('show_tgl_kejadian').value = laporan
                            .tgl_kejadian ? formatTanggal(laporan.tgl_kejadian) : '-';

                        document.getElementById('show_nama_gedung').value = laporan.ruangan
                            ?.lantai?.gedung?.nama_gedung || '-';
                        document.getElementById('show_nama_lantai').value = laporan.ruangan
                            ?.lantai?.nama_lantai || '-';
                        document.getElementById('show_nama_ruangan').value = laporan.ruangan
                            ?.nama_ruangan || '-';

                        document.getElementById('show_deskripsi_laporan').value = laporan
                            .deskripsi_laporan || '-';
                        document.getElementById('show_lampiran_laporan').innerHTML =
                            getFilePreview(laporan.lampiran_file);
                        const statusVal = history.status || laporan.status || '-';
                        let badgeClass = 'bg-secondary text-white';
                        if (statusVal === 'menunggu') badgeClass = 'bg-warning text-white';
                        else if (statusVal === 'diproses') badgeClass = 'bg-info text-white';
                        else if (statusVal === 'selesai') badgeClass = 'bg-success text-white';
                        else if (statusVal === 'ditolak') badgeClass = 'bg-danger text-white';
                        const statusText = statusVal !== '-' ? statusVal.charAt(0).toUpperCase() + statusVal.slice(1) : '-';
                        document.getElementById('show_status').innerHTML = `<span class="badge ${badgeClass} px-2 py-1">${statusText}</span>`;
                        const timelineData = data.timeline || [];
                        let timelineHtml = '<div class="track-timeline">';
                        
                        if (timelineData.length > 0) {
                            timelineData.forEach(function(item) {
                                let badgeClass = 'bg-light-secondary';
                                let textClass = 'text-secondary';
                                let iconClass = 'ki-information-5';
                                let statusTitle = 'Perubahan status';
                                let statusBadge = 'badge-light-secondary';
                                
                                if (item.status === 'menunggu') {
                                    badgeClass = 'bg-light-warning'; textClass = 'text-warning'; statusBadge = 'badge-light-warning';
                                    iconClass = 'ki-time'; statusTitle = 'Menunggu tindak lanjut';
                                } else if (item.status === 'diproses') {
                                    badgeClass = 'bg-light-info'; textClass = 'text-info'; statusBadge = 'badge-light-info';
                                    iconClass = 'ki-setting-2'; statusTitle = 'Diproses unit terkait';
                                } else if (item.status === 'selesai') {
                                    badgeClass = 'bg-light-success'; textClass = 'text-success'; statusBadge = 'badge-light-success';
                                    iconClass = 'ki-check-circle'; statusTitle = 'Laporan selesai';
                                } else if (item.status === 'ditolak') {
                                    badgeClass = 'bg-light-danger'; textClass = 'text-danger'; statusBadge = 'badge-light-danger';
                                    iconClass = 'ki-cross-circle'; statusTitle = 'Laporan ditolak';
                                }

                                const statusDisplay = item.status ? item.status.charAt(0).toUpperCase() + item.status.slice(1) : '-';
                                const itemText = item.catatan ? item.catatan : statusTitle;
                                const itemNote = item.user_nama ? 'Diperbarui oleh ' + item.user_nama : 'Dibuat oleh pelapor';
                                
                                let evidenceHtml = '';
                                if (item.lampiran_file) {
                                    evidenceHtml = `
                                        <div class="track-timeline-note mt-2">Lampiran bukti penanganan tersedia.</div>
                                        <div class="mt-2">
                                            <a href="/uploads/history-laporan/${item.lampiran_file}" target="_blank" class="btn btn-sm btn-light-success py-1 px-3">Lihat Bukti</a>
                                        </div>
                                    `;
                                }

                                timelineHtml += `
                                    <div class="track-timeline-item">
                                        <div class="track-timeline-badge ${badgeClass}">
                                            <i class="ki-duotone ${iconClass} fs-5 ${textClass}">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                            </i>
                                        </div>
                                        <div class="track-timeline-row">
                                            <div>
                                                <div class="track-timeline-item-title">${statusTitle}</div>
                                                <div class="track-timeline-item-text">${itemText}</div>
                                                <div class="track-timeline-note">${itemNote}</div>
                                                ${evidenceHtml}
                                            </div>
                                            <div class="track-timeline-meta">
                                                <div class="track-timeline-date">
                                                    ${item.created_at_formatted} &bull; ${item.time_formatted}
                                                </div>
                                                <span class="badge ${statusBadge} text-capitalize">${statusDisplay}</span>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        } else {
                            timelineHtml += '<div class="text-center text-muted">Belum ada riwayat penanganan.</div>';
                        }
                        
                        timelineHtml += '</div>';
                        document.getElementById('show_timeline_container').innerHTML = timelineHtml;

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
