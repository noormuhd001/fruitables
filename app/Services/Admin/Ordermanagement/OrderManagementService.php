<?php

namespace App\Services\Admin\Ordermanagement;

use App\Models\cart;
use App\Models\order;
use App\Models\orderitem;


class OrderManagementService
{
    public function placeorder($data)
    {
        $order = new order();
        $order->first_name = $data['firstname'];
        $order->last_name = $data['lastname'];
        $order->address = $data['address'];
        $order->city = $data['city'];
        $order->country = $data['country'];
        $order->postcode = $data['postcode'];
        $order->mobile = $data['mobile'];
        $order->email = $data['email'];
        $order->order_notes = $data['ordernotes'] ?? '';
        $order->user_id = auth()->id();
        $order->total_amount = $data->totalamount;
        $order->payment_method = 'COD';
        $order->paid_at = now();

        $order->save();

        // Assuming $cart is available in your controller method
        $userId = auth()->id();
        $cartItems = cart::where('user_id', $userId)->get();

        foreach ($cartItems as $item) {
            // Create a new CartItem instance
            $orderItem = new orderitem();
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

        return $order;
    }

    public function orderstatus(){
        $id = auth()->id();
        $orders = order::where('user_id',$id)->get();

        return [
     'orders' => $orders,
        ];
    }
    public function orderview($id){
      $orders = order::findOrFail($id);
      $orderitems = orderitem::where('order_id',$id)->get();

      return [
       'orders' => $orders,
       'orderitems' => $orderitems,
      ];
    }
}
