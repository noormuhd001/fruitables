<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categories;
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
        $categories = categories::all();
        return view('user.home.shop',['product'=>$product,'categories'=>$categories]);
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
