<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\orderstore;
use App\Models\cart;
use App\Models\order;
use App\Models\orderitem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Admin\Ordermanagement\OrderManagementService;

class OrderController extends Controller
{
    //
    private $ordermanagementservice;

    public function __construct(OrderManagementService $orderManagementService)
    {
        $this->ordermanagementservice = $orderManagementService;
    }
    public function index()
    {
        try {
            $order = order::all();
            return view('admin.order.index', ['order' => $order]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function getData(Request $request)
    {
        try {
            if ($request->ajax()) {
                $order = order::select('*');
                return DataTables::of($order)
                    ->addColumn('action', function ($order) {
                        return '<a href="' . route('order.adminorderview', $order->id) . '" class="btn btn-light btn-active-light-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function placeorder(orderstore $request)
    {
        try {
            $ordersuccess = $this->ordermanagementservice->placeorder($request);

            if ($ordersuccess) {
                return response()->json(['data' => true, 'route' => route('user.home')]);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }        // Redirect or return a response as needed
    }


    public function orderstatus()
    {
        try {
            $orders = $this->ordermanagementservice->orderstatus();
            if ($orders) {
                return view('user.order.index', $orders);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function orderview($id){
        try{
            $data = $this->ordermanagementservice->orderview($id);
            if($data){
             return view('user.order.view',$data);
            }else{
                return abort(404);
            }
        }catch(\Exception $e){
            report($e);
            return abort(500);;
        }
    }
    public function adminorderview($id){
        try{
            $data = $this->ordermanagementservice->adminorderview($id);
            if($data){
             return view('admin.order.view',$data);
            }else{
                return abort(404);
            }
        }catch(\Exception $e){
            report($e);
            return abort(500);;
        } 
    }

    public function changestatus(Request $request,$id){
        $changestatus = $this->ordermanagementservice->changestatus($request,$id);
        

        return redirect()->back()->with('success','Order status changed successfully ');
    }
}
