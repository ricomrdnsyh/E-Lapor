<script>
    $('#bt_submit_create').on('submit', function(e) {
        e.preventDefault();
        
        let url = "{{ route('admin.panduan.store') }}";
        let method = "POST"; 
        
        let formData = new FormData(this);
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#bt_submit_create').find('.indicator-label').hide();
                $('#bt_submit_create').find('.indicator-progress').show();
                $('#bt_submit_create').attr('disabled', true);
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#form_create').modal('hide');
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
                $('#bt_submit_create').find('.indicator-label').show();
                $('#bt_submit_create').find('.indicator-progress').hide();
                $('#bt_submit_create').removeAttr('disabled');
            }
        });
    });

    $('#form_create').on('hidden.bs.modal', function () {
        $('#bt_submit_create')[0].reset();
        $('#target_audience_create').val('semua').trigger('change');
    });

    function addPanduan() {
        $('#bt_submit_create')[0].reset();
        $('#target_audience_create').val('semua').trigger('change');
        
        $('#form_create').modal('show');
    }
</script>
