@extends('layouts.app')

@section('content')
	{{-- List of Friends --}}
		<div class="column medium-8">
			<h2>Your Friends</h2>
			<div class="row small-up-1 medium-up-3 large-up-5">
					@if(!Auth::user()->friends()->count())
						<p>You have no friends.</p>
					@else
						@foreach(Auth::user()->friends() as $user)
							<a href="{{ url('/user',[$user->username]) }}" class="column medium-5">
								<img class="thumbnail" src="{{$user->profile_pic}}">
								<p>{{ $user->first_name }} {{ $user->last_name }}</p>
							</a>
						@endforeach
					@endif
			</div>
		</div>
		{{-- Friend Requests --}}
  		<div class="column medium-4 fr-field">
  			<h3>Friend Requests ({{$requests->count()}})</h3>

  				@foreach($requests as $user)
					<div class="media-object">
						<div class="media-object-section">
							<div class="thumbnail">
							  	<a href="{{ url('/user',[$user->username]) }}">
							  		<img class="thumb" alt="{{ $user->first_name }} {{ $user->last_name }}'s Default Picture" src= "{{$user->profile_pic}}">
							  	</a>
							</div>
					    </div>
					    <div class="media-object-section">
							<div>
	  						    <p>
	  							  <a>{{$user->first_name}} {{$user->last_name}}</a>
	  							  <p>
									  @if ($user->state || $user->country)
									  	    {{$user->state}}{{$user->country}}
									  @elseif ($user->state && $user->country)
									  	  	{{$user->state}}, {{$user->country}}
									  @endif
	  							  </p>
	  							</p>
  						    </div>
	  				    </div>
					 	<div class="button-group">
							<a href="{{ url('/user/accept', [$user->id])}}" class="button" type="button"><span class="icon-user-plus"> </span>Accept</a>
					    	<a href="" class="button alert" type="button"><span class="icon-user-minus"> </span>Delete</a>
				    	</div>
					</div>
					<hr>
				@endforeach
		</div>
@endsection
