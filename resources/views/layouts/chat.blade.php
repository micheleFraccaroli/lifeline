<?php 
use App\Http\Controllers\FriendController; 
?>
<div class="container chat">
    <div>
        <span onclick="resizeChat()" class="glyphicon glyphicon-resize-small" aria-hidden="true"></span>
        <span onclick="closeChat()" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </div>

    <div id="buttons"></div>
    <textarea id="text" class="scrollabletextbox" rows="2" name="message"></textarea>
</div>

<div class="container nomi">
    <div class="row">
        <div class ="col-sm-6 col-md-offset-3">
            
    <?php   $i = 0;
            $index = 0;
            $users = FriendController::show();
            //dd($users['users']);
            foreach($users['users'] as $user) { ?>
                
                <form action="{{ URL::to('/conversations/create') }}" method="POST" id="<?= $index ?>">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_log" value="<?= Auth::user()->id ?>">
                    <input type="hidden" name="type_conversation" value="1">
                    <input type="hidden" name="id_other" value="<?= $user->id ?>">
                    <input type="hidden" name="id_conversation" value="">

             <?php  $id_conv = App\Conversations_user::find_conversation(Auth::user()->id, $user['id']);
                
                    $chat_name = $user->name . " " . $user->surname; 
                    if(!empty($id_conv)) { ?>
                        <input type="button" value="{{$chat_name}}" onclick="add_id_other({{$user->id}},{{Auth::user()->id}},{{$index}},'{{$chat_name}}', 0);"><br>
                <?php   $i++;    
                    }
                    else { ?>
                        <input type="button" value="{{$chat_name}}" onclick="add_id_other({{$user->id}},{{Auth::user()->id}},{{$index}},'{{$chat_name}}',0);"><br>
                <?php    } ?>
                </form>
                <?php $index++;
            }
            ?>  
        </div>
    </div>
</div>

<script src="http://localhost:65000/socket.io/socket.io.js"></script>
<script src="{{asset('js/conversation.js') }}" type="text/javascript"></script>