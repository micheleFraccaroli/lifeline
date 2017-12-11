@extends('layout')

@section('content')

<?php foreach($users as $user) {
	echo "<a href=\"/users/{$user->id}\">{$user->id} - {$user->name}</a> <br>";
}?>
@endsection