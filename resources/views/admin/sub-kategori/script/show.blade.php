<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/sub-kategori/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama_sub').value = data
                            .nama_sub || '';
                        document.getElementById('show_nama_kategori').value = data
                            .nama_kategori || '';
                        document.getElementById('show_nama_kategori_unit').value = data
                            .nama_kategori_unit || '';
                        document.getElementById('show_nama_unit_sub').value = data
                            .nama_unit_sub || '';

                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data sub kategori'
                        });
                    }
                });
            }
        });
    });
</script>
