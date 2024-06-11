@extends('admin.layout.layout')

@section('breadcrumbs')
    {{ Breadcrumbs::render('offer.index') }}
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

        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Product ID</th>
                        <th class="min-w-125px">Title</th>
                        <th class="min-w-125px">Image</th>
                        <th class="min-w-125px"> Description</th>
                        <th class="min-w-125px">Discount</th>
                        <th class="min-w-125px">Percentage</th>
                        <th class="min-w-125px">Star Date</th>
                        <th class="min-w-125px">End Date</th>
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

@push('style')
    <style>
        .dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ced4da; /* Example border color */
    padding: 6px 10px; /* Example padding */
    border-radius: 4px; /* Example border radius */
    background-color: #f3f4f6; /* Example background color */
}

.dataTables_wrapper .dataTables_filter input:focus {
    outline: none;
    border-color: #80bdff; /* Example focus border color */
}


    </style>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#kt_table_users').DataTable({
                processing: false,
                serverSide: true,
                paging: false,
                ajax: {
                    url: "{{ route('offer.list') }}",
                },
                columns: [
                    { data: 'productid', name: 'productid' },
                    { data: 'title', name: 'title' },
                    { data: 'photo', name: 'photo', render: function(data, type, full, meta) {
                        return "<img src='" + data + "' width='100px' height='100px' style='border-radius: 10px' alt='photo'>";
                    }},
                    { data: 'description', name: 'description' },
                    { data: 'discount', name: 'discount' },
                    { data: 'percentage', name: 'percentage' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
            $('.dataTables_filter input').attr('placeholder', 'Search Offer');
        });
    </script>
@endpush
