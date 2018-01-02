@extends('layouts.app')
@section('content')
<div class = "row">
	<div class ="col-sm-6 col-md-offset-3">	
		<form id="new_post_group" action="#">
			<div class='form-group'>
				<div>
    				<input type='text' class='form-control' id='body_post_group' placeholder='Scrivi qualcosa di nuovo...'>
					<br>
					<input type="file" id="post_pic"/>
    			</div>
    			<br><button type='submit' class='btn btn-info btn-block'>Pubblica</button>
    		</div>
    	</form>
  	</div>
</div>
<hr>
<div class = "row">
	<div class ="col-sm-6 col-md-offset-3">	
		<div class="alert alert-info" id="all_groups">
			<div id="new_post">

			</div>
			<?php 
				foreach ($all_posts as $post){
					echo "<B>".$post->created_at." ".$user[$post->id]->name." ".$user[$post->id]->surname."</B> ha scritto:<br>";
					echo $post->body."<br><br>";
					echo  "<button class='btn btn-info' type='button' data-toggle='collapse' data-target='#collapse_{$post->id}' aria-expanded='false' aria-controls='collapse_{$post->id}'>
    						Mostra commenti
  						  </button>";
  			?>
  			<?php
  					echo"<div class='collapse' id='collapse_{$post->id}'>
  							<div class='card card-body'>
  								<br>
								<div class='form-group'>
    								<input type='text' class='form-control' placeholder='Scrivi un commento in risposta...' id ='body_comment_{$post->id}'>
  								</div>
  								<form id='Post_group_{$post->id}' action='#'>
  								<button type='submit' class='btn btn-info btn-block'>Rispondi</button>
  								</form>
  							</div>
						</div><hr>";
				}
			?>
		</div>
	</div>
</div>
@endsection