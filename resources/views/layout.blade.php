<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	@include('titleBar')
	<br><br>
	@yield('content')
	<br>
	<?php echo "<a href=\"/users\">Back</a><br>";?>
	<br><br>
	@include('footer')
</body>
</html>