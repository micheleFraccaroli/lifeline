
/****Gestisco il comportamento delle bacheche dell'utente e dei gruppi*****/

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
      

$(document).ready(function(){
    $('[data-toggle="popover"]').popover({html:true}).click(function(e) {  
        e.preventDefault();
        $(this).focus(); 
   });
});


/*****Controllo input mascherina di creazione gruppi, in particolare il pulsante share with your friends*****/  

$('input[name="name_group"],textarea[name="description_group"]').keyup(function() {
    if($('input[name="name_group"]').val() && $('textarea[name="description_group"]').val()){

        $('button[name="button_create_group"]').prop('disabled', false);

    }else{

        $('button[name="button_create_group"]').prop('disabled', true);

    }
});


/*****Controllo il bottone dei commenti, se presente viene disabilitato*****/

$("[id*='body_comment_']").keyup(function() {

    var id = $(this).attr('id');

    var arr = id.split("_");

    var comment_id = arr[arr.length-1];

    if($(this).val()){

        $("[id*='Post_comment_"+comment_id+"']").prop('disabled', false);

    }else{

        $("[id*='Post_comment_"+comment_id+"']").prop('disabled', true);

    }

});

/****Controllo lunghezza stringhe prima di inviare la richiesta al server*****/
function check_create_group(){

    var check = true;

    if ($('input[name="name_group"]').val().length < 10 || $('input[name="name_group"]').val().length > 50){

        alert("name must be higher than 10 characters and not higher than 50 characters.");

        return check = false;

    }

    if ($('textarea[name="description_group"]').val().length <10 || $('textarea[name="description_group"]').val().length > 255){

        alert("description must be higher than 10 characters and not higher than 255 characters.");

        return check = false;

    }

    if($("#group_pic")[0].files[0]){

        check = check_pic_size($("#group_pic")[0].files[0]);

        if (check == 0){

            return check = false;

        }

    }

}

/*****Anteprima dell' immagine che verrà caricata in un post di un gruppo o nella bacheca principale*****/

function pic_post(input) {

    if ($('#pic_space').children(".img-thumbnail")) {

        $('#pic_space').children("br").remove();
        $('#pic_space').children(".img-thumbnail").remove();
        $('#discard_pic').css({"display":"none"});

    }

    if (input.files && input.files[0]) {

        type = input.files[0].type;

        res = type.match(/\b(image\/jpg|image\/jpeg|image\/png|image\/bmp)\b/);

        if(res != null){

            var reader = new FileReader();

            var img = "<br><br><img id='pic_src' src='#' class='img-thumbnail' height='200' width='200'/><br><br>";

            $('#pic_space').append(img);

            $('#discard_pic').css({"display":"inline-block"});

            reader.onload = function(e) {
                $("#pic_src").attr("src", e.target.result); 
            }                                                                                               

            reader.readAsDataURL(input.files[0]);

            $('#input_mask button[type="submit"]').prop('disabled', false);


        }else{

            alert("Only .jpg, .jpeg, .png, .bmp files are allowed");
        }
    }
}

/*****Pulsante scarta immagine post*****/

$("#discard_pic").on('click',function(){
    $('#pic_space').children("br").remove();
    $('#pic_space').children(".img-thumbnail").remove();
    $('#discard_pic').css({"display":"none"});
    $('#pic_post').val("");

    if ($('#body_post').val() || $("#link_post").val()){

        $('#input_mask button[type="submit"]').prop('disabled', false);

    }else{

        $('#input_mask button[type="submit"]').prop('disabled', true);

    }

});

$("#pic_post").change(function() {
    pic_post(this);
});


/*****Anteprima immagine gruppi*****/

function group_pic(input) {

    if ($('#pic_space').children(".img-thumbnail")) {

        $('#pic_space').children("br").remove();
        $('#pic_space').children(".img-thumbnail").remove();
        $('#discard_pic_group').css({"display":"none"});

    }

    if (input.files && input.files[0]) {

        type = input.files[0].type;

        res = type.match(/\b(image\/jpg|image\/jpeg|image\/png|image\/bmp)\b/);

        if(res != null){

            var reader = new FileReader();

            var img = "<br><br><img id='pic_src' src='#' class='img-thumbnail' height='200' width='200'/><br><br>";

            $('#pic_space').append(img);

            $('#discard_pic_group').css({"display":"inline-block"});

            reader.onload = function(e) {
                $("#pic_src").attr("src", e.target.result); 
            }                                                                                               

            reader.readAsDataURL(input.files[0]);

        }else{

            alert("Only .jpg, .jpeg, .png, .bmp files are allowed");
        }
    }
}

/*****Pulsante scarta immagine gruppi*****/

$("#discard_pic_group").on('click',function(){
    $('#pic_space').children("br").remove();
    $('#pic_space').children(".img-thumbnail").remove();
    $('#discard_pic_group').css({"display":"none"});
    $('#group_pic').val("");

});

$("#group_pic").change(function() {
    group_pic(this);
});


/****Iscrizione ad altri gruppi presenti nella barra laterale*****/

$("[id*='other_']").on('submit',function(e){

    e.preventDefault();

    var id = $(this).attr('id');

    var arr = id.split("_");

    var group_id = arr[arr.length-1];

    $.ajax({

        type: "GET",
        url: "/user/new_group/"+group_id,
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

    var res;

    res = check($('#body_post').val(),$("#pic_post")[0].files[0],$("#link_post").val());

    if (res == -1){

        var body = addNewlines($('#body_post').val());

        var link = addNewlines($('#link_post').val());

        var formData = new FormData();

        var id = $(this).attr('id');

        var arr = id.split("_");

        var group_id = arr[arr.length-1];

        formData.append('body_post', body);

        formData.append('pic_post', $('#pic_post')[0].files[0]);

        formData.append('link_post', link);

        formData.append('group_id', group_id);

        $.ajax({

            type: "POST",
            url: "/posts",
            data: formData,
            datatype: "json",
            contentType: false,
            processData: false,
            success: function(data){
                   
                $('#append_new_posts').load(location.href + " #append_new_posts");
                     
                $('#pic_post').val("");
                $('#body_post').val("");
                $('#link_post').val("");
                $('#pic_space').children("br").remove();
                $('#pic_space').children(".img-thumbnail").remove();
                $('#discard_pic').css({"display":"none"});
                $('#input_mask button[type="submit"]').prop('disabled', true);


                if ($("#errors_ajax").children()){

                    $("#errors_ajax").children().remove();

                }

            },

            error: function(data){

                var errors = data.responseJSON;

                if ($("#errors_ajax").children()){

                    $("#errors_ajax").children().remove();

                }

                $("#errors_ajax").append("<div class='alert alert-danger'><ul></ul></div>");

                for(var key in errors.errors){

                    $(".alert.alert-danger > ul").append("<li>"+errors.errors[key]+"</li>");
                }
                
            },

        });
    }

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

                            var comment = "<div id="+data.comments[i].id+"><br><img src='"+data.user[i].image+"' class='img-circle' height='30' width='30'/><B> "+data.comments[i].created_at+" <a href='/users/"+data.user[i].id+""+"'>"+data.user[i].name+" "+data.user[i].surname+"</a></B> has commented:<br>"+data.comments[i].body+"<br></div>";
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

                            var comment = "<div id="+data.comments[i].id+"><br><img src='"+data.user[i].image+"' class='img-circle' height='30' width='30'/><B> "+data.comments[i].created_at+" <a href='/users/"+data.user[i].id+""+"'>"+data.user[i].name+" "+data.user[i].surname+"</a></B> has commented:<br>"+data.comments[i].body+"<br></div>";
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

    var res = check_length(body.length);

    if (res == 1) {

        var body_full = addNewlines($('#body_comment_'+post_id).val());

    $.ajax({
        type: "POST",
        url: "/comments",
        data: {post_id:post_id,body:body_full},
        datatype: "json",
        success: function(data){
            console.log("Commenti: " + data.comment);
            var comment = "<div id="+data.comment.id+"><br><img src='"+data.user.image+"' class='img-circle' height='30' width='30'/><B> "+data.comment.created_at+" <a href='/users/"+data.user.id+""+"'>"+data.user.name+" "+data.user.surname+"</a></B> has commented:<br>"+data.comment.body+"<br></div>";
            $('#new_comment_'+post_id).append(comment);
            $('#body_comment_'+post_id).val("");
            $("[id*='Post_comment_']").prop('disabled', true);

            console.log("idi di chi fa il COMMENTO --> " + data.news.id);
            socket.emit('comment_news', {
                to: data.news.id
            }); 

            },
            
            error: function(data){

                var errors = data.responseJSON;

                if ($("#errors_ajax").children()){

                    $("#errors_ajax").children().remove();

                }

                $("#errors_ajax").append("<div class='alert alert-danger'><ul></ul></div>");

                for(var key in errors.errors){

                    $(".alert.alert-danger > ul").append("<li>"+errors.errors[key]+"</li>");
                }
                
            },

        });

    }
  
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
            console.log("HO MESSO UN MI PIACE");
            $('#append_new_posts').load(location.href + " #append_new_posts");
            socket.emit('like_news', {
                to: data.news.id
            });
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


/****Gestisce le varie richieste dell'utente nella bacheca di un gruppo*****/

$("#append_new_posts").on('click','button',function (e) {

    e.preventDefault();

    var name = $(this).attr('name');

    switch(name){

        case "answer":

            new_comment($(this).attr('id'));

        break;

        case "like":

            like_post($(this).attr('id'));

        break;

        case "dislike":

            delete_like($(this).attr('id'));

        break;

        case "modal_delete":

            $("#myModal").modal("show");

            $("[name='delete']").attr('id',$(this).attr('id'));

        break;

        case "delete":

            $("#myModal").modal("hide");

            delete_post($(this).attr('id'));

        break;

        case "dismiss_modal":

            $("#myModal").modal("hide");

        break;

        default:

            show_details($(this).attr('data-target'));

    }

});


/*****BACHECA HOME DELL'UTENTE*****/

/*****se gli input sono vuoti disabilita il pulsante di condivisione del post*****/

$("#input_mask").keyup(function() {

    if ($('#body_post').val() || $("#pic_post")[0].files[0] || $("#link_post").val()){

        $('#input_mask button[type="submit"]').prop('disabled', false);

    }else{

        $('#input_mask button[type="submit"]').prop('disabled', true);
    }

});

$("#close_post").on('click',function(e){

    $("#Mycollapse").collapse("hide");   

});

$("#body_post").on('click',function(e){

    $("#Mycollapse").collapse("show");   

});

/*****Convalida dei dati in input*****/

function check_pic_size(pic_size){

    var res;

    if (pic_size > 3145728){

        res = 0;

        alert("the files's dimensions must be under 3MB");

    }else{

        res = 1;

    }

    return res;

}

$("#link_post").keyup(function() {

    var link = $(this).val();

    var res = link.match(/\b(http:\/\/|https:\/\/|ftp:\/\/|www\.)\b([A-Za-z0-9]{2,}[.]){1,}\b(com|it|fr)\b(\/\w)*/);

    if (res==null){

        $("#link_post").css({"color":"#555","text-decoration": "none"});

    }else{

        $("#link_post").css({"color":"#5bc0de","text-decoration": "underline"});

    }

});

function addNewlines(str) {

    var result = '';

    while (str.length > 0) {

        result += str.substring(0, 50) + '<br>';
        str = str.substring(50);

    }

    return result;
}

function check_length(post_length){

    var res;

    if (post_length > 255){

        res = 0;

        alert("Input must contains max 255 characters");

    }else{

        res = 1;
    }

    return res;

}

/****la funzione check() prende in input come parametri tutti i possibili campi di input*****/

function check(post,pic,link){

    var check = [1,1,1];

    if (post){

        check[0] = check_length(post.length);
    }

    if (pic){

        check[1] = check_pic_size(pic.size);

    }

    if (link){

        check[2] = check_length(link.length);

    }

    var res = check.indexOf(0);

    return res;

}

/*****Crea un nuovo post nella home, prima di inviare le informazioni quest'ultime vengono convalidate*****/

$("#new_post").on('submit',function(e){

    e.preventDefault();

    var res;

    res = check($('#body_post').val(),$("#pic_post")[0].files[0],$("#link_post").val());

    if (res == -1) {

        var body = addNewlines($('#body_post').val());

        var link = addNewlines($('#link_post').val());
  
        var formData = new FormData();

        formData.append('body_post', body);

        formData.append('pic_post', $("#pic_post")[0].files[0]);

        formData.append('link_post', link);

        $.ajax({
            type: "POST",
            url: "/home/post",
            data: formData,
            datatype: "json",
            contentType: false,
            processData: false,
            success: function(data){
                $('#bacheca_posts').load(location.href + " #bacheca_posts");
                     
                $('#pic_post').val("");
                $('#body_post').val("");
                $('#link_post').val("");
                $('#pic_space').children("br").remove();
                $('#pic_space').children(".img-thumbnail").remove();
                $('#discard_pic').css({"display":"none"});
                $('#input_mask button[type="submit"]').prop('disabled', true);


                socket.emit('new_post', {
                    data: "chack new posts"
                });

                if ($("#errors_ajax").children()){

                    $("#errors_ajax").children().remove();

                }

            },

            error: function(data){

                var errors = data.responseJSON;

                if ($("#errors_ajax").children()){

                    $("#errors_ajax").children().remove();

                }

                $("#errors_ajax").append("<div class='alert alert-danger'><ul></ul></div>");

                for(var key in errors.errors){

                    $(".alert.alert-danger > ul").append("<li>"+errors.errors[key]+"</li>");
                }
                
            },

        });
    }

    /*fine if*/

});

/*****Like nei post della home*****/

function like_post_home(target) {

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    $.ajax({
        type : "POST",
        url : "/post/like",
        data : {id_post:post_id},
        dataTy : 'json',
        success:function(data) {
            console.log("Dati dei like di ritorno dal controller "+data.id);
            $('#bacheca_posts').load(location.href + " #bacheca_posts");
            socket.emit('like_news', {
                to: data.id
            });

        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
}

/*****Toglie il like ad un post nella home*****/

function delete_like_home(target) {

    var id = target;

    var arr = id.split("_");

    var post_id = arr[arr.length-1];

    $.ajax({
        type : "POST",
        url : "/post/dislike",
        data : {id_post:post_id},
        dataTy : 'json',
        success:function(data) {
            $('#bacheca_posts').load(location.href + " #bacheca_posts");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
}


/****Gestisce le varie richieste dell'utente nella bacheca dell' utente*****/

$("#bacheca_posts").on('click','button',function (e) {

    e.preventDefault();

    var name = $(this).attr('name');

    switch(name){

        case "answer":

            new_comment($(this).attr('id'));

        break;

        case "like":

            like_post_home($(this).attr('id'));

        break;

        case "dislike":

            delete_like_home($(this).attr('id'));

        break;

        case "modal_delete":

            $("#myModal").modal("show");

            $("[name='delete']").attr('id',$(this).attr('id'));

        break;

        case "delete":

            $("#myModal").modal("hide");

            delete_post($(this).attr('id'));

        break;

        case "dismiss_modal":

            $("#myModal").modal("hide");

        break;

        default:

            show_details($(this).attr('data-target'));
    }

});