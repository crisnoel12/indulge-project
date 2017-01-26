<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Storage;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getProfile($username)
	{
		$user = User::where('username', '=', $username)->first();
		if(!$user){
			abort(404);
		}

        $posts = $user->posts()->notComment()->get();
		return view('profile.index')
            ->with('user', $user)
            ->with('posts', $posts)
            ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
	}
	public function getEdit()
	{
        $country = Auth::user()->country;
        $state = Auth::user()->state;

		return view('profile.edit')
            ->with('country', $country)
            ->with('state', $state);
	}
	public function postEdit(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|alpha|min:2|max:50',
			'middle_name' => 'alpha|min:2|max:50',
			'last_name' => 'required|alpha||min:2max:50',
			'email' => 'required|email|max:255'
		]);
		Auth::user()->update([
			'first_name' => $request->input('first_name'),
			'middle_name' => $request->input('middle_name'),
			'last_name' => $request->input('last_name'),
			'email' => $request->input('email'),
			'ethnicity' => $request->input('ethnicity'),
			'interested_in' => $request->input('interested_in'),
			'civil_status' => $request->input('civil_status'),
			'country' => (empty($request->input('country'))) ? Auth::user()->country : $request->input('country'),
            'state' => (empty($request->input('state'))) ? Auth::user()->state : $request->input('state'),
			'bio' => $request->input('bio')
		]);
		return redirect('/profile/edit')->with([
            'flash_message' => 'Your Profile has been updated'
        ]);
	}
    public function uploadProfilePicture(Request $request)
    {
        $file = $request->file('image');
        $picture = $file->getClientOriginalName();
        $picture_location = '/users/' . Auth::user()->username . '/' . $picture;

        $file->move('users/' . Auth::user()->username, $picture);

        Auth::user()->update(['profile_pic' => $picture_location]);

        return redirect()->back()->with([
            'flash_message' => 'Picture Upload Successful.'
        ]);
    }
    public function getChangePassword()
    {
        return view('profile.change-password');
    }
    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            "new_pass" => 'required|confirmed|min:8'
        ]);

        $password = Auth::user()->password;
        $curr_pass = $request->input('curr_pass');
        $new_pass = bcrypt($request->input('new_pass'));
        if (!Hash::check($curr_pass, $password)) {
            return redirect('/profile/change-password')->with([
                'flash_message_error' => 'You entered a wrong value for current password.'
            ]);
        }
        Auth::user()->update(['password' => $new_pass]);

        return redirect('/profile/change-password')->with([
            'flash_message' => 'Password updated successfully.'
        ]);
    }
}
