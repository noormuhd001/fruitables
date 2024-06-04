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
            <form class="form" action="{{ route('customer.update') }}" method="POST">
                @csrf
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Full Name</label>
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="{{ $user->name }}" />

                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="{{ $user->email }}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Phone</label>
                        <input type="tel" name="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="{{ $user->phone }}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ $user->password }}" />
                            <button type="button" class="btn btn-light" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-15">
                    <a href="{{ route('customer.index') }}"> <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>                    </a>
                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
