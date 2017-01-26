<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return list of user's friends in friends page, along with any unaccepted friend requests.
     */
	public function getIndex()
	{
		$requests = Auth::user()->friendRequests();

		return view('friends.index')->with('requests', $requests);
	}

    /**
     * Send a friend request
     * @param  [int] $id [Recipient's id]
     */
	public function getAdd($id)
	{
		$user = User::where('id', $id)->first();

		if(!$user || Auth::user()->id === $user->id){
			return redirect('/home');
		}

		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()) || Auth::user()->isFriendsWith($user))
		{
			return redirect('/user', [$user->username]);
		}

		Auth::user()->addFriend($user);
		return redirect()->route('profile.index',$user->username)->with('info', 'Friend Request Sent.');
	}

    /**
     * Accept friend request
     * @param  [int] $id [Sender's id]
     */
	public function getAccept($id)
	{
		$user = User::where('id', $id)->first();

		if(!$user || !Auth::user()->hasFriendRequestReceived($user)){
			return redirect('/home');
		}

		Auth::user()->acceptFriendRequest($user);
		return redirect()->route('profile.index',$user->username)->with('info', 'Friend Request Accepted.');
	}
}
