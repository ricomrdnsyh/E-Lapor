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
                        document.getElementById('show_telegram_id').value = data.user.telegram_id || '-';
                        document.getElementById('show_role').value = data.user.role ? data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1) : '';

                        let kategoriText = '-';
                        if (data.user.kategori) {
                            kategoriText = data.user.kategori.nama_kategori;
                            if (data.user.kategori.unit) {
                                kategoriText += ' (' + data.user.kategori.unit.nama_unit + ')';
                            }
                        }
                        document.getElementById('show_kategori').value = kategoriText;

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
