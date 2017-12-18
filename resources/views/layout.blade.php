<!DOCTYPE html>
<html lan="en">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/Alveare.css">
</head>
<body>
<br><br><br><br>
	<nav class="navbar navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand" href="#">CryNet Systems</div>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="/">Home</a></li>
				<li><a href="#">Laravel</a></li>
				<li><a href="#">Pagina2</a></li>
				<li><a href="#">Pagina3</a></li>
			</ul>
		</div>
	</nav>
	@include('titleBar')
	<br><br>
	@yield('content')
	<br>
	<br><br>
	<div class="container-fluid">@include('footer')
		<div class="row">
			<div class="col-xs-4" style="background-color:yellow">Michele Fraccaroli</div>
			<div class="col-xs-4" style="background-color:lightblue">Matteo Gemelli</div>
			<div class="col-xs-4" style="background-color:pink">Michele Cesari</div>
		</div>
	</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>