@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <?php if($user['image'] == null) { ?>
                    <a href="/users/{{ $user['id'] }}"><img src="{{URL::asset('/default-profile-image.png')}}" width="163" height="200"></a>
                <?php } else { ?>
                    <a href="/users/{{ $user['id'] }}"><img src="{{asset($user['image'])}}" height="200" width="163"></a>
                <?php } ?>
                <hr>
                {{ $user['name'] }}    
                {{ $user['surname'] }} <br>
                <?php if($user['id'] == Auth::user()->id) { ?>
                	<a href="/users/update/{{ $user['id'] }}">Update profile</a><br>
            	<?php } ?>
            	<?php if(strcmp($user[0], "not_find") == 0 && $user['id'] != Auth::user()->id) {?>
                	<a href="">Richiedi amicizia</a>
                <?php } ?>
            </div>
        </div>
		<div class="col-md-8">
	        <div class="panel panel-default"> 
				{{ $user['name'] }}	
				{{ $user['surname'] }} <br>
				{{ $user['email'] }}	<br>
				{{ $user['sex'] }}		<br>
				{{ $user['born'] }}	<br>
				{{ $user['job'] }}		<br>
				{{ $user['relation'] }}<br>
			</div>
		</div>
	</div>
	<?php if(count($user) > 11) { ?>
		<div class="row">
			<div class="col-md-2">
		    </div>
		    <div class="col-md-8">
		        <div class="panel panel-default"> 
		        	<?php for($i=1; $i<count($user)-11; $i++) { ?>
		        		<div class="panel-body">
		        			{{$user[$i]->body }} <br>
		        			<?php if(!empty($user[$i]->photo)) { ?>
			                    <img id="show_group_pic" class = "img-responsive img-circle" src="{{$user[$i]->photo}}" height="200" width="200"/>
			                    <span class="custom-file-control"></span>
			                    <input type="hidden" name="group_pic_value"> 
			                <?php } ?>
			                <hr>
			            </div>
		        	<?php } ?>
		        </div>
		    </div>
		</div>
	<?php } ?>
</div>

@endsection