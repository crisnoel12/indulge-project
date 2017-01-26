@extends('layouts.app')

@section('content')
    <div class="row">
    	<div class="column medium-6 medium-offset-3 content-margin">
			<h1>Register</h1>
			<form role="form" method="POST" action="{{ url('/register') }}">
				{!! csrf_field() !!}
                    <div class="column medium-6">
    					<label>First Name
    						<input class="{{ $errors->has('first_name') ? 'has-error' : '' }}" type="text" name="first_name" value="{{ old('first_name') }}" >
    					</label>
					@if ($errors->has('first_name'))
						<span class="alert label">
							<strong>{{ $errors->first('first_name') }}</strong>
						</span>
					@endif
                    </div>

                    <div class="column medium-6">
    					<label>Last Name
    						<input class="{{ $errors->has('last_name') ? 'has-error' : '' }}" type="text" name="last_name" value="{{ old('last_name') }}" >
    					</label>
    					@if ($errors->has('last_name'))
    						<span class="alert label">
    							<strong>{{ $errors->first('last_name') }}</strong>
    						</span>
    					@endif
                    </div>

                    <div class="column medium-6">
    					<label>Birthday
    						<input type="date" name="birthday" required>
    					</label>
                    </div>

                    <div class="column medium-6">
    					<label>Gender
                            <br>
    						<input type="radio" name="gender" value="Male" required>Male
    		  				<input type="radio" name="gender" value="Female">Female
    					</label>
                    </div>

                    <div class="column">
                        <label>Username
    						<input class="{{ $errors->has('username') ? 'has-error' : '' }}" type="text" name="username" value="{{ old('username') }}">
    					</label>
    					@if ($errors->has('username'))
    						<span class="alert label">
    							<strong>{{ $errors->first('username') }}</strong>
    						</span>
    					@endif
                    </div>

                    <div class="column">
    					<label>E-Mail Address
    						<input class="{{ $errors->has('email') ? 'has-error' : '' }}" type="email" name="email" value="{{ old('email') }}">
    					</label>
    					@if ($errors->has('email'))
    						<span class="alert label">
    							<strong>{{ $errors->first('email') }}</strong>
    						</span>
    					@endif
                    </div>

                    <div class="column">
    					<label>Password
    						<input class="{{ $errors->has('password') ? 'has-error' : '' }}" type="password" name="password">
    					</label>
    					@if ($errors->has('password'))
    						<span class="alert label">
    							<strong>{{ $errors->first('password') }}</strong>
    						</span>
    					@endif
                    </div>

                    <div class="column">
    					<label>Confirm Password
    						<input class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}" type="password" name="password_confirmation">
    					</label>
    					@if ($errors->has('password_confirmation'))
    						<span class="alert label">
    							<strong>{{ $errors->first('password_confirmation') }}</strong>
    						</span>
    					@endif
                    </div>
                <div class="column">
				    <button type="submit" class="button">Register</button>
                </div>

			</form>
		</div>
	</div>
@endsection
