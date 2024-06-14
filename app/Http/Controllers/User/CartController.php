<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index(){        
        $cart = cart::all();
        return view('user.cart.index',['cart'=>$cart]);

    }
}
