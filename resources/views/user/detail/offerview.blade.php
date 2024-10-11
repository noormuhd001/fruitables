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
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center display-6">Offer Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.shop') }}">Shop</a></li>
            <li class="breadcrumb-item active">Offer Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset($offer->photo) }}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $offer->name }}</h4>
                            <p class="mb-3">Category: {{ $offer->category }}</p>
                            <p class="text-dark fs-5 fw-bold mb-0">
                                <span style="text-decoration: line-through;">{{ $offer->price }}/kg</span>
                                <span class="text-danger ms-2">
                                    {{ $offer->discount }}/kg
                                </span>
                                <br>
                                <span class="text-success">
                                    {{ $offer->offer_percentage }}% off
                                </span>
                            </p>
                            {{-- <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div> --}}
                            <p class="mb-4">{{ $offer->description }}</p>

                            <form action="{{ route('user.offeraddtocart') }}" method="POST" class="offer-form">
                                @csrf
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" value="{{ $offer->id }}">
                                <input type="submit" class="btn border border-secondary rounded-pill px-3 text-primary"
                                    value="Add to cart">
                                <div class="success-message text-success mt-2" style="display: none;">Added!</div>
                            </form>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">

                                    <p>{{ $offer->fulldescription }}</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        @foreach ($review as $reviews)
                                            <div class="container-fluid">
                                                <p class="mb-2" style="font-size: 14px;">{{ $reviews->created_at }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{ $reviews->name }}</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>{{ $reviews->review }} </p>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        {{-- form --}}
                        <form id="postreview" method="POST" action="{{ route('review.post') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $offer->id }}">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" id="name"
                                            name="name" placeholder="Your Name *" value="{{ old('name') }}"
                                            required>
                                        @if ($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" id="email"
                                            name="email" placeholder="Your Email *" value="{{ old('email') }}"
                                            required>
                                        @if ($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea id="review" class="form-control border-0" name="review" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false" required>{{ old('review') }}</textarea>
                                        @if ($errors->has('review'))
                                            <div class="text-danger">{{ $errors->first('review') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;"
                                                id="star-rating">
                                                <i class="fa fa-star text-muted" data-value="1"></i>
                                                <i class="fa fa-star text-muted" data-value="2"></i>
                                                <i class="fa fa-star text-muted" data-value="3"></i>
                                                <i class="fa fa-star text-muted" data-value="4"></i>
                                                <i class="fa fa-star text-muted" data-value="5"></i>
                                            </div>
                                        </div>
                                        <input type="hidden" id="rating" name="rating"
                                            value="{{ old('rating') }}">
                                        @if ($errors->has('rating'))
                                            <div class="text-danger">{{ $errors->first('rating') }}</div>
                                        @endif
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3"
                                            id="submitBtn">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach ($categories as $category)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#"><i
                                                        class="fas fa-apple-alt me-2"></i>{{ $category->name }}</a>

                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-3">Featured products</h4>
                            @foreach ($offerproducts as $offerproduct)
                                <div class="d-flex align-items-center justify-content-start mb-3">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="{{ asset($offerproduct->photo) }}" class="img-fluid rounded"
                                            alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">{{ $offerproduct->title }}</h6>
                                        {{-- <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div> --}}
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
            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($allproducts as $data)
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="{{ asset($data->photo) }}" class="fixed-dimensions rounded-top"
                                    alt="{{ $data->name }}">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                style="top: 10px; right: 10px;">{{ $data->category }}</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{ $data->name }}</h4>
                                <p>{{ $data->basicdescription }}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">{{ $data->price }}</p>
                                    <a href="#"
                                        class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- Single data End -->
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('#star-rating .fa-star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    ratingInput.value = value;

                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.classList.remove('text-muted');
                            s.classList.add('text-warning');
                        } else {
                            s.classList.add('text-muted');
                            s.classList.remove('text-warning');
                        }
                    });
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission via AJAX
            $('.offer-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Show the success message
                        form.find('.success-message').show().delay(3000).fadeOut();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here
                        console.error(error);
                        alert('Something went wrong. Please try again.');
                    }
                });
            });

            // Handle quantity increment and decrement
            $('.btn-minus').on('click', function() {
                var input = $(this).closest('.quantity').find('input[name="quantity"]');
                var value = parseInt(input.val()) - 1;
                if (value < 1) value = 1;
                input.val(value);
            });

            $('.btn-plus').on('click', function() {
                var input = $(this).closest('.quantity').find('input[name="quantity"]');
                var value = parseInt(input.val()) + 1;
                input.val(value);
            });
        });
    </script>
@endpush
