
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
        
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

/*La funzione ReadURL viene utilizzata per mostrare l'immagine in anteprima nel form relativo
alla creazione del gruppo o per la modifica*/
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();                 /* vado ad instanziare l'oggetto FileReader */

        reader.onload = function(e) {
            $("#show_group_pic").attr("src", e.target.result); /* sull' evento onload leggo il contenuto */ 
            $("input[name*='group_pic_value']").val(e.target.result);
        }                                                                                               

        reader.readAsDataURL(input.files[0]);  /* ritorna il contenuto del file sotto forma di URL */
        $("input[name*='group_pic_value']").val(reader.readAsDataURL(input.files[0]));
    }
}

$("#group_pic").change(function() {
    eadURL(this);
});


/*****Crea un nuovo post all'interno d un gruppo*****/

$("#new_post_group").on('submit',function(e){

    e.preventDefault();

    var user_id = 1;            /*estrapolo l'id dell'utente attivo attualmente, per comodità adesso uso il mio*/
    var group_id = 1;

    var body = $('#body_post_group').val(); /*estrapolo il corpo del post*/

    var photo = $('#post_pic').val();

    $.ajax({
        type: "POST",
        url: "/posts",
        data: {user_id:user_id,group_id:group_id,body:body,photo:photo},
        datatype: "json",
        success: function(data){

            console.log(data);

            var post = "<B>"+data.post.created_at+" "+data.user.name+" "+data.user.surname+"</B> ha scritto:<br>"+data.post.body+"<br><br>";
            $('#new_post').prepend(post);
        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });

});

/*****mostra i commenti relativi ad un post*****/

$("[id*='collapse_']").on('shown.bs.collapse', function () {

    var id = $(this).attr('id');

    var post_id = id.slice(9); /*estraggo l'id del post*/

    $.ajax({
        type: "GET",
        url: "/posts/"+post_id,
        data: {id:post_id},
        datatype: "json",
        success: function(data){

            if (data.user.length!=0){

                for (i = 0; i < data.user.length; i++) {

                    var comment = "<br><B>"+data.user[i].name+" "+data.user[i].surname+"</B> ha commentato:<br>"+data.comments[i].body+"<br>";
                    $('#collapse_'+post_id).prepend(comment);

                }
            }

            /*imposto il testo del bottone a Nascondi commenti*/

            $("[data-target='#collapse_"+post_id+"']").text('Nascondi commenti');

        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });
  
})

/*****Cambia testo del bottone impostandolo a Mostra commenti*****/

$("[id*='collapse_']").on('hidden.bs.collapse', function () {

    var id = $(this).attr('id');

    var post_id = id.slice(9); /*estraggo l'id del post*/

    $("[data-target='#collapse_"+post_id+"']").text('Mostra commenti');

})

/*****Crea un nuovo commento*****/

$("[id*='Post_group_']").on('submit', function (e) {

    e.preventDefault();

    var id = $(this).attr('id');

    var post_id = id.slice(11); /*estrapolo l'id del post*/

    var user_id = 1;            /*estrapolo l'id dell'utente attivo attualmente*/

    var body = $('#body_comment_'+post_id).val(); /*estrapolo il corpo del commento*/

    $.ajax({
        type: "POST",
        url: "/comments",
        data: {post_id:post_id,user_id:1,body:body},
        datatype: "json",
        success: function(data){

            var comment = "<br><B>Matteo Gemelli</B> ha commentato:<br>"+data.body+"<br>";
            $('#collapse_'+post_id).prepend(comment);
            $('#body_comment_'+post_id).val("");

        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });
  
})