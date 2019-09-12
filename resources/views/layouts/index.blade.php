<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="PJ">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
	<title>BOE - Flu Right Size</title>
	@include('layouts.mainStyle')
	@include('layouts.mainScript')
	@yield('style')
	@yield('meta')
</head>
<body>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<div id="main-wrapper">
		@include('layouts.topBar')
		@include('layouts.leftSidebar')
		<div class="page-wrapper">
			@yield('contents')
			@include('layouts.footer')
		</div>
	</div>
	@yield('script');
</body>
</html>
