@extends('layouts.app')
@section('content')

	<div class="panel-body">
		<div class ="col-sm-6 col-md-offset-3">
		
			{{ $user->name }}	<br>
			{{ $user->surname }} <br>
			{{ $user->email }}	<br>
			{{ $user->sex }}		<br>
			{{ $user->born }}	<br>
			{{ $user->job }}		<br>
			{{ $user->relation }}<br>

			<div class="col-sm-9">
			    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
			        <div class="col-md-6">
			            <?php if($user->image == '0'){?>
			                <img src="{{URL::asset('/default-profile-image.png')}}" alt="profile pictures" height="200" width="200">
			            <?php } else { ?>
			            	<img src="{{asset($user->image)}}" height="200" width="163">
			            <?php } ?>
			        </div>
				</div>
			</div>
				
			<a href="/users/update/{{ $user->id }}">Update profile</a>
		</div>
	</div>

@endsection