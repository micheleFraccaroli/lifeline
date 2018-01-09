
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

/****Iscrizione ad altri gruppi*****/

$("[id*='other_']").on('submit',function(e){

    e.preventDefault();

    var id = $(this).attr('id');

    var arr = id.split("_");

    var group_id = arr[arr.length-1];

    $.ajax({

        type: "POST",
        url: "/user/new_group",
        data: {group_id:group_id},
        datatype: "json",
        success: function(data){

            $("#other_"+group_id).remove();

        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });

});

/*****Crea un nuovo post all'interno d un gruppo*****/

$("[id*='new_post_group']").on('submit',function(e){

    e.preventDefault();

    var formData = new FormData();

    var id = $(this).attr('id');

    var arr = id.split("_");

    var group_id = arr[arr.length-1];

    formData.append('body_post_group', $('#body_post_group').val());

    formData.append('post_pic_group', $('input[type=file]')[0].files[0]);   

    formData.append('group_id', group_id);

    $.ajax({
        type: "POST",
        url: "/posts",
        data: formData,
        datatype: "json",
        contentType: false,
        processData: false,
        success: function(data){

                var body;

                if (data.asset.length){

                    body =  "<div id='post_"+data.post.id+"'>"+

                    "<B>"+data.post.created_at+" "+data.user.name+" "+data.user.surname+"</B> ha pubblicato una foto:<br>"+data.post.body+"<br><br>"+"<img src='"+data.post.photo+"' height='200' width='200'/><br><br>"+

                    " <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>"+
                    " <div class='btn-group mr-2' role='group' aria-label='First group'>"+

                    "<button class='btn btn-info btn-sm' type='button' name='show_details' data-target='#collapse_"+data.post.id+"'>"+
                            "Show comments"+
                    "</button>"+   
                    "<button class='btn btn-info btn-sm' type='button'>"+
                            "Like"+
                    "</button>"+

                    "<button type='button' class='btn btn-info btn-sm' name='delete' id='modal_"+data.post.id+"'>"+
                            "Delete post"+
                    "</button>"+
                    
                    "</div></div>"+

                    "<div class='collapse' id='collapse_"+data.post.id+"'>"+
                        "<div class='card card-body'>"+
                            "<br>"+
                                "<div id='new_comment_"+data.post.id+"'>"+
                                "</div>"+
                                "<div class='form-group'>"+
                                   "<input type='text' class='form-control' placeholder='Scrivi un commento in risposta...' id ='body_comment_"+data.post.id+"'>"+
                                "</div>"+
                                "<form action='#'>"+
                                    "<button type='submit' class='btn btn-info btn-block' name='answer' id='Post_group_"+data.post.id+"'>Rispondi</button>"+
                                "</form>"+
                        "</div>"+
                    "</div>"+
                    "<hr>"+
                    "</div>";

                }else{

                    body =  "<div id='post_"+data.post.id+"'>"+

                    "<B>"+data.post.created_at+" "+data.user.name+" "+data.user.surname+"</B> ha scritto:<br>"+data.post.body+"<br><br>"+

                    " <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>"+
                    " <div class='btn-group mr-2' role='group' aria-label='First group'>"+

                     "<button class='btn btn-info btn-sm' type='button' name='show_details' data-target='#collapse_"+data.post.id+"'>"+
                            "Show comments"+
                    "</button>"+  
                    "<button class='btn btn-info btn-sm' type='button'>"+
                            "Like"+
                    "</button>"+

                    "<button type='button' class='btn btn-info btn-sm' name='delete' id='modal_"+data.post.id+"'>"+
                            "Delete post"+
                    "</button>"+
                    
                    "</div></div>"+

                    "<div class='collapse' id='collapse_"+data.post.id+"'>"+
                        "<div class='card card-body'>"+
                            "<br>"+
                                "<div id='new_comment_"+data.post.id+"'>"+
                                "</div>"+
                                "<div class='form-group'>"+
                                   "<input type='text' class='form-control' placeholder='Scrivi un commento in risposta...' id ='body_comment_"+data.post.id+"'>"+
                                "</div>"+
                                "<form action='#'>"+
                                    "<button type='submit' class='btn btn-info btn-block' name='answer' id='Post_group_"+data.post.id+"'>Rispondi</button>"+
                                "</form>"+
                        "</div>"+
                    "</div>"+
                    "<hr>"+
                    "</div>";
                }          
                        
            $('#post_pic_group').val("");
            $('#body_post_group').val("");

            $('#append_new_posts').prepend(body);

    },
        error: function(xhr){
        alert("An error occured: " + xhr.status + " " + xhr.statusText);
    },

    });

});

/******Mostra i commenti relativi ad un post******/

function show_details(target){

    var last;

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    if ($("[data-target='#collapse_"+post_id+"']").text()=="Hide comments") {

        $("[data-target='#collapse_"+post_id+"']").text("Show comments");

        $("#collapse_"+post_id+"").collapse('hide');

    }else{

        n_child = $("#new_comment_"+post_id+"").children().length;

        if (n_child==0) {

            $.ajax({
                type: "GET",
                url: "/posts/"+post_id,
                data: {id:post_id,last:0},
                datatype: "json",
                success: function(data){

                    if (data.user.length!=0){

                        for (i = 0; i < data.user.length; i++) {

                            var comment = "<div id="+data.comments[i].id+"><br><B>"+data.comments[i].created_at+" "+data.user[i].name+" "+data.user[i].surname+"</B> ha commentato:<br>"+data.comments[i].body+"<br></div>";
                            $('#new_comment_'+post_id).append(comment);

                        }
                    }

                    $("[data-target='#collapse_"+post_id+"']").text('Hide comments');

                },

                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },

            });

        }else{

            last = $("#new_comment_"+post_id+" div:last-child").attr("id");

            $.ajax({
                type: "GET",
                url: "/posts/"+post_id,
                data: {id:post_id,last:last},
                datatype: "json",
                success: function(data){

                    if (data.user.length!=0){

                        for (i = 0; i < data.user.length; i++) {

                            var comment = "<div id="+data.comments[i].id+"><br><B>"+data.comments[i].created_at+" "+data.user[i].name+" "+data.user[i].surname+"</B> ha commentato:<br>"+data.comments[i].body+"<br></div>";
                            $('#new_comment_'+post_id).append(comment);

                        }
                    }

                    $("[data-target='#collapse_"+post_id+"']").text('Hide comments');

                },

                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },

            });

        }

        $("[data-target='#collapse_"+post_id+"']").text('Hide comments');

        $("#collapse_"+post_id+"").collapse('show');
    }
}

/*****Crea un nuovo commento*****/

function new_comment(target){

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1]; /*estrapolo l'id del post*/

    var body = $('#body_comment_'+post_id).val(); /*estrapolo il corpo del commento*/

    $.ajax({
        type: "POST",
        url: "/comments",
        data: {post_id:post_id,body:body},
        datatype: "json",
        success: function(data){

            //$("#collapse_"+post_id).collapse('show');

            //$('#new_comment_'+post_id).load(location.href + ' #new_comment_'+post_id);

            var comment = "<div id="+data.comment.id+"><br><B>"+data.comment.created_at+" "+data.user.name+" "+data.user.surname+"</B> ha commentato:<br>"+data.comment.body+"<br></div>";
            $('#new_comment_'+post_id).append(comment);
            $('#body_comment_'+post_id).val("");

        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });
  
}


/*****Elimina il post pubblicato da un utente*****/

function delete_post(target){

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    $.ajax({
        type: "DELETE",
        url: "/posts/"+post_id,
        data: {post_id:post_id},
        datatype: "json",
        success: function(data){
            
            $("#post_"+post_id).remove();
        },
            error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },

    });

}




/*****Gestione dei like*****/

function like_post(target) {

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    $.ajax({
        type : "POST",
        url : "/post/like",
        data : {id_post:post_id},
        dataTy : 'json',
        success:function(data) {
            $('#append_new_posts').load(location.href + " #append_new_posts");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
}

function delete_like(target) {

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    $.ajax({
        type : "POST",
        url : "/post/dislike",
        data : {id_post:post_id},
        dataTy : 'json',
        success:function(data) {
            $('#append_new_posts').load(location.href + " #append_new_posts");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
}


/****Gestisce le varie richieste dell'utente*****/

$("#append_new_posts").on('click','button',function (e) {

    e.preventDefault();

    var id = $(this).attr('name');

    switch(id){

        case "answer":

            new_comment($(this).attr('id'));

        break;

        case "like":

            like_post($(this).attr('id'));

        break;

        case "dislike":

            delete_like($(this).attr('id'));

        break;

        case "delete":

            $("#myModal").modal("show");

            $("[name='modal_delete']").attr('id',$(this).attr('id'));


        break;

        case "modal_delete":

            $("#myModal").modal("hide");

            delete_post($(this).attr('id'));

        break;

        default:

            show_details($(this).attr('data-target'));

    }

});