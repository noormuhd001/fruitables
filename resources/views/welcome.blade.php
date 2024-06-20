@extends('admin.layout.layout')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admindashboard') }}
@endsection

@section('section')
<div id="successMessage" class="alert alert-success d-none" role="alert"></div>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Stats-->
        <div class="row g-6 g-xl-9">
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Heading-->
                        <div class="fs-2hx fw-bolder">{{ $ordercount }}</div>
                        <div class="fs-4 fw-bold text-gray-400 mb-7">Total Orders</div>
                        <!--end::Heading-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                <canvas id="kt_project_list_chart"></canvas>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-primary me-3"></div>
                                    <div class="text-gray-400">Confirmed</div>
                                    <div class="ms-auto fw-bolder text-gray-700">{{ $confirmed }}</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-success me-3"></div>
                                    <div class="text-gray-400">Shipped</div>
                                    <div class="ms-auto fw-bolder text-gray-700">{{ $shipped }}</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center">
                                    <div class="bullet bg-gray-300 me-3"></div>
                                    <div class="text-gray-400">Delivered</div>
                                    <div class="ms-auto fw-bolder text-gray-700">{{ $delivered }}</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script>
    var confirmed = {{ $confirmed }};
    var shipped = {{ $shipped }};
    var delivered = {{ $delivered }};
</script>

<script src="{{ asset('Admin/assets/js/custom/pages/projects/list/list.js') }}"></script>

@endpush
