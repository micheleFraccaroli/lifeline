@extends('layout')
@section('content')

<?php 	foreach($conversation as $conv)
		{
			echo "<a href=\"/conversations/{$conv}\">{$conv}</a><br>";
		}?>

@endsection