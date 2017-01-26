@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="column medium-6 medium-offset-3 content-margin">
			<h1>Login</h1>
			<form role="form" method="POST" action="{{ url('/login') }}">

				{!! csrf_field() !!}

				<label>E-Mail Address
					<input type="email" name="email" value="{{ old('email') }}">
				</label>
				@if ($errors->has('email'))
					<span class="alert label">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif

				<label>Password
					<input type="password" name="password">
				</label>
				@if ($errors->has('password'))
					<span class="alert label">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif

				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>

				<button type="submit" class="button">
					Login
				</button>
				<a class="hollow button" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
			</form>
		</div>
	</div>
@endsection
