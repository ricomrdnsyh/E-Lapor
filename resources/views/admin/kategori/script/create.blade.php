<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_create');
        const form = document.getElementById('bt_submit_create');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');

        const selectElement = document.getElementById('unit_id');
        if (selectElement && $) {
            $(selectElement).select2({
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_create'),
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

        modalEl.addEventListener('shown.bs.modal', function() {
            const el = document.getElementById('nama_kategori');
            if (el) el.focus();

            $('.select2-search__field').first().focus();
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

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
