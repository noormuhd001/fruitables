@extends('user.layout.layout')
@push('style')


@endpush
@section('content')
@php
    $subtotal = 0;
@endphp

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $carts)
                    <tr data-id="{{ $carts->id }}">
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($carts->photo) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $carts->name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">${{ $carts->price }}</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" value="{{ $carts->quantity }}" data-id="{{ $carts->id }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" >
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 total-price">${{ $carts->price * $carts->quantity }}</p>
                        </td>
                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4 delete-btn">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="subtotal">${{$subtotal += $cart->sum(function($carts) { return $carts->price * $carts->quantity; }) }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: @if ($subtotal > 1000)
                                    Free
                                    @else
                                    $50
                                @endif</p>
                            </div>
                        </div>
                        {{-- <p class="mb-0 text-end">Shipping to Ukraine.</p> --}}
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="total">${{ $subtotal > 1000 ? $subtotal : $subtotal + 50 }}</p>
                    </div>
                    <a href="{{ route('checkout') }}">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item from your cart?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>




@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-plus, .btn-minus').click(function() {
            var action = $(this).data('action');
            var input = $(this).closest('.quantity').find('.quantity-input');
            var quantity = parseInt(input.val());
            var id = input.data('id');

            if (action === 'plus') {
                quantity += 1;
            } else if (action === 'minus' && quantity > 1) {
                quantity -= 1;
            }

            if (quantity < 1) {
            quantity = 1;
        }

            input.val(quantity);

            $.ajax({
                url: '{{ route("cart.updateQuantity", ":id") }}'.replace(':id', id),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        input.closest('tr').find('.total-price').text('$' + response.total);
                        var subtotal = 0;
                        $('.total-price').each(function() {
                            subtotal += parseFloat($(this).text().replace('$', ''));
                        });
                        $('#subtotal').text('$' + subtotal);
                        var deliveryFee = subtotal > 1000 ? 0 : 50;
                        $('#total').text('$' + (subtotal + deliveryFee));
                    }
                }
            });
        });

        $('.delete-btn').click(function() {
            var row = $(this).closest('tr');
            var id = row.data('id');

            $('#deleteModal').modal('show');

            $('.confirm-delete').click(function() {
                $.ajax({
                    url: '{{ route("cart.remove", ":id") }}'.replace(':id', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            var subtotal = 0;
                            $('.total-price').each(function() {
                                subtotal += parseFloat($(this).text().replace('$', ''));
                            });
                            $('#subtotal').text('$' + subtotal);
                            var deliveryFee = subtotal > 1000 ? 0 : 50;
                            $('#total').text('$' + (subtotal + deliveryFee));

                          
                            
                            // Close the modal
                            $('#deleteModal').modal('hide');
                        }
                    }
                });
            });
        });
    });
</script>
@endpush
