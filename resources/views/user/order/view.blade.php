@extends('user.layout.layout')

@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Order Details</h1>

            <!-- Order Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h5">Order Details</h2>
                </div>
                <div class="card-body">
                    <p><strong>Order ID:</strong> {{ $orders->id }}</p>
                    <p><strong>Date:</strong> {{ $orders->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <!-- Shipping Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h5">Shipping Information</h2>
                </div>
                <div class="card-body">
                    <p><strong>First Name:</strong> {{ $orders->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $orders->last_name }}</p>
                    <p><strong>Address:</strong> {{ $orders->address }}</p>
                    <p><strong>City:</strong> {{ $orders->city }}</p>
                    <p><strong>Country:</strong> {{ $orders->country }}</p>
                    <p><strong>Postcode:</strong> {{ $orders->postcode }}</p>
                    <p><strong>Mobile:</strong> {{ $orders->mobile }}</p>
                    <p><strong>Email:</strong> {{ $orders->email }}</p>
                    <!-- Add other shipping details as needed -->
                </div>
            </div>

            <!-- Product Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h5">Product Details</h2>
                </div>
                <div class="card-body">
                    @foreach ($orderitems as $product)
                        <div class="product mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
                                </div>
                                <div class="col-md-10">
                                    <p><strong>Product Name:</strong> {{ $product->name }}</p>
                                    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Billing Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h5">Billing Information</h2>
                </div>
                <div class="card-body">
                    <p><strong>Payment Method:</strong> {{ $orders->payment_method }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($orders->total_amount, 2) }}</p>
                    <p><strong>Order Status: </strong>
                        @switch($orders->status)
                            @case(0)
                                Processing
                            @break

                            @case(1)
                                Confirmed
                            @break

                            @case(2)
                                Shipped
                            @break

                            @case(4)
                                Out for Delivery
                            @break

                            @case(5)
                                Delivered
                            @break

                            @default
                                Unknown Status
                        @endswitch
                    </p>
                </div>
            </div>
            <a href="{{ route('order.invoice', ['id' => $orders->id]) }}" class="btn btn-secondary">
                Download Invoice
            </a>
        </div>
    </div>
@endsection
