@extends('user.layout.layout')
@push('style')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
@section('content')
    @php
        $subtotal = 0;
    @endphp
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form id="placeorder" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                        name="firstname" id="firstname" value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                        name="lastname" id="lastname" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                placeholder="House Number Street Name" name="address" id="address"
                                value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                id="city" value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                id="country" value="{{ old('country') }}">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                name="postcode" id="postcode" value="{{ old('postcode') }}">
                            @error('postcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                id="mobile" value="{{ old('mobile') }}">
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                            <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                        </div>
                        <div class="form-item">
                            <textarea class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"
                                name="ordernotes" id="ordernotes">{{ old('ordernotes') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->photo) }}" class="img-fluid rounded-circle"
                                                    style="width: 90px; height: 90px;" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price * $item->quantity }}</td>
                                            @php
                                                $subtotal += $item->price * $item->quantity;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-end">Subtotal</td>
                                        <td>{{ $subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Shipping</td>
                                        <td>{{ $subtotal > 1000 ? 'Free' : '$50' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end text-uppercase">TOTAL</td>
                                        <td>${{ $subtotal > 1000 ? $subtotal : $subtotal + 50 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="totalamount" id="totalamount"
                            value="{{ $subtotal > 1000 ? $subtotal : $subtotal + 50 }}">
                        <div class="form-check my-3">
                            <input class="form-check-input bg-primary border-0" type="checkbox" id="Delivery-1"
                                name="delivery" value="Delivery">
                            <label class="form-check-label" for="Delivery-1">Cash On Delivery</label> (<small>Currently
                                We Only Have Cash On Delivery </small>)
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" id="submitBtn"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                        <span id="message"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const LOGIN_ROUTE = "{{ route('order.place') }}";
        const COMMITTEE_ROUTE = "{{ route('user.home') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('User\js\placeorder.js') }}"></script>
@endpush
