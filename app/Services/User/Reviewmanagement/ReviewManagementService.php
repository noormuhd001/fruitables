<?php

namespace App\Services\User\Reviewmanagement;
use App\Models\Review;

class ReviewManagementService
{
 public function store($data){
    $review = new Review;
    $review->product_id = $data->id;
    $review->name = $data->name;
    $review->email = $data->email;
    $review->review = $data->review;
    $review->rating = $data->rating; // Save the rating
    $review->save();

    return $review;
 }
}
