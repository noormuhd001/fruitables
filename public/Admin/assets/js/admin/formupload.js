
    var addProductModal = new bootstrap.Modal(document.getElementById('kt_modal_add_product'));

    // Handle form submission
    document.getElementById('kt_modal_add_product_form').addEventListener('submit', function (event) {
        event.preventDefault();
        // Simulate form submission delay
        var submitButton = this.querySelector('[type="submit"]');
        submitButton.disabled = true;
        submitButton.querySelector('.indicator-label').classList.add('d-none');
        submitButton.querySelector('.indicator-progress').classList.remove('d-none');

        setTimeout(function () {
            submitButton.disabled = false;
            submitButton.querySelector('.indicator-label').classList.remove('d-none');
            submitButton.querySelector('.indicator-progress').classList.add('d-none');

            // Close modal
            addProductModal.hide();
            // Reset form
            document.getElementById('kt_modal_add_product_form').reset();
        }, 2000); // Simulate 2 second delay
    });

    // Handle modal close
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function (button) {
        button.addEventListener('click', function () {
            document.getElementById('kt_modal_add_product_form').reset();
        });
    });

