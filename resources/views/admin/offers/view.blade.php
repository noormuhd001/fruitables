@extends('admin.layout.layout')
@section('breadcrumbs')

{{ Breadcrumbs::render('offer.edit', $offer->id) }}
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
    <form  class="form"
    action="{{ route('offer.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $offer->id }}" name="id" id="id">
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-bold fs-6 mb-2">Title</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="hidden" value="{{ $offer->id }}" name="id">
            <input type="text" name="title"
                class="form-control form-control-solid mb-3 mb-lg-0"
               value="{{ $offer->title  }}" required />
            <!--end::Input-->
        </div>

        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-bold fs-6 mb-2">Photo</label> <br>
            <!--end::Label-->
            <!--begin::Input-->
            <img src="{{ asset($offer->photo) }}" alt="Product Image" height="100px" width="100px" style="border-radius: 10px">

            <input type="file" name="photo"
                class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $offer->photo }}"  />
            <!--end::Input-->
        </div>
  
        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-bold fs-6 mb-2"> Description</label>
            <!--end::Label-->
            <!--begin::Input-->
            <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0 @error('description') is-invalid @enderror" rows="3"
             required>{{$offer->description }}</textarea>
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Price</label>
            <input type="number" id="price" name="price"
                class="form-control form-control-solid mb-3 mb-lg-0 @error('price') is-invalid @enderror"
                placeholder="Price" value="{{ $offer->price }}" />
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Percentage</label>
            <input type="number" id="percentage" name="percentage"
                class="form-control form-control-solid mb-3 mb-lg-0 @error('percentage') is-invalid @enderror"
                placeholder="Discount percentage" value="{{ $offer->offer_percentage }}" />
            @error('percentage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Discounted Price</label>
            <input type="text" id="discount" name="discount"
                class="form-control form-control-solid mb-3 mb-lg-0 @error('discount') is-invalid @enderror"
                placeholder="Discounted amount"  value="{{ $offer->discount }}" readonly />
            @error('discount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="fv-row mb-7">
            <!--begin::Label-->
            <label class="required fw-bold fs-6 mb-2">Stock</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input type="number" name="stock"
                class="form-control form-control-solid mb-3 mb-lg-0"
                placeholder="Stock" value="{{ $offer->stock }}" required />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
    </div>

    <div class="fv-row mb-7">
        <label class="required fw-bold fs-6 mb-2">Start Date</label>
        <input type="date" name="start_date"
            class="form-control form-control-solid mb-3 mb-lg-0 @error('start_date') is-invalid @enderror"
            placeholder="Start date" value="{{ $offer->start_date }}" />
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="fv-row mb-7">
        <label class="required fw-bold fs-6 mb-2">End Date</label>
        <input type="date" name="end_date"
            class="form-control form-control-solid mb-3 mb-lg-0 @error('end_date') is-invalid @enderror"
            placeholder="End date" value="{{ $offer->end_date }}" />
        @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!--end::Scroll-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
       <a href="{{ route('offer.index') }}"> <button type="button" class="btn btn-light me-3"
        data-bs-dismiss="modal">Discard</button></a>
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
</div>

@endsection

@push('script')
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
@endpush