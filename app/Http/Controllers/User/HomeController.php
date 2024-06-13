<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        $category = categories::all();
        $product = Product::all();
        return view('user.home.index',['product'=>$product,'category'=>$category]);
    }

    public function shop(){
        $product = Product::all();
        $offerproducts = offer::all();
        $categories = categories::all();
        return view('user.home.shop',['product'=>$product,'categories'=>$categories,'offerproducts'=>$offerproducts]);
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
