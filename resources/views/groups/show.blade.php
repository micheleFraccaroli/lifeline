@extends('layouts.app')
@section('content')

<!-- pubblica post -->

<?php  if($access){ ?>

<div class = "row">
	<div class ="col-sm-6 col-md-offset-3">	
		<form id="<?php echo "new_post_group_{$id}" ?>" action="#" enctype="multipart/form-data">
			<div class="form-group">
				<div>
    				<input type='text' class='form-control' name='body_post_group' id='body_post_group' placeholder='Scrivi qualcosa di nuovo...'>
					<br>
					<input type="file" name="post_pic_group" id="post_pic_group"/>
    			</div>
    			<br><button type='submit' class='btn btn-info btn-block'>Pubblica</button>
    		</div>
    	</form>
  	</div>
</div>
<hr>

<?php }else{echo "iscriviti";} ?>

<div class = "row">

	<!-- mostra i gruppi a cui NON sei ancora iscritto -->

	<div class ="col-sm-3">
		<div class="alert alert-info">
			<?php echo "<B>Potrebbero interessarti i seguenti gruppi</B><br><br>";?>
			<?php foreach ($other_groups as $other_group){?>

				<form id="<?php echo "other_{$other_group->id}" ?>" action="#">

					<img class = "img-responsive img-circle" src="<?php echo asset($other_group->image)?>" height="50" width="50"/>

					<?php echo $other_group->name."<br>";?>

					<br>

					<button type='submit' class='btn btn-info btn-block btn-sm'>Iscriviti</button>

					<hr>

				</form>

			<?php } ?>
		</div>
	</div>	


	<!-- mostra i post pubblicati sul gruppo -->

	<div class ="col-sm-6">	
		<div class="alert alert-info" id="all_groups">
			<div id="append_new_posts">
			<?php  if($access){ ?>
			<?php 
				foreach ($all_posts as $post){

					echo "<div id='post_{$post->id}'>";

					if ($post->photo != NULL) {

						echo "<B>".$post->created_at." ".$user[$post->id]->name." ".$user[$post->id]->surname."</B> ha pubblicato una foto:<br>";
						echo $post->body."<br><br>";
						echo "<img src='".asset($post->photo)."' height='200' width='200'/><br><br>";

					}else{

						echo "<B>".$post->created_at." ".$user[$post->id]->name." ".$user[$post->id]->surname."</B> ha scritto:<br>";
						echo $post->body."<br><br>";

					}

					echo" <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
					echo " <div class='btn-group mr-2' role='group' aria-label='First group'>";

					echo  "<button class='btn btn-info btn-sm' type='button' name='show_details' data-target='#collapse_{$post->id}'>
    						Show comments
  						  </button>";	

  					if ($my_like[$post->id]) {

  						echo  "<button class='btn btn-info btn-sm' type='button' id='like_post_{$post->id}' name='dislike'>Ti piace ".$like[$post->id]."'</button>";

  					}else{

  						echo  "<button class='btn btn-info btn-sm' type='button' id='like_post_{$post->id}' name='like'>Like ".$like[$post->id]."'</button>";
  					}


  					if ($user[$post->id]->id == Auth::id()) { 						
  					  		
			?>
						<button type='button' class='btn btn-info btn-sm' name="delete" id='<?php echo "modal_{$post->id}"; ?>'>
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
    								<input type='text' class='form-control' placeholder='Scrivi un commento in risposta...' id ='body_comment_{$post->id}'>
  								</div>
  								<form action='#'>
  									<button type='submit' class='btn btn-info btn-block btn-sm' name='answer' id='Post_group_{$post->id}'>Rispondi</button>
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

	<!-- utenti appartenenti al gruppo -->

	<div class ="col-sm-3">
		<div class="alert alert-info">
			<?php echo "<B>Utenti iscritti al gruppo</B><br>";?>
			<?php
				foreach ($group->users as $user) {
					echo "<img class = 'img-responsive img-circle' src='' height='50' width='50'/><br>";
					echo $user->name." ".$user->surname."<br><br>";
					echo "<button type='button' class='btn btn-info btn-block btn-sm'>Visualizza profilo</button><hr>";
				}
			?>
		</div>
	</div>	

</div>

@endsection