$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#forgot').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
        },
        messages: {
            email: {
                required: "Please enter your Email ID",
                email: "Please enter a valid email address",
            },
        },
        errorClass: "is-invalid text-danger",
        errorPlacement: function (error, element) {
            error.appendTo(element.closest(".fv-row"));
        },
        ignore: ' ',
        submitHandler: function (form) {
            var submitBtn = $('#submitBtn');
            submitBtn.prop('disabled', true);
            submitBtn.addClass('d-none');

            var form_data = new FormData($('#forgot')[0]);

            $.ajax({
                type: "POST",
                url: LOGIN_ROUTE,
                dataType: 'JSON',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.data == true) {
                        location.href = result.route;
                    } else {
                        $('#customAlert').removeClass('d-none');
                        $('#message').text(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    submitBtn.removeClass('d-none');

                    let message = 'An error occurred. Please try again.';
                    if (xhr.status === 401) {
                        message = xhr.responseJSON.message;
                    } else if (xhr.status === 500) {
                        message = 'Server error. Please try again later.';
                    }

                    $('#customAlert').removeClass('d-none');
                    $('#message').text(message);
                }
            });
        }
    });

    $('.btn-close').click(function () {
        $('#customAlert').addClass('d-none');
    });
});
