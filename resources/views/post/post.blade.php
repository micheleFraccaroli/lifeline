@extends('layouts.app')

@section('content')

<?php if(Auth::check()) { ?>

{{Auth::user()->unreadNotifications->markAsRead()}}



                             <div class ="col-sm-12"> 
                                <div class="alert alert-info" id="all_groups"> 

                                    <div id="bacheca_posts">
                                        <?php
//dd($user->image);
                                            echo "<div id='post_{$post->id}'>";

                                            if ($post->photo!=null) {

                                                echo "<img src='".$user->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user->id}\">{$user->name} {$user->surname}</a></B> posted a photo:<br><br>";

                                                echo $post->body."<br>";

                                                echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

                                                echo "<img src='".asset($post->photo)."' class='img-thumbnail' height='200' width='200'/><br><br>";

                                            }else{//dd($user);
                                                echo "<img src='".$user->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." "."<a href=\"/users/{$user->id}\">{$user->name} {$user->surname}</a></B> said:<br><br>";

                                                echo $post->body."<br>";
                                                
                                                echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

                                            }

                                            echo" <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
                                            echo " <div class='btn-group mr-2' role='group' aria-label='First group'>";

                                            echo  "<button class='btn btn-info' type='button' name='show_details' data-target='#collapse_{$post->id}'> <span class='glyphicon glyphicon-eye-open'></span>
                                                Show comments
                                                </button>";   

                                            if ($my_like) {

                                                echo "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='dislike'><span class='glyphicon glyphicon-thumbs-up'></span> ".$like."</button>";

                                            }else{

                                                echo  "<button class='btn btn-info' type='button' id='like_post_{$post->id}' name='like'>Like ".$like."</button>";
                                            }


                                            if ($user->id == Auth::id()) {                       
                            
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
                                        ?>
                                        @include('layouts.modal_groups')
                                    </div>
                                </div>
                            </div>

<?php } else {
    header('Location: ' . route('login'));
    die();
} ?>

@endsection