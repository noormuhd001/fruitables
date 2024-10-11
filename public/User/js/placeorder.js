$(document).ready(function () {
    $("#placeorder").validate({
        rules: {
            firstname: {
                required: true,
                maxlength: 255,
            },
            lastname: {
                required: true,
                maxlength: 255,
            },
            address: {
                required: true,
                maxlength: 255,
            },
            city: {
                required: true,
                maxlength: 255,
            },
            country: {
                required: true,
                maxlength: 255,
            },
            postcode: {
                required: true,
                maxlength: 10,
            },
            mobile: {
                required: true,
                maxlength: 20,
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
            },
            ordernotes: {
                maxlength: 255,
            },
            delivery: {
                required: true,
            },
        },
        messages: {
            firstname: {
                required: "Please enter your firstname.",
            },
            lastname: {
                required: "Please enter your lastname.",
            },
            address: {
                required: "Please enter your address.",
            },
            city: {
                required: "Please enter your city.",
            },
            country: {
                required: "Please enter your country.",
            },
            postcode: {
                required: "Please enter your postcode.",
            },
            email: {
                required: "Please enter your email address.",
                email: "Please enter a valid email address.",
            },
            delivery: {
                required: "Please select payment option.",
            },
            mobile: {
                required: "Please enter a valid Mobile No.",
            },
        },
        errorClass: "is-invalid text-danger",
        errorPlacement: function (error, element) {
            error.appendTo(element.closest(".form-item"));
        },
        ignore: " ",
        submitHandler: function (form) {
            var submitBtn = $("#submitBtn");
            submitBtn.prop("disabled", true);
            submitBtn.addClass("d-none");

            var form_data = new FormData(form); // Serialize form data

            $.ajax({
                type: "POST",
                url: LOGIN_ROUTE,
                dataType: "JSON",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (result) {
                    if (result.data == true) {
                        var message = result.message;
                        sessionStorage.setItem("message", message);

                        // SweetAlert2 for success notification
                        Swal.fire({
                            title: 'Order Placed!',
                            text: 'Your order was placed successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = COMMITTEE_ROUTE;
                            }
                        });
                    } else {
                        $("#customAlert").removeClass("d-none");
                        $("#message").text("Email ID can't be unique.");
                    }
                },
                error: function (xhr, status, error) {
                    submitBtn.prop("disabled", false);
                    $("#loginSpinner").addClass("d-none");
                    submitBtn.removeClass("d-none");

                    $("#customAlert").removeClass("d-none");
                    $("#message").text("This email is already taken.");
                },
                complete: function () {
                    $("#loginSpinner").addClass("d-none");
                    submitBtn.removeClass("d-none");
                },
            });
        },
    });

    $(".btn-close").click(function () {
        $("#customAlert").addClass("d-none");
    });
});
