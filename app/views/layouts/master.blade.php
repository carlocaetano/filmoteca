<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="utf-8">
		<title>Filmoteca</title>
		{{ HTML::style('assets/css/select2.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::script('assets/js/jquery-2.0.3.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/select2.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/select2_locale_pt-BR.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/jquery.maskedinput.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/main.js', array('defer' => 'defer')) }}
	</head>
	<body>
		<header>Filmoteca</header>
		@include('partials._menu')
		<div id="content">
			{{ HTML::flash_message() }}
			@yield('content')
		</div>
	</body>
</html