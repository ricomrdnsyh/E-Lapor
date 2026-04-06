<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_create');
        const form = document.getElementById('bt_submit_create');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');

        modalEl.addEventListener('shown.bs.modal', function() {
            const el = document.getElementById('nama_mitra');
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
