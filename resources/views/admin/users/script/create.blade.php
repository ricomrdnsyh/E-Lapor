<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_create');
        const form = document.getElementById('bt_submit_create');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        const roleElement = document.getElementById('role');
        const unitWrapper = document.getElementById('create_unit_wrapper');
        const unitSelect = document.getElementById('unit_id');
        const roleSelect = document.getElementById('role');

        if (roleSelect && $) {
            $(roleSelect).select2({
                placeholder: '-- Pilih Role --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_create'),
                minimumResultsForSearch: Infinity
            });
        }

        if (unitSelect && $) {
            $(unitSelect).select2({
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_create')
            });
        }

        function toggleCreateUnitField() {
            const showUnitField = roleElement.value === 'unit';
            unitSelect.required = showUnitField;
            $(unitSelect).prop('disabled', !showUnitField).trigger('change.select2');

            if (!showUnitField) {
                $(unitSelect).val('').trigger('change');
            }
        }

        $(roleSelect).on('change', function() {
            toggleCreateUnitField();
        });

        modalEl.addEventListener('shown.bs.modal', function() {
            const el = document.getElementById('nama');
            if (el) el.focus();
        });

        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                toggleCreateUnitField();
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
            if (!@json((bool) old('role'))) {
                $(roleSelect).val('').trigger('change');
            }
            toggleCreateUnitField();
        });

        toggleCreateUnitField();

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
