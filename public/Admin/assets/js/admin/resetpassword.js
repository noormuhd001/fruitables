$(document).ready(function () {
    $('#resetpassword').validate({
        rules: {
            name: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            confirmpassword: {
                required: true,
                equalTo: '#password' // Ensure confirmpassword matches password
            },
            email: {
                required: true,
                email: true
            },
            toc: {
                required: true,
            },
            phone: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name.",
            },
            password: {
                required: "Please enter your password.",
                minlength: "Password must be at least 8 characters long."
            },
            confirmpassword: {
                required: "Please enter your password again.",
                equalTo: "Passwords do not match."
            },
            email: {
                required: "Please enter your email address.",
                email: "Please enter a valid email address."
            },
            toc: {
                required: "You must accept the terms and conditions.",
            },
            phone: {
                required: "Please enter a valid Mobile No",
            }
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
            
            var form_data = new FormData(form); // Serialize form data

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
                        var message = result.message;
                        // Set session message
                        sessionStorage.setItem('message', message);
                        location.href = result.route;
                    } else {
                        $('#customAlert').removeClass('d-none');
                        $('#message').text('Email Id cant be unique');
                    }
                },
                error: function (xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    $('#loginSpinner').addClass('d-none');
                    submitBtn.removeClass('d-none');

                    $('#customAlert').removeClass('d-none');
                    $('#message').text('This email is already taken');
                },
                complete: function () {
                    $('#loginSpinner').addClass('d-none');
                    submitBtn.removeClass('d-none');
                }
            });
        }
    });

    $('.btn-close').click(function () {
        $('#customAlert').addClass('d-none');
    });
});
