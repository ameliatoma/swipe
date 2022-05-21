<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Library;
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
    public function index()
    {
        $user = Auth::user();

        $book = Book::limit(1)->with('isLiked'); 

        while($book->first()->isLiked !== null) {
            $book = Book::limit(1)->inRandomOrder()->with('isLiked');
        }  

        $book = $book->first(); 

        return view('swipe')->with('book', $book);
    }  

    public function likeBook(Request $request) {

        $bookId = $request->get('book_id');
        $user = Auth::user();

        Library::insert([
            'user_id' => $user->id,
            'book_id' => $bookId
        ]);

        return response()->json(['success'], http_response_code(200));
    }
}
