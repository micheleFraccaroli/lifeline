@extends('layout')
@section('content')

<?php 	foreach($conversation as $conv)
		{
			echo "<a href=\"/conversations/{$conv->id}\">{$conv->id}</a><br>";
		}?>

@endsection