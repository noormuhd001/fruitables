<?php

namespace App\Services\User\Homemanagement;

use App\Models\Cart;
use App\Models\categories;
use App\Models\offer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeManagementService
{
    public function index()
    {

        $category = categories::all();
        $product = Product::all();
        $cart = Cart::where('user_id', auth()->id())->get(); 

        return [
            'product' => $product,
            'category' => $category,
            'cart' => $cart

        ];
    }

    public function shop()
    {
        $product = Product::all();
        $offerproducts = offer::all();
        $categories = categories::all();
        $cart = Cart::where('user_id', auth()->id())->get(); 
        return [
            'product' => $product,
            'categories' => $categories,
            'offerproducts' => $offerproducts,
            'cart' => $cart
        ];
    }

    public function profile(){
        $id = auth()->id();
        $user = User::findOrFail($id);
        return [
         'user'=>$user,
        ];
    }
}
