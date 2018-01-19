@extends('layouts.app')

@section('content')

<div class="row">
	<div class ="col-sm-6 col-md-offset-3">

			<?php if(empty($user[0])) { ?>
					<h3>We are sorry, we haven't found any user with this name :(</h3>
			<?php } ?>
			<?php foreach ($user as $u) { ?>
				<h3><a href="/users/{{$u->id}}">{{$u->name}} {{$u->surname}}</a></h3><br>
			<?php } ?>

	</div>
</div>

@endsection