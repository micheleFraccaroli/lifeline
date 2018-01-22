<div class="form-group">
    <div>
        <input type='text' class='form-control' name='body_post_group' id='body_post_group' placeholder='Scrivi qualcosa di nuovo...'>
        <br>
        <input type="file" name="post_pic_group" id="post_pic_group"/>
    </div>
    <br><button type='submit' class='btn btn-info btn-block'>Pubblica</button>
</div>

<script>
$("#aggiorna_gruppi").on('submit',function(e){

    e.preventDefault();

    /*Individuo qual'è l'id più grande attualmente presente nella finestra index*/

    var max_id = $("input[name='max_id_index']").val();

    /*tramite ajax() effettuo una chiamata asincrona al controller */

    $.ajax({
        type: "GET",
        url: "/groups/index",
        data: {id:max_id},
        datatype: "json",
        success: function(data){

        var i = 0;

        if (data.length!=0){

            var new_max_id = data[0].id;

            /*assegno il nuovo id più grande al bottone "aggiorna_gruppi"*/

            $("input[name='max_id_index']").val(new_max_id);

            for (i = 0; i < data.length; i++) {

                var new_group = "<a href=\"/groups/index/"+data[i].id+"\">"+data[i].id+" - "+data[i].name+"</a> <br>";
                $('#all_groups').prepend(new_group);

                    }
                }

        },
                error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });

});
</script>

<div class="col-md-8">
            <div class="panel panel-default"> 
                {{ $user['name'] }} 
                {{ $user['surname'] }} <br>
                {{ $user['sex'] }}      <br>
                {{ $user['born'] }} <br>
                {{ $user['job'] }}      <br>
                {{ $user['relation'] }}<br>
            </div>
        </div>