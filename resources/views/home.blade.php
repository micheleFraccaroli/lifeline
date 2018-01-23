@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default homeImage">
                <?php if(Auth::user()->image == '0' && Auth::user()->sex == 'M'){ ?>
                    <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{URL::asset('/default-profile-image-M.png')}}" alt="Profile Image"></a>
                <?php } elseif (Auth::user()->image == '0' && Auth::user()->sex == 'F'){ ?>
                    <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{URL::asset('/default-profile-image-F.png')}}" alt="Profile Image"></a>
                <?php } else { ?>
                    <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{asset(Auth::user()->image)}}" alt="Profile Image"></a>
                <?php } ?>
            <div id="nick"> 
                {{ Auth::user()->name }}    
                {{ Auth::user()->surname }}
            </div>
            </div>
            <div class="panel panel-default homeGroups">
                <form method="GET" action="/groups/create" >

                    <div class="panel-heading">Gruppi</div>
                        <div class="panel-body">
                            Gruppetti Fighetti
                        </div>
                        <button type="submit" class="btn btn-info">Create new group</button>

                </form>

            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default" id="post_page">

                <!--inizio panel body-->
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel-body">


                            @include('layouts.errorajax')
                            
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
                        

                            <div class ="col-sm-12"> 
                                <div class="alert alert-info" id="all_groups"> 

                                    <div id="bacheca_posts">
                                        <?php
                                        
                                        foreach ($all_posts as $post){

                                            echo "<div id='post_{$post->id}'>";

                                            if ($post->photo != NULL) {

                                                echo "<img src='".$user[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user[$post->id]->id}\">{$user[$post->id]->name} {$user[$post->id]->surname}</a></B> posted a photo:<br><br>";

                                                echo $post->body."<br>";

                                                echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

                                                echo "<img src='".asset($post->photo)."' class='img-thumbnail' height='200' width='200'/><br><br>";

                                            }else{

                                                echo "<img src='".$user[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user[$post->id]->id}\">{$user[$post->id]->name} {$user[$post->id]->surname}</a></B> said:<br><br>";

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


                                            if ($user[$post->id]->id == Auth::id()) {                       
                            
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

                    <!--fine panel body-->
                            
            </div>
        </div>

    </div>
</div>


@endsection

@extends('layouts.chat')