<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer', // Add validation for rating
        ]);

        $review = new Review;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->review;
        $review->rating = $request->rating; // Save the rating
        $review->save();

        return redirect()->back()->with('success', 'Your review was posted successfully');
    }
}
