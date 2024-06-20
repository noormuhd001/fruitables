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
        return [
            'product' => $product,
            'category' => $category,
        ];
    }

    public function shop()
    {
        $product = Product::all();
        $offerproducts = offer::all();
        $categories = categories::all();

        return [
            'product' => $product,
            'categories' => $categories,
            'offerproducts' => $offerproducts
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
