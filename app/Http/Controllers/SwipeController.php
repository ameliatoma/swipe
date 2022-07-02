<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Library;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SwipeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    } 
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {   
        $thisBook = Book::find($id);
        $user = Auth::user();
        $reviews = ReviewController::getReviews($thisBook->id);

        return view('swipe')->with('book', $thisBook)->with('bookReviews', $reviews);
    }  

    public function dislikeBook()
    {
        $book = Book::limit(1)->with('isLiked'); 
        while($book->first()->isLiked !== null) {
            $book = Book::limit(1)->inRandomOrder()->with('isLiked');
        } 
        $book = $book->first(); 
        return $book->id;
    }
    public function likebookFromLibrary(Request $request)
    {
        $bookId = $request->get('book_id');
        $user = Auth::user();

        Library::insert([
            'user_id' => $user->id,
            'book_id' => $bookId
        ]);
        return response()->json(['success'], http_response_code(200));
    }

    public function likeBook(Request $request) {

        $bookId = $request->get('book_id');
        $user = Auth::user();

        Library::insert([
            'user_id' => $user->id,
            'book_id' => $bookId
        ]);

        $book = Book::limit(1)->with('isLiked'); 
        while($book->first()->isLiked !== null) {
            $book = Book::limit(1)->inRandomOrder()->with('isLiked');
        } 
        $book = $book->first(); 
        return $book->id;
    }
    
    public function getRandomBook()
    {
        $book = Book::limit(1)->with('isLiked'); 
        while($book->first()->isLiked !== null) {
            $book = Book::limit(1)->inRandomOrder()->with('isLiked');
        } 
        $book = $book->first();
        return response()->json($book->id, http_response_code(200));  
    }

    public function removeBook(Request $request)
    {
        $bookId = $request->get('book_id');
        $user = Auth::user();

        $bookRemoved = Library::where('user_id', $user->id)->where('book_id', $bookId)->first();
        $bookRemoved->delete();

        return response()->json(['success'], http_response_code(200));
    }

    public function returnUserName($id)
    {
        $user = User::where('id', $id)->first();
        return $user->name;
    }
}
