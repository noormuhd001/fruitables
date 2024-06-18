<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\orderstore;
use App\Models\cart;
use App\Models\order;
use App\Models\orderitem;
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

public function placeorder(orderstore $request){
  
    $order = new Order();
    $order->first_name = $request['firstname'];
    $order->last_name = $request['lastname'];
    $order->address = $request['address'];
    $order->city = $request['city'];
    $order->country = $request['country'];
    $order->postcode = $request['postcode'];
    $order->mobile = $request['mobile'];
    $order->email = $request['email'];
    $order->order_notes = $request['ordernotes'] ?? '';
    $order->user_id = auth()->id();
    $order->total_amount = $request->totalamount;
    $order->payment_method = 'COD';
    $order->paid_at = now();

    $order->save();

    // Assuming $cart is available in your controller method
    $userId = auth()->id();
    $cartItems = Cart::where('user_id', $userId)->get();

    foreach ($cartItems as $item) {
        // Create a new CartItem instance
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->name = $item->name;
        $orderItem->price = $item->price;
        $orderItem->quantity = $item->quantity;
        $orderItem->photo = $item->photo; // Adjust as needed

        // Save the order item to the database
        $orderItem->save();
    }

    // Optionally clear the cart
    Cart::where('user_id', $userId)->delete();

    // Redirect or return a response as needed
    return response()->json(['data' => true, 'route' => route('user.home')]);
}
}
