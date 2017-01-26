@extends('layouts.app')

@section('content')
	@include('partials/upload-pic-modal')
	<div class="column medium-3">
		<a data-open="upload-pic-modal">
			<img class="thumbnail profile-pic" src="{{ Auth::user()->profile_pic }}">
		</a>
	</div>

	<div class="column medium-9">
		<form id="post-form" method="post" action="{{ url('/post') }}">
			<textarea name="post" class="postArea" rows="3" placeholder="Hi {{ Auth::user()->first_name }}! What's happening?"></textarea>
			<button class="button" type="submit">POST</button>
			{!! csrf_field() !!}
		</form>
		<h1>Docket</h1>
		<hr/>
		@include('partials._posts')
	</div>

@stop
