<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ReviewManagement\ReviewManagementService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $reviewManagementService;

    public function __construct(ReviewManagementService $reviewManagementService)
    {
        $this->reviewManagementService = $reviewManagementService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer', // Add validation for rating
        ]);

        try {
            $review = $this->reviewManagementService->store($request);
            if ($review) {
                return redirect()->back()->with('success', 'Your review was posted successfully');
            } else {
                return redirect()->back()->with('error', 'Your review failed to post');
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function contact()
    {
        return view('user.contact.index');
    }
}
