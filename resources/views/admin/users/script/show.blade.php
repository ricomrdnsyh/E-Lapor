<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/users/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama').value = data.user.nama || '';
                        document.getElementById('show_username').value = data.user.username || '';
                        document.getElementById('show_role').value = data.user.role ? data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1) : '';
                        document.getElementById('show_unit').value = data.user.unit ? data.user.unit.nama_unit : '-';
                        document.getElementById('show_created_at').value = data.created_at_formatted || '-';
                        document.getElementById('show_updated_at').value = data.updated_at_formatted || '-';

                        modal.show();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data user'
                        });
                    }
                });
            }
        });
    });
</script>
