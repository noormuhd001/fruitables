@extends('admin.layout.layout')

@section('breadcrumbs')
    {{ Breadcrumbs::render('order.index') }}
@endsection
@section('section')
    <div class="container w-750px">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3>User Details</h3>
            </div>
            <br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButton = document.getElementById('editButton');
            const editForm = document.getElementById('editForm');

            editButton.addEventListener('click', function() {
                editForm.style.display = 'block';
                editButton.style.display = 'none';
            });
        });
    </script>
@endpush
