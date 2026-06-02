<script>
    $(function() {
        var table = $('#example').DataTable({
            processing: false,
            serverSide: true,
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            columnDefs: [{
                    targets: 0,
                    className: 'dt-control',
                    orderable: false,
                    searchable: false
                },
                {
                    targets: 1,
                    orderable: false,
                    searchable: false
                }
            ],
            searchHighlight: true,
            lengthMenu: [
                [10, 15, 20, 25],
                [10, 15, 20, 25]
            ],
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'colvis',
                    collectionLayout: 'fixed columns',
                    collectionTitle: 'Pengaturan Kolom',
                    className: 'btn btn-sm btn-primary mt-2 rounded-2',
                    columns: ':not(.noVis)'
                },
                {
                    extend: 'csv',
                    titleAttr: 'Csv',
                    title: 'Data Laporan',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    title: 'Data Laporan',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                }
            ],
            ajax: {
                url: '{{ route('admin.laporan.data') }}',
                data: function(d) {
                    d.status = $('#filter_status').val();
                    d.kategori_id = $('#filter_kategori').val();
                    d.unit_id = $('#filter_unit').val();
                }
            },
            columns: [{
                    data: null,
                    defaultContent: '',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_tiket',
                    name: 'kode_tiket'
                },
                {
                    data: 'judul_laporan',
                    name: 'judul_laporan'
                },
                {
                    data: 'nama_pelapor',
                    name: 'nama_pelapor'
                },
                {
                    data: 'kategori_name',
                    name: 'kategori_name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'tgl_kejadian',
                    name: 'tgl_kejadian'
                },
            ]
        });

        // Store all original Kategori options
        var allKategoriOptions = $('#filter_kategori option').clone();

        function updateKategoriFilter() {
            var selectedUnitId = $('#filter_unit').val();
            var kategoriSelect = $('#filter_kategori');
            
            // Clear current options
            kategoriSelect.empty();
            
            // Always keep it enabled
            kategoriSelect.prop('disabled', false);
            
            // Re-add options matching unit_id or all if unit_id is empty
            allKategoriOptions.each(function() {
                var optionUnitId = $(this).data('unit-id');
                if (!optionUnitId || !selectedUnitId || optionUnitId == selectedUnitId) {
                    kategoriSelect.append($(this).clone());
                }
            });
            
            // Refresh select2 and trigger change to reload table
            kategoriSelect.val('').trigger('change.select2').trigger('change');
        }

        $('#filter_unit').on('change', function() {
            updateKategoriFilter();
        });

        // Run initially to set correct state
        updateKategoriFilter();

        $('#filter_status, #filter_kategori').on('change', function() {
            table.ajax.reload();
        });

        @if ($message = Session::get('success'))
            Swal.fire({
                text: "{{ $message }}",
                icon: "success",
                confirmButtonText: "Ok, got it!",
                confirmButtonColor: '#004289',
            });
        @endif

        @if ($message = Session::get('failed'))
            Swal.fire({
                text: "{{ $message }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-sm btn-danger"
                }
            });
        @endif
    });
</script>
