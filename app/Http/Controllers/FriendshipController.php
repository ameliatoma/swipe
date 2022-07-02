<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FriendshipController extends Controller
{
    public $user; 

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
    
            return $next($request);
        });
        $this->user = Auth::user();
    }
    public function index()
    {
        
        $pendingRequestsReceived = User::find($this->user->id)->thisUserFriendOf('pending')->get();
        $pendingRequestsSent = User::find($this->user->id)->friendsOfThisUser('pending')->get();
        $acceptedFriends = User::find($this->user->id)->mergeFriends();


        return view('friendship')->with('pendingRequestsSent', $pendingRequestsSent)
            ->with('pendingRequestsReceived',$pendingRequestsReceived)
            ->with('acceptedFriends',$acceptedFriends);
    }

    public function makeRequest(Request $request)
    {

        $firstFriend = Friendship::where('first_user',$request->get('user_id'))->where('second_user',$this->user->id)->first();
        $secondFriend = Friendship::where('first_user',$this->user->id)->where('second_user',$request->get('user_id'))->first();
        if(!($firstFriend || $secondFriend))
        {
            $friendship = new Friendship();
    
            $friendship->first_user = $this->user->id;
            $friendship->second_user = $request->get('user_id');
            $friendship->acted_user = $this->user->id;
            $friendship->status = "pending";
            
            $friendship->save();
        }

        return response()->json(['success'], http_response_code(200));
    }

    public function acceptRequest(Request $request)
    {
        $friendship = Friendship::where('second_user',$this->user->id)
            ->where('status',"pending")
            ->where('first_user',$request->get('user_id'))
            ->first();
        $friendship->status = "confirmed";

        $friendship->save();
        return response()->json(['success'], http_response_code(200));
    }

    public function declineFriendship(Request $request)
    {
        $friendship = Friendship::where('second_user',$this->user->id)
        ->where('first_user',$request->get('user_id'))
        ->first();
        if($friendship)
        {
            $friendship->delete();
        }
        $friendship = Friendship::where('first_user',$this->user->id)
        ->where('second_user',$request->get('user_id'))
        ->first();
        if($friendship)
        {
            $friendship->delete();
        }
        return response()->json(['success'], http_response_code(200));
    }

    
}
