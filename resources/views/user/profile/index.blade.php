@extends('user.layout.layout')

@push('style')
    <style>
        .top {
            margin-top: 200px;
        }
    </style>
@endpush

@section('content')
    <div class="top">
        <div class="container w-750px">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <h3>Profile</h3>
                </div>
                <br>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
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
    </div>
@endsection
