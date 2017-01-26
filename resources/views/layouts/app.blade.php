<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Indulge</title>

	<!--CDN Base Styles-->
    <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.1.2/foundation.min.css">

	<!--Font-->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

	<!--My Styles-->
	<link rel="stylesheet" href="/css/app.css">
</head>

<body id="{{ url()->current()===url('/') ? 'landing' : ''}}">
	<div class="title-bar" data-responsive-toggle="indulge-menu" data-hide-for="medium">
		<button class="menu-icon" type="button" data-toggle></button>
	</div>
	@include('partials._navigation')
    @include('partials._search')

    <div class="row">
			@yield('content')
    </div>
    <!-- JavaScripts -->
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/foundation/6.1.2/foundation.min.js"></script>
	<script src="/js/app.js"></script>
    @if(url()->current()===url('/register') || url()->current()===url('/profile/edit'))
        <script src="/js/location.js"></script>
    @endif
    <script>
      $(document).foundation();
    </script>
</body>
</html>
