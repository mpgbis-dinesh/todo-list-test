<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="robots" content="noindex, nofollow">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
	<meta name="theme-color" content="#ffffff">
	<title>@yield('page-title-name')</title>
	
	<!--START STYLESHEETS  -->
		@include('userprofile/layouts.style')
	<!--END STYLESHEETS  -->

</head>

<body class="top-navigation">
	<div id="wrapper">
		<div id="page-wrapper" class="gray-bg">
			<!-- START HEADER  -->
				@include('userprofile/layouts.header')
			<!-- END HEADER  -->

			<!-- START CONTENT BLOCK -->
				@yield('content')
			<!-- END CONTENT BLOCK -->
			
			<!--START JAVASCRIPTS  -->
			@include('userprofile/layouts.script')
			<!--END JAVASCRIPTS  -->

			<!-- START FOOTER  -->
			@include('userprofile/layouts.footer')
			<!-- END FOOTER  -->
		</div>
	</div>
</body>
</html>