@extends('admin.layout.layout')
@section('breadcrumbs')
    {{ Breadcrumbs::render('product.edit', $product->id) }}
@endsection
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form class="form" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_product_header"
                        data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Product Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ $product->name }}" required />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Product price</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="price" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ $product->price }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Photo</label> <br>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <img src="{{ asset($product->photo) }}" alt="Product Image" height="100px" width="100px"
                                style="border-radius: 10px">

                            <input type="file" name="photo" class="form-control form-control-solid mb-3 mb-lg-0" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Category</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="category" required class="form-select form-select-solid mb-3 mb-lg-0">
                                <option value="{{ $product->category }}">{{ $product->category }}</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->name }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Basic Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="basic_description" class="form-control form-control-solid mb-3 mb-lg-0" rows="3" required>{{ $product->basicdescription }}</textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Full Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="full_description" class="form-control form-control-solid mb-3 mb-lg-0" rows="5" required>{{ $product->fulldescription }}</textarea>

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-bold fs-6 mb-2">Stock</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="stock" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Stock" value="{{ $product->stock }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>
    </div>
@endsection
