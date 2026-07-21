<script>
    $(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('#example').on('error.dt', function(e, settings, techNote, message) {
            console.log('An error has been reported by DataTables: ', message);
        });

        $('#example').DataTable({
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
                    title: 'Data Sub Kategori',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    title: 'Data Sub Kategori',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary mt-2 rounded-2'
                }
            ],
            ajax: {
                url: '{{ route('admin.sub-kategori.data', [], false) }}',
                data: function(d) {
                    d.unit_id = $('#filter-unit').val();
                    d.kategori_id = $('#filter-kategori').val();
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
                    data: 'nama_sub',
                    name: 'nama_sub'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'nama_kategori_unit',
                    name: 'nama_kategori_unit'
                },
                {
                    data: 'nama_unit_sub',
                    name: 'nama_unit_sub'
                },
            ]
        });

        var allKategoris = @json($kategoris);

        $('#filter-unit').on('change', function() {
            var unitId = $(this).val();
            var $kategori = $('#filter-kategori');
            
            $kategori.empty();
            $kategori.append('<option value="">Semua Kategori</option>');
            
            if (unitId) {
                $kategori.prop('disabled', false);
                var filteredKategoris = allKategoris.filter(function(kat) {
                    return kat.unit_id == unitId;
                });
                
                filteredKategoris.forEach(function(kat) {
                    $kategori.append('<option value="' + kat.id_kategori + '">' + kat.nama_kategori + '</option>');
                });
            } else {
                $kategori.prop('disabled', true);
            }
            
            $kategori.trigger('change.select2');
            $('#example').DataTable().ajax.reload();
        });

        $('#filter-kategori').on('change', function() {
            $('#example').DataTable().ajax.reload();
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

    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data akan dihapus permanen.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/sub-kategori/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: "Tunggu Sebentar..",
                            icon: "info",
                            text: 'Sedang menghapus Data...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "Ok, got it!",
                            confirmButtonColor: '#004289',
                        });
                        $('#example').DataTable().ajax.reload(null, false);
                    },
                    error: function() {
                        Swal.fire("Error!", "Terjadi kesalahan saat menghapus data.", "error");
                    }
                });
            }
        })
    }
</script>
