<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;

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
     * Show User's dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $posts = Post::notComment()->where(function($query){
                return $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })->orderBy('created_at', 'desc')->paginate(10);
            return view('home')->with('posts', $posts);
        }

    }

    /**
     * Show results for user's search query by name
     */
	public function getSearch(Request $request)
    {
		$query = trim($request->input('query'));
        $id = Auth::user()->id;

		if(!$query){
            $users = User::where('id', '!=', $id)->get();
		} else {
            $users = User::where(DB::raw("Concat(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")->get();
        }

        return view('search/results')->with('users', $users)->with('query', $query);
    }

}
