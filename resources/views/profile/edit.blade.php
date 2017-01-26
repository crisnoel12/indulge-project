@extends('layouts.app')

@section('content')
		<div class="column medium-8 medium-offset-2">
	  		<h1>Edit Profile</h1>
			<form method="post" action="{{ url('/profile/edit') }}">
			<div class="medium-4 columns">
				<label>First Name
					<input type="text" name="first_name" value="{{ Auth::user()->first_name }}">
				</label>
			</div>
			<div class="medium-4 columns">
				<label>Middle Name
					<input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}">
				</label>
			</div>
			<div class="medium-4 columns">
				<label>Last Name
					<input type="text" name="last_name" value="{{ Auth::user()->last_name }}">
				</label>
			</div>
			<div class="medium-6 columns">
				<label>Email
					<input type="text" name="email" value="{{ Auth::user()->email }}">
				</label>
			</div>
			<div class="medium-6 columns">
				<label>Ethnicity
					<select name="ethnicity">
						<option value="">Select</option>
						<option value="African" {{ Auth::user()->ethnicity==='African' ? 'selected' : '' }}>African</option>
						<option value="Asian" {{ Auth::user()->ethnicity==='Asian' ? 'selected' : '' }}>Asian</option>
						<option value="Caucasian" {{ Auth::user()->ethnicity==='Caucasian' ? 'selected' : '' }}>Caucasian</option>
						<option value="Pacific Islander" {{ Auth::user()->ethnicity==='Pacific Islander' ? 'selected' : '' }}>Pacific Islander</option>
					</select>
				</label>
			</div>
			<div class="medium-6 columns">
				<label>Interested In
					<select name="interested_in">
						<option value="">Select</option>
						<option value="Men" {{ Auth::user()->interested_in==='Men' ? 'selected' : '' }}>Men</option>
						<option value="Women" {{ Auth::user()->interested_in==='Women' ? 'selected' : '' }}>Women</option>
						<option value="Men & Women" {{ Auth::user()->interested_in==='Men & Women' ? 'selected' : '' }}>Men & Women</option>
					</select>
				</label>
			</div>
			<div class="medium-6 columns">
				<label>Civil Status
					<select name="civil_status">
						<option value="">Select</option>
						<option value="Single" {{ Auth::user()->civil_status==='Single' ? 'selected' : '' }}>Single</option>
						<option value="Married" {{ Auth::user()->civil_status==='Married' ? 'selected' : '' }}>Married</option>
						<option value="Divorced" {{ Auth::user()->civil_status==='Divorced' ? 'selected' : '' }}>Divorced</option>
						<option value="Widowed" {{ Auth::user()->civil_status==='Widowed' ? 'selected' : '' }}>Widowed</option>
					</select>
				</label>
			</div>
			<div class="column medium-12">
				<label>Living In:
					@if ($state && $country)
						{{ $state }}, {{ $country }} / <a class="toggle-location">Change your location</a>
					@elseif ($country)
						{{ $country }} / <a class="toggle-location">Change your location</a>
					@elseif ($state)
						{{ $state }} / <a class="toggle-location">Change your location</a>
					@else
						<a class="toggle-location">Add your location</a>
					@endif
				</label>
			</div>
			<div id="location">
				<div class="column medium-6">
					<select id="state" name="state"></select>
				</div>
				<div class="column medium-6">
					<select id="country" name="country"></select>
				</div>
			</div>
			<div class="small-12 columns">
				<label>Bio
					<textarea name="bio" rows="5">{{ Auth::user()->bio }}</textarea>
				</label>
			</div>
			<div class="small-12 columns">
				<input class="button float-right" type="submit" value="Save Profile">
			</div>
	  </div>
	  {!! csrf_field() !!}
	</form>

@stop
