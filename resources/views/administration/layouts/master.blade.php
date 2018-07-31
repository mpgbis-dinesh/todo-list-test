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
		@include('administration/layouts.style')
	<!--END STYLESHEETS  -->

</head>

<body>
	<div id="wrapper">
		<!-- START HEADER  -->
			@include('administration/layouts.header')
		<!-- END HEADER  -->

		<!-- START CONTENT BLOCK -->
			@yield('content')
		<!-- END CONTENT BLOCK -->
		
		<!--START JAVASCRIPTS  -->
		@include('administration/layouts.script')
		<!--END JAVASCRIPTS  -->

		<!-- START FOOTER  -->
		@include('administration/layouts.footer')
		<!-- END FOOTER  -->
	</div>

</body>
</html>