<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a post
     * @param  Request $request [post body]
     * @return [text]           [User's Post]
     */
    public function post(Request $request){
        $this->validate($request,[
            'post' => 'required|max:1000'
        ]);
        Auth::user()->posts()->create([
            'body' => $request->input('post')
        ]);
        return redirect('/home')->with([
            'flash_message' => 'Post Successful'
        ]);
    }

    /**
     * Delete post
     * @param  [int] $id [Post's id]
     */
    public function destroy($id){
        $post = Post::find($id);

        if(Auth::user()->id === $post->user_id){
            $post->delete();

            return redirect('/home')->with([
                'flash_message' => 'Post Deletion Successful'
            ]);
        } else {
            return redirect('/home')->with([
                'flash_message_error' => 'You are not authorized to delete this post.'
            ]);
        }

    }

    /**
     * Post to an existing post
     * @param  Request $request [Post body]
     * @param  [id]  $postId  [Posts' id]
     * @return [text]           [User's Post]
     */
    public function postComment(Request $request, $postId){
        $this->validate($request, [
            "comment-{$postId}" => 'required|max:1000'
        ]);

        $post = Post::notComment()->find($postId);
        if(!$post){
            return redirect('/home');
        }

        if(!Auth::user()->isFriendsWith($post->user) && Auth::user()->id !== $post->user->id){
            return redirect('/home');
        }

        $comment = Post::create([
            'body' => $request->input("comment-{$postId}"),
        ])->user()->associate(Auth::user());


        $post->comments()->save($comment);

        return redirect()->back();
    }

    /**
     * Like a post
     * @param  [id] $postId [Post's id]
     * @return [int]         [Like]
     */
    public function getLike($postId)
    {
        $post = Post::find($postId);

        if(!$post || !Auth::user()->isFriendsWith($post->user)){
            return redirect('/home');
        }

        if(Auth::user()->hasLikedPost($post)){
            return redirect()->back();
        }

        $like = $post->likes()->create([]);
        Auth::user()->likes()->save($like);
        return redirect()->back();
    }
}
