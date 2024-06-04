@extends('admin.layout.layout')

@section('section')

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
        <form id="kt_modal_add_product_form" class="form"
        action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll"
            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
            data-kt-scroll-max-height="auto"
            data-kt-scroll-dependencies="#kt_modal_add_product_header"
            data-kt-scroll-wrappers="#kt_modal_add_product_scroll"
            data-kt-scroll-offset="300px">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                
                <label class="required fw-bold fs-6 mb-2">Category Name</label>
                @if (isset($category))
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <input type="text" name="name"
                        class="form-control form-control-solid mb-3 mb-lg-0"
                        value="{{ $category->name }}" required />
                @else
                    <input type="text" name="name"
                        class="form-control form-control-solid mb-3 mb-lg-0"
                        required />
                @endif
                <!--end::Label-->
                <!--begin::Input-->
                <!--end::Input-->
            </div>

            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-2">Photo</label> <br>
                @if (isset($category))
                    <img src="{{ asset($category->photo) }}" alt="Product Image" height="100px" width="100px" style="border-radius: 10px">
                @endif
                <input type="file" name="photo"
                    class="form-control form-control-solid mb-3 mb-lg-0"  />
                <!--end::Input-->
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
        <!--end::Actions-->
    </form>
    </div>
</div>

@endsection
