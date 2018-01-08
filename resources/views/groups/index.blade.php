@extends('layouts.app')
@section('content')
<div class="row">
	<div class ="col-sm-6 col-md-offset-3">
		<form id="aggiorna_gruppi" action="#">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="max_id_index" value="<?php echo $max_id_db ?>">
		<button type="submit" class="btn btn-warning btn-lg btn-block">Sono stati creati nuovi gruppi, aggiorna per verificare</button>
		</form>
	</div>
</div>
<hr>
<div class = "row">
	<div class ="col-sm-6 col-md-offset-3">	
		<div class="alert alert-info" id="all_groups">
			<?php 
				foreach ($gruppi as $gruppo){
					echo "<a href=\"/groups/index/{$gruppo->id}\">{$gruppo->id} - {$gruppo->name}</a> <br>";
				}
			?>
		</div>
	</div>
</div>
@endsection