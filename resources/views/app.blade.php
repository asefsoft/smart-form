<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="{{ asset('css/bootstrap.min.css')  }}">
	<link rel="stylesheet" media="screen" href="{{ asset('css/bootstrap-rtl.css')  }}">
	<link rel="stylesheet" media="screen" href="{{ asset('css/font-awesome.css')  }}">


	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/select2.min.css')  }}" rel="stylesheet" />

</head>
<body>

	@include("navbar")

	<div class="container">
		<h2>فرم هوشمند</h2>
		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="{{ asset('/js/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/select2.min.js') }}"></script>
	<script src="{{ asset('/js/vue.js') }}"></script>
	<script src="{{ asset('/js/vue-resource.min.js') }}"></script>
	<script src="{{ asset('/js/app.js') }}"></script>


	@yield('footer')
</body>
</html>
