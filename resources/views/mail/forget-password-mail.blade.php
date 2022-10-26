<!DOCTYPE html>
<html>
@php
	$user = $content->user;
@endphp
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $content->subject }}</title>
</head>
<body>
	<h4>
		Hello {{ $user->name }},
		<br>
		Email: {{ $user->display_email }},
	</h4>
	<br>
	<br>
	<p>
		This is your new temporary passsword.
		<h2>{{ $user->newPassword }}</h2>
		<br>
		Please change this password as soon as possible.
	</p>
	<br>
	<br>
	Thank You,
	<br>
	{{ $user->app->app_name }}
</body>
</html>