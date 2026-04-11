<script>
    $(function() {
        $('#example').DataTable({
            processing: false,
            serverSide: true,
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            ajax: '{{ route('unit.history-laporan.data') }}',
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
            columns: [{
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'action',
                    name: 'action'
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
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'nama_pelapor',
                    name: 'nama_pelapor'
                },
                {
                    data: 'unit_penangan',
                    name: 'unit_penangan'
                },
                {
                    data: 'catatan',
                    name: 'catatan'
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
                    title: 'Data History Laporan Unit',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    title: 'Data History Laporan Unit',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                }
            ],
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
