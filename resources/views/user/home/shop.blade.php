@extends('user.layout.layout')

@push('style')
    <style>
        .fixed-dimensions {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
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
                                        <h4>Categories</h4>
                                        @foreach ($categories as $category)
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i
                                                                class="fas fa-apple-alt me-2"></i>{{ $category->name }}</a>

                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    @foreach ($offerproducts as $offerproduct)
                                        <div class="d-flex align-items-center justify-content-start mb-3">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <a href="{{ route('offeritem.view', ['id' => $offerproduct->slug]) }}">
                                                    <img src="{{ asset($offerproduct->photo) }}" class="img-fluid rounded"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="mb-2">{{ $offerproduct->title }}</h6>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">${{ $offerproduct->discount }}</h5>
                                                    <h5 class="text-danger text-decoration-line-through">
                                                        ${{ $offerproduct->price }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center my-4">
                                        <a href="{{ route('user.featuredproducts') }}"
                                            class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">View
                                            More</a>
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
                                @foreach ($product as $products)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <form action="{{ route('user.addtocart') }}" method="POST"
                                                id="addToCartForm-{{ $products->id }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $products->id }}"
                                                    id="id">
                                                <a href="{{ route('item.view', ['id' => $products->slug]) }}">
                                                    <div class="fruite-img">
                                                        <img src="{{ $products->photo }}"
                                                            class="fixed-dimensions rounded-top" alt="img">
                                                    </div>
                                                </a>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    {{ $products->category }}
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $products->name }}</h4>
                                                    <p>{{ $products->basicdescription }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{ $products->price }}/kg
                                                        </p>
                                                        <button type="button"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary addToCartButton"
                                                            data-id="{{ $products->id }}">
                                                            Add to cart
                                                        </button>
                                                        <div class="success-message text-success mt-2" style="display: none;">
                                                            Added!</div>
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
            $('.addToCartButton').click(function() {
                var button = $(this);
                var productId = button.data('id');
                var form = $('#addToCartForm-' + productId);
                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success - update the cart icon, show a success message, etc.
                        form.find('.success-message').show().delay(3000).fadeOut();
                    },
                    error: function(xhr) {
                        // Handle error - show error message, etc.
                        alert('Failed to add product to cart.');
                    }
                });
            });
        });
    </script>
@endpush
