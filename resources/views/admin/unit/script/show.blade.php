<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);
        const statusBadge = document.getElementById('show_status_badge');

        function renderStatusBadge(status) {
            const normalizedStatus = (status || '').toString().toLowerCase();

            statusBadge.className = 'badge fs-sm-8 fs-lg-6';

            if (normalizedStatus === 'aktif') {
                statusBadge.classList.add('text-white', 'bg-success');
                statusBadge.textContent = 'Aktif';
                return;
            }

            if (normalizedStatus === 'nonaktif') {
                statusBadge.classList.add('text-white', 'bg-danger');
                statusBadge.textContent = 'Nonaktif';
                return;
            }

            statusBadge.classList.add('bg-secondary');
            statusBadge.textContent = status || '-';
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');
                const showUrl = "{{ route('admin.unit.show', ':id') }}".replace(':id', encodeURIComponent(id));

                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama_unit').value = data.nama_unit ||
                            '';
                        document.getElementById('show_singkatan').value = data.singkatan ||
                            '';
                        renderStatusBadge(data.status);
                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data unit'
                        });
                    }
                });
            }
        });
    });
</script>
