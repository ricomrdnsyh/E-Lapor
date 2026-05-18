<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/lantai/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama_lantai').value = data
                            .nama_lantai || '';

                        $.ajax({
                            url: '/admin/gedung/' + data.gedung_id + '/edit',
                            type: 'GET',
                            dataType: 'json',
                            success: function(gedungData) {
                                document.getElementById('show_gedung_name')
                                    .value = gedungData.nama_gedung || '';
                            }
                        });

                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data lantai'
                        });
                    }
                });
            }
        });
    });
</script>
