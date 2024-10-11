<?php

namespace App\Services\User\ShopManagement;

use App\Models\cart;
use App\Models\categories;
use App\Models\offer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ShopManagementService
{
 public function getdata($id){
    
    $categories = categories::all();
    $product = Product::where('slug',$id)->first();
    $review = Review::where('product_id',$product->id)->get();
    $offerproducts = offer::all();
    $allproducts = Product::all();

    return [
        'product' => $product,
        'categories' => $categories,
        'allproducts' => $allproducts,
        'offerproducts'=>$offerproducts,
        'review' => $review,
    ];
 }

 public function getofferdata($id){
   
    $categories = categories::all();
    $offer = offer::where('slug',$id)->first();
    $review = Review::where('product_id',$offer->id)->get();
    $offerproducts = offer::all();
    $allproducts = Product::all();
 
    return [
        'offer' => $offer,
        'categories' => $categories,
        'allproducts' => $allproducts,
        'offerproducts'=>$offerproducts,
        'review' => $review,
    ];
 }

 public function offerview(){
    $offer = offer::all();
    $cart = Cart::where('user_id', auth()->id())->get(); 

    return [
      'offer' => $offer,
      'cart' => $cart
    ];
 }


 public function addtocart($productId,$request){
    $product = offer::findOrFail($productId);
        $userId = Auth::id();

        $existingCart = cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $existingCart->quantity += 1;
            $existingCart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->user_id = $userId;
            $cart->name = $product->title;
            $cart->price = $product->discount;
            $cart->photo = $product->photo;
            $cart->quantity = $request->quantity ?? 1; 
            $cart->save();
        }

        return 'Product added to cart successfully.';
 }
}
