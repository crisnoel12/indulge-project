@extends('layouts.app')

@section('content')
    <h1>Messages</h1>
      {{-- List of Conversations Tabs --}}
      <div class="medium-3 columns">
        <ul class="tabs vertical msg-contacts" id="example-vert-tabs" data-tabs>
            @foreach($conversations as $conversation)
                <li class="tabs-title {{$conversation === $conversations->last() ? 'is-active' : ''}}">
                    <a href="#convo-{{$conversation->id}}">
                    @foreach($conversation->users as $user)
                        @if(Auth::user()->username !== $user->username)
                            {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}
                        @endif
                    @endforeach
                    </a>
                </li>
            @endforeach
        </ul>
        </div>
        {{-- List of Messages for Selected Conversation  --}}
        <div class="medium-9 columns">
        <div class="tabs-content msg-content vertical" data-tabs-content="example-vert-tabs">
            @foreach($conversations as $conversation)
                <div class="tabs-panel {{$conversation === $conversations->last() ? 'is-active' : ''}}" id="convo-{{$conversation->id}}">
                @foreach($conversation->messages()->get() as $message)
                    <div class="media-object columns msg-card">
                      <div class="media-object-section">
                          <img class="thumbnail msgs-pic" src="{{$message->user->profile_pic}}">
                      </div>
                      <div class="media-object-section">
                        <a href="{{ url('/user',[$message->user->username]) }}">{{$message->user->first_name}} {{$message->user->middle_name}} {{$message->user->last_name}}</a>
                        <p>{{$message->body}}</p>
                      </div>
                      <span class="sent-date"> {{$message->created_at->diffForHumans()}} </span>
                    </div>
                    <hr>
                @endforeach
                {{-- Form to send message --}}
                <form id="message-form" method="post" action="{{url('/conversation/post', [$conversation->id])}}">
                    <textarea name="message-{{$conversation->id}}"></textarea>
                    <input class="button" type="submit" value="Send">
                    {!! csrf_field() !!}
                </form>
                </div>
            @endforeach
        </div>
      </div>

@stop
