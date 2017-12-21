@extends('layouts.app')
@section('content')
<div class="row">
	<div class ="col-sm-6 col-md-offset-3">
		<form action="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="button" class="btn btn-warning btn-lg btn-block" id="aggiorna_gruppi">Sono stati creati nuovi gruppi, aggiorna per verificare</button>
		</form>
	</div>
</div>
<hr>
<div class = "row">
	<div class ="col-sm-6 col-md-offset-3">
		<div class="alert alert-info">
		<?php 
			foreach ($gruppi as $gruppo) {
				echo "<a href=\"/groups/index/{$gruppo->id}\">{$gruppo->id} - {$gruppo->name}</a> <br>";
			}
		?>
		</div>
	</div>
</div>
@endsection