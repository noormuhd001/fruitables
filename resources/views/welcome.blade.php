@extends('admin.layout.layout')


@section('breadcrumbs')
    {{ Breadcrumbs::render('admindashboard') }}
@endsection
@section('section')
<div id="successMessage" class="alert alert-success d-none" role="alert"></div>

@endsection