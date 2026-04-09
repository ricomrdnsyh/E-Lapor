<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        const roleElement = document.getElementById('edit_role');
        const unitWrapper = document.getElementById('edit_unit_wrapper');
        const unitSelect = document.getElementById('edit_unit_id');
        const roleSelect = document.getElementById('edit_role');

        if (roleSelect && $) {
            $(roleSelect).select2({
                placeholder: '-- Pilih Role --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_edit'),
                minimumResultsForSearch: Infinity
            });
        }

        if (unitSelect && $) {
            $(unitSelect).select2({
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_edit')
            });
        }

        function toggleEditUnitField() {
            const showUnitField = roleElement.value === 'unit';
            unitSelect.required = showUnitField;
            $(unitSelect).prop('disabled', !showUnitField).trigger('change.select2');

            if (!showUnitField) {
                $(unitSelect).val('').trigger('change');
            }
        }

        $(roleSelect).on('change', function() {
            toggleEditUnitField();
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/users/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        document.getElementById('edit_nama').value = data.nama || '';
                        document.getElementById('edit_username').value = data.username || '';
                        $(roleSelect).val(data.role || '').trigger('change');
                        document.getElementById('edit_password').value = '';

                        toggleEditUnitField();
                        $(unitSelect).val(data.unit_id).trigger('change');

                        form.action = '/admin/users/' + id;

                        const modal = new bootstrap.Modal(modalEl);
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

        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                toggleEditUnitField();
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
        });

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
