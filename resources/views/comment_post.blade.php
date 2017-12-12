@extends('layout')

@section('content')

<?php
	foreach ($comment_post as $value) {
		echo $value . "<br>";
	}
?>
@endsection