@extends('layouts.app')
@section('content')

	<div class="panel-body">
		<ul>
			<li>
				<h3>name: </h3> {{ Auth::user()->name }}
			</li>
			<li>
				<h3>surname: </h3> {{ Auth::user()->surname }}
			</li>
			<li>
				<h3>email: </h3> {{ Auth::user()->email }}
			</li>
			<li>
				<h3>sex: </h3> {{ Auth::user()->sex }}
			</li>
			<li>
				<h3>born: </h3> {{ Auth::user()->born }}
			</li>
			<li>
				<h3>job: </h3> {{ Auth::user()->job }}
			</li>
			<li>
				<h3>relation: </h3> {{ Auth::user()->relation }}
			</li>
			<li>
				<div class="panel-body">
				    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				        <div class="col-md-6">
				            <?php if(Auth::user()->image == '0'){?>
				                <img src="{{URL::asset('/default-profile-image.png')}}" alt="profile pictures" height="200" width="200">
				            <?php }else{ ?>
				               <img src="data:image/jpg;base64, <?= Auth::user()->image ?>">
				            <?php } ?>
				        </div>
				    </div>
				</div>
			</li>
		</ul>

		<a href="/users/update/{{ Auth::user()->id }}">Update profile</a>

	</div>

@endsection