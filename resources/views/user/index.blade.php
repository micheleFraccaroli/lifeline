@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">

        	<input type="hidden" value="{{ Auth::user()->id }}" id="id_user_logged">

            <div class="panel panel-default homeImage">
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{asset($user['image'])}}" alt="Profile Image"></a>
                <hr>

                {{ $user['name'] }}    
                {{ $user['surname'] }} <br>
                
	    		<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" title="<B>{{$user['name']}} {{$user['surname']}}</B>" data-content="<B>Name:</B> {{$user['name']}}<br><B>Surname:</B> {{$user['surname']}}<br><B>Sex:</B> {{$user['sex']}}<br><B>Born:</B> {{$user['born']}}<br><B>Job:</B> {{$user['job']}}<br><B>Relathionship:</B> {{$user['relation']}}<br><B>E-mail:</B> {{$user['email']}}">
      			<span class=' glyphicon glyphicon-info-sign'></span> Info
      			</button>
			                   
            	<div id="requester">
            		<?php if($user['id'] != Auth::user()->id) { ?>
	            		<?php if(strcmp($user[0], "not_found") == 0) {?>
		                	<form action="{{ URL::to('/friends/req') }}" method="POST" id="friend_form_req">
		                		{{ csrf_field() }}
		                		<input type="hidden" name="my_id" value="{{Auth::user()->id}}" id="id_logged">
		                		<input type="hidden" name="other_id" value="{{$user['id']}}" id="other_id">
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
		                		<button type="submit" class="btn btn-success" onclick="acceptRequest();">
		                    	    Accetta
		                        </button>
		                        <button type="submit" class="btn btn-danger" onclick="rejectRequest();">
		                    	    Rifiuta
		                        </button>
		                	</form>

	                	<?php } elseif(strcmp($user[0], "requested") == 0 && $user[1] == 0) { ?>
	            			<button type="button" class="btn btn-info" disabled="">Richiesta inviata</button>
	            		<?php } else { ?>
	            			<button type="button" class="btn btn-info" disabled="">Amici</button>
	            			<form action="{{ URL::to('/friends/del') }}" method="POST" id="friend_form_del">
		                		{{ csrf_field() }}
		                		{{ Auth::user()->unreadNotifications->markAsRead() }}
		                		<input type="hidden" name="my_id" value="{{Auth::user()->id}}">
		                		<input type="hidden" name="other_id" value="{{$user['id']}}">
		                		<input type="hidden" id="type_request" name="type" value="3">
		                		<button type="submit" class="btn btn-danger">
		                    	    Elimina amico
		                        </button>
		                	</form> 
	            		<?php } ?>
	            	<?php } ?>
            	</div>
            </div>
        </div>
	
	<?php if($my_friend != 0) { ?>

	<!--inizio bacheca-->

		<div class="col-md-6 col-md-offset-1">
			<div class="alert alert-info" id="all_groups">
		        <div id="bacheca_posts">
		            <?php 
		            foreach ($all_posts as $post){

		                echo "<div id='post_{$post->id}'>";

		                if ($post->photo != NULL) {

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> posted a photo:<br><br>";

		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";
		                    echo "<img src='".asset($post->photo)."' class='img-thumbnail' height='200' width='200'/><br><br>";

		                }else{

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> said:<br><br>";
		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

		                }


		                echo" <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
		                echo " <div class='btn-group mr-2' role='group' aria-label='First group'>";

		                echo  "<button class='btn btn-info' type='button' name='show_details' data-target='#collapse_{$post->id}'> <span class='glyphicon glyphicon-eye-open'></span>
		                    Show comments
		                    </button>";   

		                if ($my_like[$post->id]) {

		                    echo "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='dislike'><span class='glyphicon glyphicon-thumbs-up'></span> ".$like[$post->id]."</button>";

		                }else{

		                    echo  "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='like'>Like ".$like[$post->id]."</button>";
		                }

		                if ($user_io[$post->id]->id == Auth::id()) {                       

		            ?>
		                <button type='button' class='btn btn-info' name="modal_delete" id='<?php echo "modal_{$post->id}"; ?>'>
		                <span class="glyphicon glyphicon-trash"></span>
		                Delete post
		                </button>
		            <?php 

		                }

		                echo "</div></div>";
		            ?>

		            <?php
		                echo"<div class='collapse' id='collapse_{$post->id}'>
		                        <div id='new_comment_{$post->id}'>
		                        </div>
		                        <div class='card card-body'>
		                        <br>
		                            <div class='form-group'>
		                                <input type='text' class='form-control' placeholder='...' id ='body_comment_{$post->id}'>
		                            </div>
		                            <form action='#'>
		                                <button type='submit' class='btn btn-info btn-block btn-sm' name='answer' id='Post_comment_{$post->id}' disabled>Answer</button>
		                            </form>
		                            </div>
		                        </div>
		                        <hr>
		                    </div>";
		            }
		            ?>
		            @include('layouts.modal_groups')

		        </div>
		    </div>
		</div>

	    <!-- fine bacheca -->

		<?php }else{ ?>

		<div class="col-md-6 col-md-offset-1">
			<div class="alert alert-info" id="all_groups">
		        <div id="bacheca_posts">
		            <?php 
		            foreach ($all_posts as $post){

		                echo "<div id='post_{$post->id}'>";

		                if ($post->photo != NULL) {

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> posted a photo:<br><br>";

		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";
		                    echo "<img src='".asset($post->photo)."' class='img-thumbnail' height='200' width='200'/><br><br>";
		                    echo "</div>";

		                }else{

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> said:<br><br>";
		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";
		                    echo "</div>";

		                }
		            } ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
@endsection
<script src="http://localhost:65001/socket.io/socket.io.js"></script>