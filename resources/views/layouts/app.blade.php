<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<script src="{{ asset(mix('js/all.js')) }}"></script>
	<link rel="stylesheet" href="{{ asset(mix('css/all.css')) }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<script>
		//-- Notifications fade
		window.setTimeout(function () {
			$('.alert-dismissible').fadeTo(800, 0).slideUp(500, function () {
				$(this).remove();
			});
		}, 1500);
	</script>
</head>
<body class="sidebar-mini">
	<div id="app">
		<div class="main-wrapper">
			@yield('content')
		</div>
	</div>

	<div class="modal bd-loader-modal-lg" id="page-loader" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="row h-75 justify-content-center align-items-center">
				<div class="col-12 text-center">
					<div class="spinner-border text-light" style="width: 4rem; height: 4rem;"  role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>
</html>
