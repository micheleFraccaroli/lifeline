@extends('layout')

@section('content')

<?php 
	foreach ($comments as $c) {
		echo "<a href=\"/comments/{$c->id_post}\">{$c->body} riferito a post ---> {$c->id_post}</a> <br>";
	}
?>
@endsection