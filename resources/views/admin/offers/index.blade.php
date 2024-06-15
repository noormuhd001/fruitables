@extends('admin.layout.layout')

@section('breadcrumbs')
    {{ Breadcrumbs::render('product.index') }}
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

    <div class="container">
        <div class="card">
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" id="product-search" name="product-search" class="form-control form-control-solid w-250px ps-14"
                    placeholder="Search offer" />

            </div>

            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Image</th>
                            <th class="min-w-125px"> Description</th>
                            <th class="min-w-125px">Price</th>
                            <th class="min-w-125px">Percentage</th>
                            <th class="min-w-125px">Discount Price</th>
                            <th class="min-w-125px">Start Date</th>
                            <th class="min-w-125px">End Date</th>
                            <th class="min-w-125px">Stock</th>
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
                    url: "{{ route('offer.list') }}",
                    type: 'GET',
                    data: function(d) {
                        d.category = $('#category-filter').val();
                        d.searchValue = $('#product-search').val();
                        // Add other filters here if needed
                    }
                },
                columns: [
                    { data: 'title', name: 'title' },
                  
                    { 
                        data: 'photo', 
                        name: 'photo',
                        render: function(data, type, full, meta) {
                            return "<img src='" + data + "' width='100px' height='100px' style='border-radius: 10px' alt='photo'>";
                        }
                    },
                    { data: 'description', name: 'description' },
                    { data: 'price', name: 'price' },
                    { data: 'offer_percentage', name: 'offer_percentage' },
                    { data: 'discount', name: 'discount' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'stock', name: 'stock' },
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
