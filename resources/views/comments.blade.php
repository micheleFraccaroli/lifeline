@extends('layout')

@section('content')

<?php 
	foreach ($comments as $c) {
		echo "<a href=\"/comments/{$c->id}\">{$c->body} riferito a -> {$c->id_post}</a> <br>";
	}
?>
@endsection