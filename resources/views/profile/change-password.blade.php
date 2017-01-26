@extends('layouts.app')

@section('content')
    <div class="column medium-8 medium-offset-2">
        <h1>Change Password</h1>
        <form method="post" action="{{ url('/profile/change-password') }}">
            <div class="columns">
				<label>Enter current password
					<input type="password" name="curr_pass">
				</label>
			</div>
			<div class="columns">
				<label>Enter new password
					<input type="password" name="new_pass">
				</label>
			</div>
			<div class="columns">
				<label>Confirm new password
					<input type="password" name="new_pass_confirmation">
				</label>
			</div>
            <div class="columns">
				<input class="button float-right" type="submit" value="Save Password">
			</div>
            {!! csrf_field() !!}
        </form>
    </div>
@endsection
