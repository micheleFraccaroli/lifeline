@extends('layouts.app')
@section('content')

	<div class="panel-body">
		<div class ="col-sm-6 col-md-offset-3">
		
			{{ Auth::user()->name }}	<br>
			{{ Auth::user()->surname }} <br>
			{{ Auth::user()->email }}	<br>
			{{ Auth::user()->sex }}		<br>
			{{ Auth::user()->born }}	<br>
			{{ Auth::user()->job }}		<br>
			{{ Auth::user()->relation }}<br>

			<div class="col-sm-9">
			    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
			        <div class="col-md-6">
			            <?php if(Auth::user()->image == '0'){?>
			                <img src="{{URL::asset('/default-profile-image.png')}}" alt="profile pictures" height="200" width="200">
			            <?php } else { ?>
			            	<img src="{{asset(Auth::user()->image)}}" height="200" width="200">
			            <?php } ?>
			        </div>
				</div>
			</div>
				
			<a href="/users/update/{{ Auth::user()->id }}">Update profile</a>
		</div>
	</div>

@endsection