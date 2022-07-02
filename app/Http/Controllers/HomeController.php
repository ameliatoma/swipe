<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Friendship;

class HomeController extends Controller
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
        $user = User::find($id);

        $bookChunks = Book::limit(20)->whereHas('isLiked', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->simplePaginate(12);
       
        return view('home')->with('bookChunks', $bookChunks)->with('user', $user);

    } 
    public function getLoggedUser()
    {
        return response()->json(Auth::user(), http_response_code(200)); 
    }

    public function isFriendshipRequestSent($id)
    {
        $user = Auth::user();
        $friendOne = Friendship::where('first_user',$user->id)->where('second_user',$id)->first();
        $friendTwo = Friendship::where('first_user',$id)->where('second_user',$user->id)->first();
        //dd($friend);
        if($friendOne || $friendTwo)
            return 1;
        else return 0;
    }
    public function isFriend($id)
    {
        $user = Auth::user();
        $firstFriend = Friendship::where('first_user', $id)->where('second_user', $user->id)->where('status','confirmed')->first();
        $secondFriend = Friendship::where('first_user', $user->id)->where('second_user', $id)->where('status','condfirmed')->first();
        if($firstFriend || $secondFriend)
            return 1;
        return 0;
    }

}