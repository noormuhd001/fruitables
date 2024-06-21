<?php

namespace App\Services\User\ShopManagement;

use App\Models\categories;
use App\Models\offer;
use App\Models\Product;
use App\Models\Review;

class ShopManagementService
{
 public function getdata($id){
    $review = Review::all();
    $categories = categories::all();
    $product = Product::findOrFail($id);
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

 public function offerview(){
    $offer = offer::all();
    return [
      'offer' => $offer,
    ];
 }
}
