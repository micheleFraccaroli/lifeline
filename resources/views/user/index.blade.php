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

            	<div id="requester">
            		<?php if($user['id'] != Auth::user()->id) { ?>
	            		<?php if(strcmp($user[0], "not_found") == 0) {?>
		                	<form action="{{ URL::to('/friends/req') }}" method="POST" id="friend_form_req">
		                		{{ csrf_field() }}
		                		<input type="hidden" name="my_id" value="{{Auth::user()->id}}">
		                		<input type="hidden" name="other_id" value="{{$user['id']}}">
		                		<input type="hidden" name="type" value="1">
		                		<button type="submit" class="btn btn-success">
		                    	    Richiedi amicizia
		                        </button>
		                	</form>
		                <?php } elseif(strcmp($user[0], "requested") == 0 && $user[1] != 0) { ?>
		                	<form action="{{ URL::to('/friends/resp') }}" method="POST" id="friend_form_resp">
		                		{{ csrf_field() }}
		                		{{ Auth::user()->unreadNotifications->markAsRead() }}
		                		<input type="hidden" name="my_id" value="{{Auth::user()->id}}">
		                		<input type="hidden" name="other_id" value="{{$user['id']}}">
		                		<input type="hidden" id="type_request" name="type" value="">
		                		<button type="submit" class="btn btn-success" onclick="acceptRequest()">
		                    	    Accetta
		                        </button>
		                        <button type="submit" class="btn btn-success" onclick="rejectRequest()">
		                    	    Rifiuta
		                        </button>
		                	</form>

	                	<?php } elseif(strcmp($user[0], "requested") == 0 && $user[1] == 0) { ?>
	            			<button type="button" class="btn btn-info" disabled="">Richiesta inviata</button>
	            		<?php } else { ?>
	            			<button type="button" class="btn btn-info" disabled="">Amici</button>
	            			<!-- <form action="{{ URL::to('/friends/del') }}" method="POST" id="friend_form_del">
		                		{{ csrf_field() }}
		                		{{ Auth::user()->unreadNotifications->markAsRead() }}
		                		<input type="hidden" name="my_id" value="{{Auth::user()->id}}">
		                		<input type="hidden" name="other_id" value="{{$user['id']}}">
		                		<input type="hidden" id="type_request" name="type" value="3">
		                		<button type="submit" class="btn btn-danger">
		                    	    Elimina amico
		                        </button>
		                	</form> -->
	            		<?php } ?>
	            	<?php } ?>
            	</div>

            </div>
        </div>
		<div class="col-md-8">
	        <div class="panel panel-default"> 
				{{ $user['name'] }}	
				{{ $user['surname'] }} <br>
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
		        	<?php for($i=2; $i<count($user)-11; $i++) { ?>
		        		<div class="panel-body">
		        			{{$user[$i]->body }} <br>
		        			<?php if(!empty($user[$i]->photo)) { ?>
			                    <img id="show_group_pic" class = "img-responsive img-circle" src="{{$user[$i]->photo}}" height="200" width="200"/>
			                    <span class="custom-file-control"></span>
			                    <input type="hidden" name="group_pic_value"> 
			                <?php } ?>
			            </div>
		        	<?php } ?>
		        </div>
		    </div>
		</div>
	<?php } ?>
</div>

@endsection