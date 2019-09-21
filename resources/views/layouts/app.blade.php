<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="flu right size">
	<meta name="author" content="talek team">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="public/assets/images/favicon.png">
	<title>{{ config('app.name', 'Flu Right Size') }}</title>
	<!-- Custom CSS -->
	<link href="public/dist/css/style.min.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div class="main-wrapper">
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
			@yield('content')
		</div>
	</div>
	<script src="public/assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="public/assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="public/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
		// ==============================================================
		// Login and Recover Password
		// ==============================================================
		$('#to-recover').on("click", function() {
			$("#loginform").slideUp();
			$("#recoverform").fadeIn();
		});
		$('#to-login').click(function(){
			$("#recoverform").hide();
			$("#loginform").fadeIn();
		});
	</script>
</body>
</html>
