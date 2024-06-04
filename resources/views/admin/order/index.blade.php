@extends('admin.layout.layout')

@section('section')

<div class="container">
  <div class="card">
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
       
    </div>
    
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Order ID</th>
                    <th class="min-w-125px">Customer Name</th>
                    <th class="min-w-125px">Total Amount</th>
                    <th class="min-w-125px">Payment Method</th>
                    <th class="min-w-125px">Paid At</th>
                    <th class="min-w-125px">Shipping Address</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold">
                <!--begin::Table row-->
           
                @foreach ($order as $orders) 
            
                    <tr>
                        <!--begin::User-->
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <!-- Replace with actual avatar image URL -->
                                {{-- <div class="symbol-label">
                                    <img src="{{ asset('Admin/assets/media/avatars/150-1.jpg') }}" alt="dd" class="w-100" />
                                </div> --}}
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $orders->order_id }}</a>
                                {{-- <span>{{ $orders->email }}</span> --}}
                            </div>
                            <!--end::User details-->
                        </td>
                        <!--end::User-->
                        <td>{{ $orders->customer_name }}</td>
                        <!--begin::Role-->
                        <td>{{ $orders->total_amount }}</td>
                        <td>{{  $orders->payment_method == 0 ? 'Active' : 'Disable' }}</td>
                        
                        <!--end::Role-->
                        <!--begin::Last login-->
                        <td>
                            <div class="badge badge-light fw-bolder">{{ $orders->paid_at }}</div>
                        </td>
                        <!--end::Last login-->
                        <!--begin::Joined-->
                        <td>{{ $orders->shipping_address }}</td>
                        <!--end::Joined-->
                        <!--begin::Action-->
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Edit</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Delete</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action-->
                    </tr>
              @endforeach
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
</div>





@endsection


