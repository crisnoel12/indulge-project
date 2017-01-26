@extends('layouts.app')

@section('content')
	<div class="row">
		{{-- Profile Picture --}}
		<div class="column large-12 profileHead">
			<div class="column small-12 large-2">
				@include('partials/upload-pic-modal')
				<a data-open="upload-pic-modal">
					<img class="thumbnail profile-pic" src="{{$user->profile_pic}}">
				</a>
			</div>
			{{-- User's Profile Information --}}
			<div class="column small-12 large-10">
				<h1 class="profileName">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h1>
				<h4 class="profileAge">{{$user->age}}, <span>{{ $user->gender }}</span></h4>
				<h4 class="profilePlace">
					@if ($user->state && $user->country)
					  {{$user->state}}, {{$user->country}}
				    @elseif ($user->country)
					  {{$user->country}}
				    @elseif ($user->state)
					  {{$user->state}}
				    @endif
				</h4>

				{{-- If User is visting another user's profile and they are friends, add a message button  --}}
				@if(Auth::user()->id !== $user->id && Auth::user()->isFriendsWith($user))
					<a data-open="msg-modal" class="button" type="button"><span class="icon-envelop"> </span>Message</a>
					@include('partials/_snd-msg-modal')
				@endif

				{{-- If user is on own profile, add edit profile link --}}
				@if(Auth::user()->id === $user->id)
					<a href="{{ url('/profile/edit')}}">Edit Profile</a>
				@elseif(Session::get('info'))
					<p>{{Session::get('info')}}</p>
				{{-- If user sent a friend request that hasnt been accepted --}}
				@elseif(Auth::user()->hasFriendRequestReceived($user))
					<a href="{{ url('/user/accept', [$user->id])}}" class="button" type="button"><span class="icon-user-plus"> </span>Accept Friend Request</a>
				{{-- If user sent a friend request that hasnt been accepted --}}
				@elseif(Auth::user()->hasFriendRequestPending($user))
					<p>Waiting for {{ $user->first_name }} to accept...</p>
				{{-- Add delete friend button if user is friends with other user --}}
				@elseif(Auth::user()->isFriendsWith($user))
					<a href="" class="button alert" type="button"><span class="icon-user-minus"> </span>Delete Friend</a>
				{{-- Add add friend button if user is not friends with other user --}}
				@else
					<a href="{{ url('/user/add', [$user->id])}}" class="button" type="button"><span class="icon-user-plus"> </span>Add Friend</a>
				@endif
			</div>
		</div>
	</div>
	{{-- Profile tabs on user's Posts, About and Friends --}}
	<div class="row">
		<ul class="tabs" data-tabs id="profile-tabs">
		  <li class="tabs-title is-active"><a href="#posts-panel" aria-selected="true">Posts</a></li>
		  <li class="tabs-title"><a href="#about-panel">About</a></li>
		  <li class="tabs-title"><a href="#friends-panel">Friends ({{ $user->friends()->count()}})</a></li>
		</ul>
		<div class="tabs-content" data-tabs-content="profile-tabs">
		  @include('profile._posts-panel')
		  @include('profile._about-panel')
		  @include('profile._friends-panel')
		</div>
	</div>
@endsection
