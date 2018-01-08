@extends('layouts.app')

@section('content')

<div class="row">
	<div class ="col-sm-6 col-md-offset-3">
		<?php foreach ($user as $u) { ?>
			<a href="/users/{{$u->id}}">{{$u->name}} {{$u->surname}}</a><br>
		<?php } ?>
	</div>
</div>

@endsection