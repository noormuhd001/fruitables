<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index(){        
        $cart = cart::all();
        return view('user.cart.index',['cart'=>$cart]);

    }

    public function addTocart(Request $request) {
        $id = $request->id;
        $product = Product::findOrFail($id); // Assuming your product model is named Product
    
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();
    
        if ($existingCart) {
            $existingCart->quantity += 1;
            $existingCart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->user_id = Auth::id();
            $cart->name = $product->name;
            $cart->price = $product->price;
            $cart->photo = $product->photo;
            $cart->quantity = 1;
            $cart->save();
        }
    
        return redirect()->route('user.shop')->with('success', 'Product added to cart successfully.');
    }
    
    
 
        public function updatequantity(Request $request ,$id)
{
    $cart = Cart::findOrFail($id);
    if ($cart) {
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json(['success' => true, 'total' => $cart->price * $cart->quantity]);
    }
    return response()->json(['success' => false,'message'=>'Item Removed From Your Cart Successively']);
}

public function remove($id){

    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();

    return response()->json(['success' => true]);
}
    }

