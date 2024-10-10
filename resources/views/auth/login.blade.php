<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fruitables</title>
    <meta name="description"
        content="Fruitables Sign-In Page - Sign in to access the Fruitables platform. Create an account if you're new here." />
    <meta name="keywords" content="Fruitables, sign-in, login, web development, dashboard, admin themes" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Fruitables - Login" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="Fruitables" />
    <link rel="canonical" href="#" />
    <link rel="icon" href="{{ asset('Admin/assets/media/illustrations/sketchy-1/main-logo.png') }}" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">
    <link href="{{ asset('Admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('User/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('User/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('User/css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('Admin/assets/media/illustrations/sketchy-1/14.png') }})">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="" class="mb-12">
                    <h1 class="mb-5 display-3 text-primary">Fruitables</h1>
                </a>
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" id="login">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Sign In to Fruitables</h1>
                            <div class="text-gray-400 fw-bold fs-4">New Here?
                                <a href="{{ route('signuppage') }}" class="link-primary fw-bolder">Create an Account</a>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark" for="email">Email</label>
                            <input id="email" aria-describedby="emailHelp"
                                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                type="email" name="email" value="{{ old('email') }}" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">Password</label>
                                <a href="{{ route('forgotpassword') }}" class="link-primary fs-6 fw-bolder">Forgot
                                    Password?</a>
                            </div>
                            <input id="password"
                                class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                type="password" name="password" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="customAlert" class="alert alert-danger d-none">
                            <span id="message"></span>
                            <button type="button" class="btn-close"></button>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="submitBtn" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Login</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-center flex-column-auto p-10">
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="#" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:support@fruitables.com" class="text-muted text-hover-primary px-2">Contact</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const LOGIN_ROUTE = "{{ route('login') }}";
        const COMMITTEE_ROUTE = "{{ route('admindashboard') }}";
        const USER_ROUTE = "{{ route('user.home') }}";
    </script>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('Admin/assets/js/admin/login.js') }}"></script>
</body>

</html>
