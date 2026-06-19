<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('form_edit');
        const form = document.getElementById('bt_submit_edit');
        const submitButton = form.querySelector('[data-kt-contacts-type="submit"]');
        const roleSelect = document.getElementById('edit_role');
        const unitSelect = document.getElementById('edit_unit_id');
        const unitWrapper = document.getElementById('edit_unit_wrapper');
        const kategoriWrapper = document.getElementById('edit_kategori_wrapper');
        const checkAllUnit = document.querySelectorAll('.edit-check-all-unit');
        const karyawanSelect = document.getElementById('edit_karyawan_select');

        let editKaryawanData = [];
        let editKaryawanLoaded = false;
        let pendingEditData = null;

        // Init Select2
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

        if (karyawanSelect && $) {
            $(karyawanSelect).select2({
                placeholder: '-- Pilih Karyawan --',
                allowClear: true,
                width: '100%',
                language: 'id',
                dropdownParent: $('#form_edit')
            });
        }

        // Fetch karyawan data
        function loadEditKaryawan(callback) {
            if (editKaryawanLoaded) {
                if (callback) callback();
                return;
            }

            $(karyawanSelect).empty().append('<option value="">Memuat data karyawan...</option>').trigger('change');

            $.ajax({
                url: '{{ route("admin.users.karyawan-api") }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    editKaryawanLoaded = true;
                    $(karyawanSelect).empty().append('<option value="">-- Pilih Karyawan --</option>');

                    if (response.success && response.data) {
                        editKaryawanData = response.data;
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
                    if (callback) callback();
                },
                error: function() {
                    $(karyawanSelect).empty().append('<option value="">Gagal memuat data</option>').trigger('change');
                    if (callback) callback();
                }
            });
        }

        // On karyawan select change → auto-fill
        $(karyawanSelect).on('select2:select', function() {
            const selected = this.options[this.selectedIndex];
            if (selected && selected.value) {
                document.getElementById('edit_username').value = selected.value;
                document.getElementById('edit_nama').value = selected.dataset.nama || '';
                document.getElementById('edit_telegram_id').value = selected.dataset.telegram || '';
            }
        });

        $(karyawanSelect).on('select2:clear', function() {
            document.getElementById('edit_username').value = '';
            document.getElementById('edit_nama').value = '';
            document.getElementById('edit_telegram_id').value = '';
        });

        function showUnitKategoriFields(show) {
            kategoriWrapper.style.display = show ? '' : 'none';
            unitSelect.required = show;
            $(unitSelect).prop('disabled', !show).trigger('change.select2');
            if (!show) {
                $(unitSelect).val('').trigger('change');
                document.querySelectorAll('#edit_kategori_wrapper .kategori-checkbox').forEach(function(cb) {
                    cb.checked = false;
                });
            }
        }

        $(roleSelect).on('change', function() {
            showUnitKategoriFields(roleSelect.value === 'unit' || roleSelect.value === 'pimpinan');
        });

        // Check all / uncheck all per unit
        document.querySelectorAll('.edit-check-all-unit').forEach(function(cb) {
            cb.addEventListener('change', function() {
                const unitId = this.dataset.unitId;
                document.querySelectorAll('#edit_kategori_wrapper .kategori-checkbox[data-unit-id="' + unitId + '"]').forEach(function(c) {
                    c.checked = cb.checked;
                });
            });
        });

        // Pre-select karyawan by username (id_penduduk)
        function preselectKaryawan(username, nama, telegramId) {
            let found = false;
            $(karyawanSelect).find('option').each(function() {
                if (this.value === username) {
                    found = true;
                }
            });

            if (found) {
                $(karyawanSelect).val(username).trigger('change');
            } else if (username && nama) {
                const label = nama + ' (data tersimpan)';
                $(karyawanSelect).append(
                    $('<option>', {
                        value: username,
                        text: label,
                        'data-nama': nama,
                        'data-telegram': telegramId || '',
                        selected: true
                    })
                ).trigger('change');
            }

            document.getElementById('edit_nama').value = nama || '';
            document.getElementById('edit_username').value = username || '';
            document.getElementById('edit_telegram_id').value = telegramId || '';
        }

        // Handle edit button click
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.getAttribute('data-id');

                $.ajax({
                    url: '/admin/users/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        pendingEditData = data;

                        $(roleSelect).val(data.role || '').trigger('change');
                        document.getElementById('edit_password').value = '';

                        const showUnit = data.role === 'unit' || data.role === 'pimpinan';
                        showUnitKategoriFields(showUnit);

                        if (showUnit && data.unit) {
                            $(unitSelect).val(data.unit_id).trigger('change');
                            // After unit change shows kategori groups, check the user's kategoris
                            setTimeout(function() {
                                const userKategoriIds = (data.kategoris || []).map(function(k) { return k.id_kategori; });
                                document.querySelectorAll('#edit_kategori_wrapper .kategori-checkbox').forEach(function(cb) {
                                    cb.checked = userKategoriIds.includes(parseInt(cb.value));
                                });
                                document.querySelectorAll('#edit_kategori_wrapper .edit-check-all-unit').forEach(function(cb) {
                                    cb.checked = false;
                                });
                            }, 100);
                        }

                        form.action = '/admin/users/' + id;

                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();

                        loadEditKaryawan(function() {
                            preselectKaryawan(
                                data.username || '',
                                data.nama || '',
                                data.telegram_id || ''
                            );
                        });
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
            if (!document.getElementById('edit_nama').value && karyawanSelect.value) {
                const selected = karyawanSelect.options[karyawanSelect.selectedIndex];
                document.getElementById('edit_nama').value = selected?.dataset?.nama || '';
            }

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
            pendingEditData = null;
        });

        @if ($errors->any())
            (new bootstrap.Modal(modalEl)).show();
        @endif
    });
</script>
