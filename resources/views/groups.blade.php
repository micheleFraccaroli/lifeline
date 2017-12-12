@extends('layout')

@section('content')
<?php 
foreach ($gruppi as $gruppo) {
	echo "<a href=\"/groups/{$gruppo->id}\">{$gruppo->id} - {$gruppo->name}</a> <br>";
}
?>
@endsection