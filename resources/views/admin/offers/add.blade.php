@extends('admin.layout.layout')

@section('breadcrumbs')
    {{ Breadcrumbs::render('offer.add') }}
@endsection
@section('section')
    <div class="container">

        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="add_product_header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Add Product</h2>

            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="add_product_form" class="form" action="{{ route('offer.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="add_product_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#add_product_header" data-kt-scroll-wrappers="#add_product_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Name</label>
                            <input type="text" name="title"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror"
                                placeholder="Product name"  />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2"> price</label>
                            <input type="text" name="price"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('price') is-invalid @enderror"
                                placeholder="Product price"  />
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Photo</label>
                            <input type="file" name="photo"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('photo') is-invalid @enderror"
                                 />
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2"> Description</label>
                            <textarea name="description"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror" rows="3"
                                placeholder=" description" ></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Stock</label>
                            <input type="number" name="stock"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('stock') is-invalid @enderror"
                                placeholder="Stock"  />
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        </a>

                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
    @endsection
