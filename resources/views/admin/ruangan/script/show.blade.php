<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/ruangan/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama_ruangan').value = data
                            .nama_ruangan || '';
                        document.getElementById('show_nama_lantai').value = data
                            .nama_lantai || '';
                        document.getElementById('show_nama_gedung').value = data
                            .nama_gedung || '';
                        document.getElementById('show_nama_fungsi').value = data
                            .nama_fungsi || '';

                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data ruangan'
                        });
                    }
                });
            }
        });
    });
</script>
