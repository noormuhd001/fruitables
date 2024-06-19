<?php

namespace App\Services\User\ShopManagement;

use App\Models\categories;
use App\Models\Product;
use App\Models\Review;

class ShopManagementService
{
 public function getdata($id){
    $review = Review::all();
    $categories = categories::all();
    $product = Product::findOrFail($id);
    $allproducts = Product::all();

    return [
        'product' => $product,
        'categories' => $categories,
        'allproducts' => $allproducts,
        'review' => $review,
    ];
 }
}
