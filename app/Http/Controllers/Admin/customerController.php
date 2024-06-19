<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userManagement\userstoreRequest;
use App\Models\User;
use App\Services\Admin\Customermanagement\CustomerManagementService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class customerController extends Controller
{
    //
    private $customerManagementService;
    public function __construct(CustomerManagementService $categoryManagementService)
    {
        $this->customerManagementService = $categoryManagementService;
    }


    public function index()
    {
        $users = User::where('role', 0)->get();
        if ($users) {
            return view('admin.customer.index', ['users' => $users]);
        } else {
            return abort(404);
        }
    }

    public function edit($id)
    {
        $user = user::findOrFail($id);
        if ($user) {
            return view('admin.customer.view', ['user' => $user]);
        } else {
            return abort(404);
        }
    }

    public function store(userstoreRequest $request)
    {
        try {
            $user = $this->customerManagementService->store($request);
            if ($user) {
                return redirect()->route('customer.index')->with('success', 'Customer added successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function update(userstoreRequest $request)
    {
        try {
            $update = $this->customerManagementService->update($request);
            if ($update) {
                return redirect()->route('customer.index')->with('success', 'Customer edited successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if ($user) {
            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully');
        } else {
            return abort(500);
        }
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {
            $customer = User::where('role', 0);
            return DataTables::of($customer)
                ->addColumn('action', function ($customer) {
                    return '<a href="' . route('customer.edit', $customer->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Edit</a>
                            <a href="' . route('customer.delete', $customer->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
