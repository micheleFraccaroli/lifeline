@extends('layout')
@section('content')

<?php 	//$messages=json_decode($messages);
		//foreach($messages as $m){echo "{$m->id_conversazione}";}
		foreach($messages as $m){echo "{$m->id_conversazione}<br>";}
?>
<br><a href="/conversations">Back</a><br>
@endsection