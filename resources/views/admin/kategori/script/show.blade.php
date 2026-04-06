<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_show');
        const modal = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-show')) {
                const btn = e.target.closest('.btn-show');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/kategori/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('show_nama_kategori').value = data
                            .nama_kategori || '';

                        $.ajax({
                            url: '/admin/unit/' + data.unit_id + '/edit',
                            type: 'GET',
                            dataType: 'json',
                            success: function(unitData) {
                                document.getElementById('show_unit_name')
                                    .value = unitData.nama_unit || '';
                            }
                        });

                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data kategori'
                        });
                    }
                });
            }
        });
    });
</script>
