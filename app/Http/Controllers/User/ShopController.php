<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //

    public function view($id){
        $review = Review::all();
       $categories = categories::all();
        $product = Product::findorfail($id);
        $allproducts = product::all();
        return view('user.detail.index',['product'=>$product,'categories'=>$categories,'allproducts'=>$allproducts,'review'=>$review]);
    }
}
