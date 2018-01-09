<div class="container chat" id="overlay">
    
    <div>
        <div class="resizeChat" onclick="resizeChat()"><span class="glyphicon glyphicon-resize-small"></span></div>

        <div class="closeChat" onclick="closeChat();"><span class="glyphicon glyphicon-remove"></span></div>
    </div>

    <div id="buttons"></div>
<div id="fracca"></div>
    <textarea id="text" class="scrollabletextbox" rows="2" name="message"></textarea>
</div>

<div class="container nomi" id="overlay">
    <div class="row">
        <div class ="col-sm-6 col-md-offset-3">
            <form action="{{ URL::to('/conversations/create') }}" method="POST" id="form_store_conversation">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_log" id="id_utente_log" value="<?= Auth::user()->id ?>">
                <input type="hidden" name="type_conversation" id="tipo" value="1">
                <input type="hidden" name="id_other" id="id_other" value="">
                <input type="hidden" name="id_conversation" id="id_conversation" value="">

                <?php foreach($users as $user) { ?>
                    <?php 
                        //$id_conv = App\Conversations_user::find_conversation(Auth::user()->id, $user->id);
                        $tot = array();
                        foreach($users as $user) {
                            $id_conv = App\Conversations_user::find_conversation(Auth::user()->id, $user->id);    
                            if(!empty($id_conv)) {                                                             array_push($tot, $id_conv[0]->id_conversazione);
                            }                                                                                 
                        }
                        dd($tot);
                    ?>
                    <button type="submit" value="{{ $user->id }}" onclick="add_id_other({{$user->id}});crea('{{$user->name}}','{{$user->id}}',{{$id_conv[0]->id_conversazione}});">{{$user->name}}</button><br>
                <?php } ?>  
            </form>
        </div>
    </div>
</div>