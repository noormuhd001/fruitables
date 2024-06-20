@extends('user.layout.layout')
@section('content')
@push('style')
    <style>
        .size{
            min-height: 400px;
           
        }
    </style>
@endpush
<div class="container p-3">
 <div class="container-fluid py-5">
        <div class="container py-5">
    <h2>Your Orders</h2>
    @if($orders->count() == 0)
        <p>You have no orders yet.</p>
    @else
    <div class="container size">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Payment Method</th>                  
                    <th>Total</th>                    
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>${{ $order->total_amount }}</td>
                        <td>
                            @switch($order->status)
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
                        </td>
                        <td>
                            <a href="{{ route('order.detail', ['id' => $order->id]) }}">
                                <button class="btn btn-primary">View</button>
                            </a>
                        </td>                     
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</div>
 </div>
</div>

@endsection