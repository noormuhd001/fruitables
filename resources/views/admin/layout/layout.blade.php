<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header_css')
@stack('style')

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('admin.layout.header')

                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="m-0">{{ Breadcrumbs::current()->title ?? '' }}</h3>
                            </div>
                            <div class="col-sm-6 text-right"> <!-- Changed col-sm-6 to col-sm-6 text-right -->
                                <ol class="breadcrumb float-sm-right class">
                                    @yield('breadcrumbs')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
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
