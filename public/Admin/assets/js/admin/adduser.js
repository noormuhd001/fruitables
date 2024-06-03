
    // Initialize the modal
    var addModal = new bootstrap.Modal(document.getElementById('kt_modal_add_user'));

    // Close modal function
    function closeAddModal() {
        addModal.hide();
    }

    // Event listener for the close button
    document.querySelector('[data-kt-users-modal-action="close"]').addEventListener('click', function() {
        closeAddModal();
    });

    // Event listener for the discard button
    document.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener('click', function() {
        closeAddModal();
    });
