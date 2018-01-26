@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default homeImage homeGroups"> 
                <?php if($user['image'] == '0' && $user['sex'] == 'M') { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{URL::asset('/default-profile-image-M.png')}}" alt="Profile Image"></a>
                <?php } elseif ($user['image'] == '0' && $user['sex'] == 'F') { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{URL::asset('/default-profile-image-F.png')}}" alt="Profile Image"></a>
                <?php } else { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{asset($user['image'])}}" alt="Profile Image"></a>
                <?php } ?>
                <hr>

                <B>{{ $user['name'] }}</B>    
                <B>{{ $user['surname'] }}</B> <br>
                
            	<!-- button group -->

            	<form method="GET" action="/users/update/{{ $user['id'] }}">
	            	<div class='btn-group' role='group' aria-label='...'>
				        <button type="button" class="btn btn-info" data-container="body" data-toggle="popover" title="<B>{{$user['name']}} {{$user['surname']}}</B>" data-content="<B>Name:</B> {{$user['name']}}<br><B>Surname:</B> {{$user['surname']}}<br><B>Sex:</B> {{$user['sex']}}<br><B>Born:</B> {{$user['born']}}<br><B>Job:</B> {{$user['job']}}<br><B>Relathionship:</B> {{$user['relation']}}<br><B>E-mail:</B> {{$user['email']}}">
	          			<span class=' glyphicon glyphicon-info-sign'></span> Info
	          			</button>
			            <button class='btn btn-info' type='submit'><span class=' glyphicon glyphicon-cog'></span>
	      				Update</button>
				    </div>
			    </form>			    
               
            </div>
        </div>

        <div class="col-md-8">
        	<div class="panel panel-default" id="post_page">
        		<div class="panel-body">
        			<div class="panel-body">
						<div class ="col-sm-12" id="input_mask"> 
				            <div class="alert alert-info">
				                <form method="POST" action="{{ URL::to('/home/post') }}" enctype="multipart/form-data" id="new_post">

				                    {{ csrf_field() }}

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

				                    <!--fine modale-->

				                </form>

				            </div>
				        </div>				

					<!--post utente -->
					
						<div class="col-sm-12">
							<div class="alert alert-info" id="all_groups">
						        <div id="bacheca_posts">

						        	<!-- Modale -->
							        <div id="modal_image" class="modal">
							            <img class="modal-content" id="img01">
							        </div>

						            <?php 
						            $i = 0;
						            foreach ($all_posts as $post){

						                echo "<div id='post_{$post->id}'>";

						                if ($post->photo != NULL) {

						                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> posted a photo:<br><br>";

						                    echo $post->body."<br>";
						                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

						                    $id_img_post = "post_image" . $i;
						                    echo "<img src='".asset($post->photo)."' name='post_image' id='".$id_img_post."' class='img-thumbnail' height='200' width='200' onclick=\"openImg('".$id_img_post."')\"/><br><br>";
						                    $i++;

						                }else{

						                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname." said:</B><br><br>";
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
					
				</div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection