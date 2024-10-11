@extends('user.layout.layout')

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center display-6">Offers</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Offers</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Featured Products</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="nothing">Nothing</option>
                                    <option value="popularity">Popularity</option>
                                    <option value="organic">Organic</option>
                                    <option value="fantastic">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="{{ asset('User/img/banner-fruits.jpg') }}" class="img-fluid w-100 rounded"
                                            alt="">
                                        <div class="position-absolute"
                                            style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($offer as $products)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <form action="{{ route('user.offeraddtocart') }}" method="POST"
                                                class="offer-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $products->id }}"
                                                    id="id">
                                                <a href="{{ route('offeritem.view', ['id' => $products->slug]) }}">
                                                    <div class="fruite-img">
                                                        <img src="{{ asset($products->photo) }}"
                                                            class="img-fluid w-100 rounded-top" alt="img">
                                                    </div>
                                                </a>
                                                {{-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    {{ $products->category }}
                                                </div> --}}
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $products->title }}</h4>
                                                    <p>{{ $products->description }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">
                                                            <span
                                                                style="text-decoration: line-through;">{{ $products->price }}/kg</span>
                                                            <span class="text-danger ms-2">
                                                                {{ $products->discount }}/kg
                                                            </span>
                                                            <br>
                                                            <span class="text-success">
                                                                {{ $products->offer_percentage }}% off
                                                            </span>
                                                        </p>
                                                        @php
                                                            $isInCart = $cart->contains('product_id', $products->id); // Assuming $cart is a collection of items
                                                        @endphp

                                                        @if ($isInCart)
                                                            <button type="button" class="btn btn-success rounded-pill px-3"
                                                                disabled>
                                                                Added
                                                            </button>
                                                        @else
                                                            <button type="submit"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary addToCartButton"
                                                                data-id="{{ $products->id }}">
                                                                Add to cart
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
                                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle the offer form submission
            $('.offer-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const form = $(this);
                const url = form.attr('action');
                const button = form.find('.addToCartButton'); // Find the button within the current form
                const formData = form.serialize(); // Serialize the form data

                // Send the AJAX POST request
                $.post(url, formData)
                    .done(function(response) {
                        // Disable the button and update its text after successful submission
                        button.prop('disabled', true).text('Added')
                            .removeClass(
                                'btn border border-secondary rounded-pill px-3 text-primary addToCartButton'
                            )
                            .addClass('btn btn-success rounded-pill px-3');
                        // Optionally display success message
                        // form.find('.success-message').show();
                    })
                    .fail(function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Something went wrong. Please try again.');
                    });
            });
        });
    </script>
@endpush
