@extends('layout')

@section('content')

<?php foreach($friends as $friend) {
	echo "<a href=\"/friends/{$friend->id_utente1}\">{$friend->id_utente1} - {$friend->id_utente2}</a> <br>";
}?>
@endsection