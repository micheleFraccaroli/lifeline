@extends('layout')

@section('content')
<br>

<?php 

	foreach ($friend as $value) {
		echo $value . "<br>";
	}

?>

<br>
@endsection