<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
public function index(){

$order = order::all();
return view('admin.order.index',['order'=>$order]);
}
}
