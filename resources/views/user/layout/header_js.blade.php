<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('User/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('User/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('User/js/main.js') }}"></script>
<script>
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.count') }}", // Replace with your route to get cart count
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#cart-count').text(response.count); // Update the cart count in the span
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Handle error response
            }
        });
    }

    // Call the function initially and set interval to update every 30 seconds
    $(document).ready(function() {
        updateCartCount(); // Initial call
        setInterval(updateCartCount, 30000); // Update every 30 seconds (adjust as needed)
    });
</script>
