<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_create');
        const form = document.getElementById('bt_submit_create');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        const roleElement = document.getElementById('role');
        const unitWrapper = document.getElementById('create_unit_wrapper');
        const unitSelect = document.getElementById('unit_id');
        const roleSelect = document.getElementById('role');
        const karyawanSelect = document.getElementById('karyawan_select');

        let karyawanData = [];
        let karyawanLoaded = false;

        // Init Select2 for role
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

        // Init Select2 for unit
        if (unitSelect && $) {
            $(unitSelect).select2({
                placeholder: '-- Pilih Unit --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_create')
            });
        }

        // Init Select2 for karyawan
        if (karyawanSelect && $) {
            $(karyawanSelect).select2({
                placeholder: '-- Pilih Karyawan --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_create')
            });
        }

        // Fetch karyawan data from API
        function loadKaryawan() {
            if (karyawanLoaded) return;

            $(karyawanSelect).empty().append('<option value="">Memuat data karyawan...</option>').trigger('change');

            $.ajax({
                url: '{{ route("admin.users.karyawan-api") }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    karyawanLoaded = true;
                    $(karyawanSelect).empty().append('<option value="">-- Pilih Karyawan --</option>');

                    if (response.success && response.data) {
                        karyawanData = response.data;
                        response.data.forEach(function(item) {
                            const label = item.nama_penduduk + ' — ' + item.lembaga;
                            $(karyawanSelect).append(
                                $('<option>', {
                                    value: item.id_penduduk,
                                    text: label,
                                    'data-nama': item.nama_penduduk,
                                    'data-telegram': item.telegram_id || '',
                                    'data-lembaga': item.lembaga
                                })
                            );
                        });
                    }
                    $(karyawanSelect).trigger('change');
                },
                error: function() {
                    $(karyawanSelect).empty().append('<option value="">Gagal memuat data</option>').trigger('change');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Gagal mengambil data karyawan dari API. Silakan coba lagi.'
                    });
                }
            });
        }

        // On karyawan select change → auto-fill username & telegram_id
        $(karyawanSelect).on('select2:select', function() {
            const selected = this.options[this.selectedIndex];
            if (selected && selected.value) {
                document.getElementById('username').value = selected.value; // id_penduduk
                document.getElementById('nama').value = selected.dataset.nama || '';
                document.getElementById('telegram_id').value = selected.dataset.telegram || '-';
            }
        });

        $(karyawanSelect).on('select2:clear', function() {
            document.getElementById('username').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('telegram_id').value = '';
        });

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

        // Load karyawan when modal is shown
        modalEl.addEventListener('shown.bs.modal', function() {
            loadKaryawan();
        });

        form.addEventListener('submit', function(e) {
            // Set nama from hidden field if empty
            if (!document.getElementById('nama').value && karyawanSelect.value) {
                const selected = karyawanSelect.options[karyawanSelect.selectedIndex];
                document.getElementById('nama').value = selected?.dataset?.nama || '';
            }

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
            $(karyawanSelect).val('').trigger('change');
            document.getElementById('username').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('telegram_id').value = '';
            toggleCreateUnitField();
        });

        toggleCreateUnitField();

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
