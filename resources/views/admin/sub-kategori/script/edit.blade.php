<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        let currentEditId = null;

        const selectElement = document.getElementById('edit_kategori_id');
        if (selectElement && $) {
            $(selectElement).select2({
                placeholder: '-- Pilih Kategori --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_edit'),
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    if (typeof data.text === 'undefined') {
                        return null;
                    }

                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    return null;
                }
            });
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');
                currentEditId = id;

                $.ajax({
                    url: '/admin/sub-kategori/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('edit_nama_sub').value = data
                            .nama_sub || '';

                        setTimeout(function() {
                            const selectEl = document.getElementById(
                                'edit_kategori_id');
                            $(selectEl).val(data.kategori_id).trigger('change');
                        }, 100);

                        form.action = '/admin/sub-kategori/' + id;

                        const modal = new bootstrap.Modal(modalEl);
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

        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            submitButton.disabled = true;
            submitButton.querySelector('.indicator-label').style.display = 'none';
            submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
        });

        modalEl.addEventListener('hidden.bs.modal', function() {
            form.classList.remove('was-validated');
            submitButton.disabled = false;
            submitButton.querySelector('.indicator-label').style.display = 'inline-block';
            submitButton.querySelector('.indicator-progress').style.display = 'none';
            currentEditId = null;
        });

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
