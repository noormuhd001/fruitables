<!DOCTYPE html>
<html lang="en">
   @include('user.layout.header')
   @stack('style')
    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->
      @include('user.layout.navbar')
     @yield('content')      
      @include('user.layout.footer')
        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>          
    <!-- JavaScript Libraries -->
   @include('user.layout.header_js')
   
   @stack('script')
    </body>
</html>