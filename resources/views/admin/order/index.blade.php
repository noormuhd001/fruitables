@extends('admin.layout.layout')
@section('breadcrumbs')
{{ Breadcrumbs::render('order.index') }}
@endsection
@section('section')

<div class="container">
  <div class="card">
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" id="order-search" name="order-search" placeholder="Search user" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
       
    </div>
    
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Order ID</th>
                    <th class="min-w-125px">First Name</th>
                    <th class="min-w-125px">Last Name</th>
                    <th class="min-w-125px">Total Amount</th>
                    <th class="min-w-125px">Payment Method</th>
                    <th class="min-w-125px">Paid At</th>
                    <th class="min-w-125px">Shipping Address</th>
                    <th class="min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
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
            url: "{{ route('order.getdata') }}",
            type: 'GET',
            data: function(d) {
                d.searchValue = $('#order-search').val();
                // Add other filters here if needed
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'total_amount', name: 'total_amount' },
            // { data: 'offer_percentage', name: 'percentage' },
            { data: 'payment_method', name: 'payment_method' },
            { data: 'paid_at', name: 'paid_at' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    // Custom search input
    $('#order-search').on('keyup', function() {
        table.search($(this).val()).draw();
    });
    

});
</script>
@endpush







