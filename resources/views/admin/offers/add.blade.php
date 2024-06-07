@extends('admin.layout.layout')



@section('breadcrumbs')
{{ Breadcrumbs::render('offer.add') }}
@endsection
@section('section')

<div class="container">

    <div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header" id="kt_modal_add_product_header">
        <!--begin::Modal title-->
        <h2 class="fw-bolder">Add Offer</h2>
       
    </div>
    <!--end::Modal header-->
    <!--begin::Modal body-->
    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
        <!--begin::Form-->
        <form id="kt_modal_add_product_form" class="form"
            action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label class="required fw-bold fs-6 mb-2">Product Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name"
                        class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror"
                        placeholder="Product name" required />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Product price</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="price"
                        class="form-control form-control-solid mb-3 mb-lg-0 @error('price') is-invalid @enderror"
                        placeholder="Product price" required />
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Photo</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="file" name="photo"
                        class="form-control form-control-solid mb-3 mb-lg-0 @error('photo') is-invalid @enderror"
                        required />
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
           
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2"> Description</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror" rows="3"
                        placeholder="Basic description" required></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Percentage</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="percentage" class="form-control form-control-solid mb-3 mb-lg-0 @error('percentage') is-invalid @enderror" rows="5"
                        placeholder="Percentage" required>
                    @error('percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Stock</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="number" name="stock"
                        class="form-control form-control-solid mb-3 mb-lg-0 @error('stock') is-invalid @enderror"
                        placeholder="Stock" required />
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <a href="{{ route('product.index') }}">
                    <button type="button" class="btn btn-light me-3"
                    data-bs-dismiss="modal">Discard</button>
                </a>
                
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
        <!--end::Form-->
    </div>
    <!--end::Modal body-->
</div>

</div>

@endsection
