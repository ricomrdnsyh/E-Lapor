<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        let currentEditId = null;

        const selectLantai = document.getElementById('edit_lantai_id');
        if (selectLantai && $) {
            $(selectLantai).select2({
                placeholder: '-- Pilih Lantai --',
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

        const selectFungsi = document.getElementById('edit_jenis_ruangan');
        if (selectFungsi && $) {
            $(selectFungsi).select2({
                placeholder: '-- Pilih Fungsi --',
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
                    url: '/admin/ruangan/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('edit_nama_ruangan').value = data
                            .nama_ruangan || '';

                        setTimeout(function() {
                            $(document.getElementById('edit_lantai_id')).val(data.lantai_id).trigger('change');
                            $(document.getElementById('edit_jenis_ruangan')).val(data.jenis_ruangan).trigger('change');
                        }, 100);

                        form.action = '/admin/ruangan/' + id;

                        const modal = new bootstrap.Modal(modalEl);
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
