<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Flu Right Size">
	<meta name="author" content="Talek team">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/favicon.png') }}">
	<title>BOE - Flu Right Size</title>
	@yield('custom-style')
	@include('layouts.main-style')
	@yield('top-script')
	@yield('internal-style')
	@yield('meta-token')
</head>
<body>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<div id="main-wrapper">
		@include('layouts.top-sidebar')
		@include('layouts.left-sidebar')
		<div class="page-wrapper">
			@yield('contents')
			@include('layouts.footer')
		</div>
	</div>
	@include('layouts.main-script')
	@yield('bottom-script')
</body>
</html>
