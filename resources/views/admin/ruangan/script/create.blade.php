<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_create');
        const form = document.getElementById('bt_submit_create');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');

        const selectLantai = document.getElementById('lantai_id');
        if (selectLantai && $) {
            $(selectLantai).select2({
                placeholder: '-- Pilih Lantai --',
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

        const selectFungsi = document.getElementById('jenis_ruangan');
        if (selectFungsi && $) {
            $(selectFungsi).select2({
                placeholder: '-- Pilih Fungsi --',
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
            const el = document.getElementById('nama_ruangan');
            if (el) el.focus();
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
