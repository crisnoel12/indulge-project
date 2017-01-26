@extends('layouts.app')

@section('content')
	@if (!$users->count())
		<p>No Results for "{{ Request::input('query') }}"</p>
	@else
		<div class="row">
			<div class="column">
				@if ($query === '')
					<h3>All Indulge Members</h3>
				@else
					<h3>Search Results for "{{ $query }}"</h3>
				@endif

				@foreach ($users as $user)
					<div class="media-object column medium-3">
						<div class="media-object-section">
							<div class="thumbnail">
								<a href="{{ url('/user',[$user->username]) }}">
									<img class="thumb" alt="{{ $user->first_name }} {{ $user->last_name }}'s Default Picture" src= "{{$user->profile_pic}}">
								</a>
							</div>
						</div>
						<div class="media-object-section">
							<a href="{{ url('/user',[$user->username]) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
							<p>
								@if ($user->state && $user->country)
									{{$user->state}}, {{$user->country}}
								@elseif ($user->country)
									{{$user->country}}
								@elseif ($user->state)
									{{$user->state}}
								@endif
							</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	@endif
@endsection
