<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Feedback</title>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="{{ asset('extra/images/favicon_blue.png') }}?v=1">
	<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='{{ url('css/all.css') }}' rel='stylesheet' type='text/css'>
	<style>
		body{
			background-color:#F2F8F9;
		}
		.form-group label {
			display: inline-block;
			margin-bottom: .5rem;
			font-size:13px;
			font-weight:normal;
			color:#333;
			padding-left:0;
		}
		.content-wrapper {
			background-image: none;
		}
		.mx-auto{
			margin:0 auto;max-width:400px;background: #fff;padding: 40px;border-radius: 4px;box-shadow: 0 -1px 37.7px 11.3px rgba(8, 143, 220, 0.07);
		}
		.input-group{
			width:100%;
		}
		.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}
		.input-group .form-control {
			position: relative;
			z-index: 2;
			float: left;
			width: 100%;
			margin-bottom: 0;
		}
		.form-control {
			display: block;
			width: 100%;
			height: 34px;
			padding: 6px 12px;
			font-size: 13px;
			line-height: 1.6;
			color: #555555;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
			-webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
			transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
			transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
			transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
		}
		.form-control:not(.form-control-sm):not(.form-control-lg), .input-group-text, select.form-control:not([size]):not([multiple]){
			height: 34px;
			padding: 6px 12px;
			font-size: 13px;
		}
		.form-control {
			box-shadow: none;
			font-weight: 300;
		}
		.btn-primary {
			color: #fff;
			background-color: #308ee0;
			border-color: #308ee0;
		}
		.form-group {
			margin-bottom: 1rem;
		}

		.btn-outline-secondary {
			letter-spacing:0;font-size:14px;font-weight:normal;margin-top:14px;
			color: #444;
			background: #ffffff; /* Old browsers */
			background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%); /* FF3.6-15 */
			background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-9 */
			padding-top:4px;
			padding-bottom:4px;
			border:1px solid #aaa;
		}
		#btn-connect:hover,#btn-connect:active,#btn-connect:focus{
			color: #000!important;
			border-color: #333!important;
		}
	  </style>
</head>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page" style="padding:0;">
		<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="margin:0 auto;" >
			<div style="width:100%">
				<br />
				<div class="mx-auto">
					<div class="auto-form-wrapper">
						
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="form-group">
							  <label class="label"><b>Email</b></label>
							  <div class="input-group">
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required >
								
								<div class="input-group-append">
								  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								</div>
								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							  </div>
							</div>
							<div class="form-group">
							  <label class="label"><b>Password</b></label>
							  <div class="input-group">
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
								<div class="input-group-append">
								  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								@if ($errors->has('password'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
								
							  </div>
							</div>
							<div class="form-group">
							  <button type="submit" class="btn btn-lg btn-primary submit-btn btn-block">Sign In</button>
							</div>
						</form>
					</div>
					<p class="footer-text text-center"></p>
				</div>
				<br />
				<br />
				<br />
			</div>
		</div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>