<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //
public function index(){

$order = order::all();
return view('admin.order.index',['order'=>$order]);
}

public function getData(Request $request)
{

    if ($request->ajax()) {
        $order = order::select('*');
        return DataTables::of($order)
            ->addColumn('action', function ($order) {
                return '<a href="' . route('order.edit', $order->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Edit</a>
                        <a href="' . route('order.delete', $order->id) . '" class="btn btn-light btn-active-light-primary btn-sm">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
}
