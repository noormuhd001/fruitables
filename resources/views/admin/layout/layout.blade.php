<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header_css')
@stack('style')

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('admin.layout.header')
                @yield('section')
                @include('admin.layout.footer')
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    @include('admin.layout.header_js')
    @stack('script')
</body>

</html>
