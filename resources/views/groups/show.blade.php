@extends('layouts.app')
@section('content')

<div class="panel-body">

<div class = "row">

  <div class = "col-sm-3">
      <div class="alert alert-info">

      <?php echo "<B>".$group->name."</B><br><br>" ?>
      <?php echo "<img src='".asset($group->image)."' class='img-thumbnail' height='200' width='200'/>&nbsp;<B></a></B>";?>

      <br>
      <br>

      <form method="GET" action="<?php echo "/groups/{$id}/edit"; ?>">
        <div class='btn-group' role='group'>
          <button type="button" class="btn btn-info" data-container="body" data-toggle="popover" title="<B>Administrator:</B><br><br><img class = 'img-circle' src='{{$admin->image}}' height='60' width='60'/>&nbsp;<a href='/users/{{$admin->id}}'><B>{{$admin->name}} {{$admin->surname}}</B></a>" data-content="<B>Description:</B><br>{{$group->description}}"><span class=' glyphicon glyphicon-info-sign'></span> Info</button>
          <?php if(Auth::id() == $admin->id){ ?>
          <button class='btn btn-info' type='submit'><span class=' glyphicon glyphicon-cog'></span>
          Edit</button>
          <button class='btn btn-info' data-toggle="modal" data-target="#delete_group" type='button'><span class=' glyphicon glyphicon-trash'></span>
           Delete</button>
          <?php }elseif($access){ ?>
          <button class='btn btn-info' data-toggle="modal" data-target="#leave_group" type='button'>Leave</button>  
           <?php } ?> 
        </div>
      </form>
      <form method="POST" action="<?php echo "/groups/{$id}"; ?>">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        @include('layouts.modal_delete_group')
      </form>
      <form method="GET" action="<?php echo "/users/leave_group/{$id}"; ?>">
        @include('layouts.modal_leave_group')
      </form>
    </div>
  </div>

  <?php  if($access){ ?>

	<div class ="col-sm-6" id="input_mask">	
		<div class="alert alert-info">
			<form id="<?php echo "new_post_group_{$id}" ?>" action="#" enctype="multipart/form-data">
				<textarea class="form-control" id="body_post" placeholder="Hey. What's up?"></textarea>
        <br>            
        <div class='collapse' id='Mycollapse'>
            <div class='card card-body'>
                <input type="file" id="pic_post" style="display: none;"/>
                <button type="button" class="btn btn-info" onclick="document.getElementById('pic_post').click();">
                <span class="glyphicon glyphicon-picture"></span>
                    Share a pic
                </button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#LinkModal">
                <span class="glyphicon glyphicon-link"></span>
                    Share a link
                </button>
                <button type="button" class="btn btn-info" id="close_post">
                <span class=" glyphicon glyphicon-menu-up"></span>
                    Close
                </button>
                <hr>
                <div id = "pic_space">
                    <button type='button' class='btn btn-info' id="discard_pic" style="display: none;">
                    <span class="glyphicon glyphicon-trash"></span>
                    Discard pic
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-info btn-block" disabled>
          Share with your friends...
        </button>

        <!-- modale per l'aggiunta di un link al post -->

        <div class="modal fade" id="LinkModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Insert a link, this will be attached at the end of the post.
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
                <div class="modal-body">
                    <input type='text' id="link_post" class='form-control'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info"data-dismiss="modal">Save</button>
                </div>
            </div>
          </div>
        </div>
			</form>
	  	</div>
  	</div>

  <hr>


	<!-- Pulsante che consente l'iscrizione al gruppo -->

	<?php }else{?>

		<div class ="col-sm-6">	
			<form action="<?php echo "/user/new_group/{$id}"; ?>">
				<button type='submit' class='btn btn-info btn-block'>Subscribe</button>
	    </form>
	  </div>

  <hr>

  <?php } ?>

</div>


	<div class = "row">

		<!-- mostra i gruppi a cui NON sei ancora iscritto -->

	<div class ="col-sm-3">
		<div class="alert alert-info">
			<?php echo "<B>Maybe you could like</B><br><br>";?>
			<?php foreach ($other_groups as $other_group){?>

					<form id="<?php echo "other_{$other_group->id}" ?>" action="#">

						<img class = "img-responsive img-circle" src="<?php echo asset($other_group->image)?>" height="50" width="50"/>

					<?php echo "<img class = 'img-circle' src='".asset($other_group->image)."' height='60' width='60'/>&nbsp;<B><a href=\"/groups/index/{$other_group->id}\">{$other_group->name}</a></B><br><br>";?>

					<button type='submit' class='btn btn-info'  style="display: none;">Iscriviti</button>
				</form>

			<?php } ?>
      <button type='button' class='btn btn-info' data-toggle="modal" data-target="#other_groups">
       Show other groups
      </button>
        @include('layouts.modal_other_groups')
		</div>
	</div>	
						

		<!-- mostra i post pubblicati sul gruppo -->

		<div class ="col-sm-6 offset-md-3">	
			<div class="alert alert-info" id="all_groups">
				<div id="append_new_posts">
				<?php  if($access){ ?>
				<?php 
					foreach ($all_posts as $post){

						echo "<div id='post_{$post->id}'>";

						if ($post->photo != NULL) {


  						echo "<img src='".asset($user[$post->id]->image)."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user[$post->id]->id}\">{$user[$post->id]->name} {$user[$post->id]->surname}</a></B> posted a photo:<br><br>";
  						echo $post->body."<br>";
              echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";
  						echo "<img src='".asset($post->photo)."' class = 'img-thumbnail' height='200' width='200'/><br><br>";

						}else{

  						echo "<img src='".asset($user[$post->id]->image)."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user[$post->id]->id}\">{$user[$post->id]->name} {$user[$post->id]->surname}</a></B> said:<br><br>";
  						echo $post->body."<br>";
              echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

						}

  					echo" <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
  					echo " <div class='btn-group mr-2' role='group' aria-label='First group'>";

  					echo  "<button class='btn btn-info' type='button' name='show_details' data-target='#collapse_{$post->id}'> <span class='glyphicon glyphicon-eye-open'></span>
      						Show comments
    						  </button>";	

  					if ($my_like[$post->id]) {

  						echo  "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='dislike'><span class='glyphicon glyphicon-thumbs-up'></span>".$like[$post->id]."</button>";

  					}else{

  						echo  "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='like'>Like ".$like[$post->id]."</button>";
  					}


  					if ($user[$post->id]->id == Auth::id()) { 						
  					  		
			?>
						<button type='button' class='btn btn-info' name="modal_delete" id='<?php echo "modal_{$post->id}"; ?>'><span class="glyphicon glyphicon-trash"></span>
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
  									<button type='submit' class='btn btn-info btn-block' name='answer' id='Post_comment_{$post->id}' disabled>Answer</button>
  								</form>
  						</div>
					</div>
				<hr>
			</div>";
			}
			?>
			@include('layouts.modal_groups')
			<?php }else{echo "iscriviti per vedere cosa pubblicano gli altri utenti";} ?>
			</div>
		</div>
	</div>

	<div class ="col-sm-3">
		<div class="alert alert-info">
			<?php echo "<B>Registered users</B><br><br>";?>
			<?php
				foreach ($group->users as $user) {
					echo "<img class = 'img-circle' src='".$user->image."' height='60' width='60'/>&nbsp;<B><a href=\"/users/{$user->id}\">{$user->name} {$user->surname}</a></B><br><br>";
				}
			?>
      <button type='button' class='btn btn-info' data-toggle="modal" data-target="#users_group">
      <span class="glyphicon glyphicon-user"></span>
       Show all users
      </button>
      @include('layouts.modal_users_group')

		</div>
  </div>

		

	</div>
</div>

@endsection