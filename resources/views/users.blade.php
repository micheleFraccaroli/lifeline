@extends('layouts.app')

@section('content')

<div class="row">
	<div class ="col-sm-6 col-md-offset-3">
		<form action="{{ URL::to('/conversations/create') }}" method="POST" id="form_store_conversation">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="user_log" id="id_utente_log" value="<?= Auth::user()->id ?>">
			<input type="hidden" name="type_conversation" id="tipo" value="1">
			<!--<div id="container">-->

			<?php foreach($users as $user) { ?>
				<input type="submit" value="{{ $user->id }}" >{{$user->name}}</input><br>
			<?php } ?>	
		</form>
	</div>
</div>

<!-- <script type="text/javascript">
	//se usata, inserire nella submit sopra questo -> onclick="add_input_id({{ $user->id }})" 
    function add_input_id(id) {
        var container = document.getElementById("container");
        var input = document.createElement("input");
        input.type = 'hidden';
        input.name = 'id_other';
        input.value = id;

        container.appendChild(input);
    }
</script> -->
@endsection