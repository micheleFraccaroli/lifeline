@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default">
                <?php if(Auth::user()->image == '0'){?>
                    <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{URL::asset('/default-profile-image.png')}}" alt="Profile Image"></a>
                    <?php } else { ?>
                        <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{asset(Auth::user()->image)}}" alt="Profile Image"></a>
                    <?php } ?>
                    <div id="nick"> 
                        {{ Auth::user()->name }}    
                        {{ Auth::user()->surname }}
                    </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Gruppi</div>
                    <div class="panel-body">
                        Gruppetti Fighetti
                    </div>
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
                            <form class="form-horizontal" method="POST" action="{{ URL::to('/home/post') }}" enctype="multipart/form-data" id="new_post">

                                {{ csrf_field() }}

                                <input type="text" id="body_post">
                                <br>
                                <label for="Immagine gruppo">Aggiungi immagine al post</label>
                                <br>
                                <input type="file" id="pic" accept="image/*"/>
                                <div class="form-group">
                                    <img id="show_group_pic" class ="img-responsive img-circle" src="#" height="200" width="200"/>
                                    <span class="custom-file-control"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Pubblica
                                </button>
                            </form>

                            <div class ="col-sm-12"> 
                                <div class="alert alert-info" id="all_groups">
                                    <div id="bacheca_posts">
                                        <?php 
                                        foreach ($all_posts as $post){

                                            echo "<div id='post_{$post->id}'>";

                                            if ($post->photo != NULL) {

                                                echo "<B>".$post->created_at." ".$user[$post->id]->name." ".$user[$post->id]->surname."</B> ha pubblicato una foto:<br>";
                                                echo $post->body."<br><br>";
                                                echo "<img class='post_photo' src='".asset($post->photo)."'/><br><br>";

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
                                            <button type='button' class='btn btn-info btn-sm' name="modal_delete" id='<?php echo "modal_{$post->id}"; ?>'>
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
                                                            <button type='submit' class='btn btn-info btn-block btn-sm' name='answer' id='Post_{$post->id}'>Rispondi</button>
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