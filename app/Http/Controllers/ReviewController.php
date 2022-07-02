<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public static function getReviews($bookId)
    {
        $reviews = Review::where('book_id', $bookId)->with('reviewer')->get();
        $reviews->score = $reviews->median('score');
        return $reviews;
    }
    
    public function leaveReview(Request $request)
    {
        $user = Auth::user();
        $review = new Review();
        $review->user_id = $user->id;
        $review->book_id = $request->get('book_id');
        $review->score = $request->get('score');
        $review->comment = $request->get('comment');

        $review->save();
        return response()->json(['success'], http_response_code(200));
    }
}
