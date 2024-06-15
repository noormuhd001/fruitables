@extends('admin.layout.layout')

@section('breadcrumbs')
{{ Breadcrumbs::render('category.index') }}
@endsection
@section('section')
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-user-table-filter="search"
                            class="form-control form-control-solid w-250px ps-14" placeholder="Search Category"  id="product-search" name="product-search"/>
                    </div>
                    <!--end::Search-->
                </div>

                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Add category-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_product">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Add Category
                        </button>
                        <!--end::Add user-->
                    </div>

                    <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->

                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - New Card-->
                    <!--begin::Modal - Add task-->
                    <div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_product_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Add Category</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                    transform="rotate(45 7.41422 6)" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Form-->
                                    <form id="kt_modal_add_product_form" class="form"
                                        action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll"
                                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                            data-kt-scroll-max-height="auto"
                                            data-kt-scroll-dependencies="#kt_modal_add_product_header"
                                            data-kt-scroll-wrappers="#kt_modal_add_product_scroll"
                                            data-kt-scroll-offset="300px">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Category Name</label>
                                                <input type="text" name="name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Category name" required />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label class="required fw-bold fs-6 mb-2">Photo</label>
                                                <input type="file" name="photo"
                                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                                            </div>
                                        </div>
                                        <div class="text-center pt-15">
                                            <button type="button" class="btn btn-light me-3"
                                                data-bs-dismiss="modal">Discard</button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-users-modal-action="submit">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">ID</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Image</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection

@push('script')
<script src="{{ asset('Admin\assets\js\admin\formupload.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#kt_table_users').DataTable({
                processing: false,
                serverSide: true,
                paging: false,
                dom: 'lrtip',
                ajax: {
                    url: "{{ route('category.getdata') }}",
                    type: 'GET',
                    data: function(d) {
                        d.category = $('#category-filter').val();
                        d.searchValue = $('#product-search').val();
                        // Add other filters here if needed
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                  
                    
                    { data: 'name', name: 'name' },
                    { 
                        data: 'photo', 
                        name: 'photo',
                        render: function(data, type, full, meta) {
                            return "<img src='" + data + "' width='100px' height='100px' style='border-radius: 10px' alt='photo'>";
                        }
                    },
                    // { data: 'price', name: 'price' },
                    // { data: 'offer_percentage', name: 'offer_percentage' },
                    // { data: 'discount', name: 'discount' },
                    // { data: 'start_date', name: 'start_date' },
                    // { data: 'end_date', name: 'end_date' },
                    // { data: 'stock', name: 'stock' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Apply filter button click event
            $('#apply-filter').on('click', function() {
                table.ajax.reload();
            });

            // Custom search input
            $('#product-search').on('keyup', function() {
                table.search($(this).val()).draw();
            });
            
            $('#reset-filter').on('click', function() {
                $('#category-filter').val('').trigger('change'); 
                table.ajax.reload();
            });
        });
    </script>
@endpush


