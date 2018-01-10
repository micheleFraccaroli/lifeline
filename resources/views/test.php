<div class ="col-sm-6"> 
    <div class="alert alert-info" id="all_groups">
        <div id="append_new_posts">
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
        </div>
    </div>
</div>









<div id="like_div">
                            <?php if(!empty($totale)) { ?>
                                
                                        <div id="bacheca">  
                                            
                                            <?php foreach ($totale as $p) { ?>
                                                <div class="panel-body" id="posts_div">
                                                    {{$p->body}} - <strong>{{$p->name}} {{$p->surname}}</strong><br>
                                                    <?php if(!empty($p->photo)) { ?>
                                                        <img id="show_group_pic" class = "img-responsive img-circle" src="{{$p->photo}}" height="200" width="200"/>
                                                        <span class="custom-file-control"></span>
                                                        <input type="hidden" name="group_pic_value"> 
                                                    <?php } ?>

                                                    
                                                        <?php if($p->tot_likes != 0) {
                                                            for ($i=0; $i < $p->tot_likes; $i++) { 
                                                                $ext = "id_like" . $i;
                                                                if(isset($p->$ext) && $p->$ext == Auth::user()->id) { ?>
                                                                    <form method="POST" action="{{ URL::to('/post/dislike') }}" class="like_form">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="id_post" value="{{$p->id_post}}">
                                                                        <input type="hidden" name="id_utente" value="{{Auth::user()->id}}">
                                                                        <button type="submit" class="btn btn-warning">
                                                                            Ti piace    
                                                                        </button>
                                                                    </form>
                                                                <?php break; } else { ?>
                                                                <form method="POST" action="{{ URL::to('/post/like') }}" class="like_form">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id_post" value="{{$p->id_post}}">
                                                                    <input type="hidden" name="id_utente" value="{{Auth::user()->id}}">
                                                                    <button type="submit" class="btn btn">
                                                                        Mi piace    
                                                                    </button>
                                                                </form>
                                                                <?php break; } ?>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <form method="POST" action="{{ URL::to('/post/like') }}" class="like_form">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id_post" value="{{$p->id_post}}">
                                                                <input type="hidden" name="id_utente" value="{{Auth::user()->id}}">
                                                                <button type="submit" class="btn btn">
                                                                    Mi piace    
                                                                </button>
                                                            </form>
                                                        <?php } ?>
                                                        <span class="badge">{{$p->tot_likes}}</span>
                                                    
                                                    <hr>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    
                            <?php } ?>
                            </div>