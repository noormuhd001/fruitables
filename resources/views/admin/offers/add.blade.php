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
                <h2 class="fw-bolder">Add Offer</h2>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form  action="{{ route('offer.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="add_offer_scroll" data-kt-scroll="true">
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Title</label>
                            <input type="text" name="title"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('title') is-invalid @enderror"
                                placeholder="Offer title" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Description</label>
                            <textarea name="description"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror" rows="3"
                                placeholder="Offer description"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Price</label>
                            <input type="number" id="price" name="price"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('price') is-invalid @enderror"
                                placeholder="Price" />
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Discounted Price</label>
                            <input type="text" id="discount" name="discount"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('discount') is-invalid @enderror"
                                placeholder="Discounted amount" readonly />
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Percentage</label>
                            <input type="number" id="percentage" name="percentage"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('percentage') is-invalid @enderror"
                                placeholder="Discount percentage" />
                            @error('percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Start Date</label>
                            <input type="date" name="start_date"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('start_date') is-invalid @enderror"
                                placeholder="Start date" />
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">End Date</label>
                            <input type="date" name="end_date"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('end_date') is-invalid @enderror"
                                placeholder="End date" />
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Photo</label>
                            <input type="file" name="photo"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('photo') is-invalid @enderror" />
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Stock</label>
                            <input type="number" name="stock"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('stock') is-invalid @enderror"
                                placeholder="Stock" />
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="text-center pt-15">
                        <a href="{{ route('offer.index') }}">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        </a>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>

    <!--begin::Script-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInput = document.getElementById('price');
            const percentageInput = document.getElementById('percentage');
            const discountInput = document.getElementById('discount');

            function updateDiscount() {
                const price = parseFloat(priceInput.value) || 0;
                const percentage = parseFloat(percentageInput.value) || 0;
                const discount = price - (price * (percentage / 100));
                discountInput.value = discount.toFixed(2);
            }

            priceInput.addEventListener('input', updateDiscount);
            percentageInput.addEventListener('input', updateDiscount);
        });
    </script>
    <!--end::Script-->
@endsection
