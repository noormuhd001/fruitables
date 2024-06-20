@extends('admin.layout.layout')

@section('breadcrumbs')
{{ Breadcrumbs::render('order.adminorderview', $orders->id) }}
@endsection

@push('style')
    <style>
        .styles{
            border: 2px solid rgb(75, 179, 115);
            padding: 5px;
            border-radius: 12px;
        }
    </style>
@endpush

@section('section')
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Order Details</h1>

        <!-- Order Details -->
        <div class="container styles">
        <div class="card-body border">
            <div class="card-header">
                <h2 class="h5">Order Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Order ID:</strong> {{ $orders->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date:</strong> {{ $orders->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Information -->
        <div class="card-body">
            <div class="card-header">
                <h2 class="h5">Shipping Information</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>First Name:</strong> {{ $orders->first_name }}</p>
                        <p><strong>Last Name:</strong> {{ $orders->last_name }}</p>
                        <p><strong>Address:</strong> {{ $orders->address }}</p>
                        <p><strong>City:</strong> {{ $orders->city }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Country:</strong> {{ $orders->country }}</p>
                        <p><strong>Postcode:</strong> {{ $orders->postcode }}</p>
                        <p><strong>Mobile:</strong> {{ $orders->mobile }}</p>
                        <p><strong>Email:</strong> {{ $orders->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="card-body">
            <div class="card-header">
                <h2 class="h5">Product Details</h2>
            </div>
            <div class="card-body">
                @foreach ($orderitems as $product)
                <div class="row mb-3">
                    <div class="col-md-2">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
                    </div>
                    <div class="col-md-5">
                        <p><strong>Product Name:</strong> {{ $product->name }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    </div>
                    <div class="col-md-2">
                        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Billing Information -->
        <div class="card-body">
            <div class="card-header">
                <h2 class="h5">Billing Information</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Payment Method:</strong> {{ $orders->payment_method }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Amount:</strong> ${{ number_format($orders->total_amount, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Order Status:</strong>
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
                                @case(3)
                                    Out for Delivery
                                    @break
                                @case(4)
                                    Delivered
                                    @break
                                @default
                                    Unknown Status
                            @endswitch
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Status Button and Modal -->
        <div class="container">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">
                Change Status
            </button>

            <!-- Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="statusForm" action="{{ route('order.changestatus', ['id' => $orders->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="status">Status</label>
                                  <select class="form-control" id="status" name="status">
    <option value="0" {{ $orders->status == 0 ? 'selected' : '' }}>Processing</option>
    <option value="1" {{ $orders->status == 1 ? 'selected' : '' }}>Confirmed</option>
    <option value="2" {{ $orders->status == 2 ? 'selected' : '' }}>Shipped</option>
    <option value="3" {{ $orders->status == 3 ? 'selected' : '' }}>Out for Delivery</option>
    <option value="4" {{ $orders->status == 4 ? 'selected' : '' }}>Delivered</option>
</select>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endpush
