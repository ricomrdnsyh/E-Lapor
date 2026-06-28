<script>
    $('#table_panduan').on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        
        $.get("{{ url('admin/panduan') }}/" + id, function (data) {
            $('#id_panduan_edit').val(data.id_panduan);
            $('#judul_edit').val(data.judul);
            $('#target_audience_edit').val(data.target_audience).trigger('change');
            
            let updateUrl = "{{ url('admin/panduan') }}/" + id;
            $('#bt_submit_edit').attr('action', updateUrl);
            
            $('#form_edit').modal('show');
        });
    });

    $('#bt_submit_edit').on('submit', function(e) {
        e.preventDefault();
        
        let url = $(this).attr('action');
        let method = "POST"; // using FormData with PUT requires _method=PUT which we added in HTML
        
        let formData = new FormData(this);
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#bt_submit_edit').find('.indicator-label').hide();
                $('#bt_submit_edit').find('.indicator-progress').show();
                $('#bt_submit_edit').find('button[type="submit"]').attr('disabled', true);
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#form_edit').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function (key, value) {
                        errorMessages += value[0] + '<br>';
                    });
                    
                    Swal.fire({
                        html: errorMessages,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                } else {
                    Swal.fire({
                        text: "Terjadi kesalahan sistem.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            },
            complete: function () {
                $('#bt_submit_edit').find('.indicator-label').show();
                $('#bt_submit_edit').find('.indicator-progress').hide();
                $('#bt_submit_edit').find('button[type="submit"]').removeAttr('disabled');
            }
        });
    });

    $('#form_edit').on('hidden.bs.modal', function () {
        $('#bt_submit_edit')[0].reset();
        $('#id_panduan_edit').val('');
        $('#target_audience_edit').val('semua').trigger('change');
    });
</script>
