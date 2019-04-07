<!doctype html>
<html lang="en_US">
<head>
	<title>
		Qiz | @yield('title')
	</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fonts -->
	{{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

	{{--<link rel="stylesheet" href="http://localhost:8080/css/materialdesignicons.css" type="text/css">--}}
	{{--<link rel="stylesheet" href="http://localhost:8080/css/flipclock.css" type="text/css">--}}
	{{--<link rel="stylesheet" href="http://localhost:8080/css/materialize.css" type="text/css">--}}
	{{--<link rel="stylesheet" href="http://localhost:8080/css/tags-input.css" type="text/css">--}}
	{{--<link rel="stylesheet" href="http://localhost:8080/css/app.css" type="text/css">--}}
	<link rel="stylesheet" href="{{mix('css/materialdesignicons.css')}}" type="text/css">
	<link rel="stylesheet" href="{{mix('css/flipclock.css')}}" type="text/css">
	<link rel="stylesheet" href="{{mix('css/materialize.css')}}" type="text/css">
	<link rel="stylesheet" href="{{mix('css/tags-input.css')}}" type="text/css">
	<link rel="stylesheet" href="{{mix('css/app.css')}}" type="text/css">
	<!-- Styles -->
	@yield('style')
</head>
<body>
<header>
	@yield('navbar')
</header>
<main>
	@yield('content')
</main>
<footer class="page-footer">
	@yield('footer')
</footer>
@include('partials.login')
<!-- JS -->

{{--<script src="http://localhost:8080/js/app.js"></script>--}}
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
