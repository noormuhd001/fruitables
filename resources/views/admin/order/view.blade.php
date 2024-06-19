@extends('admin.layout.layout')

@section('breadcrumbs')
{{ Breadcrumbs::render('order.adminorderview', $orders->id) }}
@endsection
@section('section')


@endsection