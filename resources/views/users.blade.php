@extends('layouts.app')

@section('content')

<div class="row">
	<div class ="col-sm-6 col-md-offset-3">
		<form id="form_ajax" action="">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="user_log" id="id_utente_log" value="<?= Auth::user()->id ?>">
			<input type="hidden" name="type_conversation" id="tipo" value="1">

			<?php foreach($users as $user) { ?>
				<input type="hidden" name="id_utente_conv" value="{{ $user->id }}">
				<input type="button" id="<?= "conversa" . $user->id ?>" value="{{ $user->id }}" onclick="select_id(<?= $user->id?>)">{{$user->name}}</input>
			<?php } ?>	
		</form>
	</div>
</div>

@endsection