<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Validator;
use App\User;
use App\Conversation;
use App\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Logged in user's list of conversations
     */
    public function getConversations()
    {
        $user = Auth::user();
        $conversations = Auth::user()->conversations()->orderBy('updated_at', 'desc')->get();
        return view('messages.index', compact('conversations'));
    }

    /**
     * Post message to conversation with user.
     * IF no conversation exists then create new conversation with message.
     * @param  [int]  $id      [Message ID]
     * @param  Request $request [Get message input]
     */
    public function postMessage($id, Request $request)
    {
        $user = User::where('id', $id)->first();

        $my_convos = Auth::user()->conversations()->get()->lists('id')->toArray();
        $user_convos = $user->conversations()->get()->lists('id')->toArray();
        $our_convos = array_intersect($my_convos ,$user_convos);
        $conversation_id = current($our_convos);

        if(empty($our_convos)){
            $conversation = new Conversation;
            $conversation->save();
            $conversation_id = $conversation->id;
            $conversation->users()->attach(Auth::user()->id);
            $conversation->users()->attach($id);
        }

        Auth::user()->messages()->create([
            'body' => $request->input('message'),
            'conversation_id' => $conversation_id,
        ]);

        return redirect('/messages');

    }

    /**
     * Post message to conversation with user from messages view.
     * @param  [int]  $id      [Message ID]
     * @param  Request $request [Get message input]
     */
    public function postToConversation($id, Request $request)
    {
        $this->validate($request,[
            'message-' . $id => 'required',
        ]);

        Auth::user()->messages()->create([
            'body' => $request->input('message-'. $id),
            'conversation_id' => $id,
        ]);

        return redirect('/messages');
    }

}
