@extends('layout')
@section('content')

<?php
		if($messages==null)
			echo "Nessuna conversazione :'(";
		else
			foreach($messages as $m){echo "<br>{$m->body} {$m->id_utente}<br>";}
?>
<br><a href="/conversations">Back</a><br>
@endsection