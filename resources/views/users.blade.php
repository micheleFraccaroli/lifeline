@extends('layouts.app')

@section('content')
<div class="container search">
	<div class="row">
		<div class ="col-sm-6 col-md-offset-3">
						<h3 class="search_result"><b><u>Users Found:</u></b></h3>
				<?php 	if(empty($user[0])) { ?>
							<h3 class="search_result">We are sorry, we haven't found any user with this name :(</h3>
				<?php 	} 
						else {
								foreach ($user as $u) { ?>
									<h3 class="search_record"><a href="/users/{{$u->id}}">{{$u->name}} {{$u->surname}}</a></h3><br>
				<?php 			}
						} ?>

		</div>
	</div>
</div>
<br><br>
<div class="container search">
	<div class="row">
		<div class ="col-sm-6 col-md-offset-3">
						<h3 class="search_result"><b><u>Groups Found:</u></b></h3>
				<?php 	if(empty($group[0])) { ?>
							<h3 class="search_result">We are sorry, we haven't found any group with this name :(</h3>
				<?php 	} 
						else {
							foreach ($group as $g) { ?>
								<h3 class="search_record"><a href="/groups/{{$g->id}}">{{$g->name}}</a></h3><br>
				<?php 		}
						} ?>

		</div>
	</div>
</div>
@endsection