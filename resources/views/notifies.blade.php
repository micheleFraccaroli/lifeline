@extends('layout')

@section('content')

<?php
	foreach ($notifies as $n) {
		echo "<a href=\"/notifies/$n->id\">Notifica </a>";
		if ($n->from_request != NULL) {
			echo "di una richiesta d'amicizia<br>";
		}
		elseif ($n->from_comment != NULL) {
			echo "di un commento sul post " . $n->from_post. "<br>";
		}
		elseif ($n->from_like != NULL) {
			echo "di un mi piace su un ";
			if ($n->from_comment != NULL) {
				echo "commento<br>";
			}
			else {
				echo "post<br>";
			}
		}
		else{

		}
	}
?>
@endsection