// $('#form_store_conversation').on('submit', function(e) {
//     e.preventDefault();
//     var data = $(this).serialize();
//     var url = $(this).attr('action');
//     var post = $(this).attr('method');

//     $.ajax({
//         type : post,
//         url : url,
//         data : data,
//         dataTy : 'json',
//         success:function(data) {
//             console.log(data);
//             document.getElementById("id_conversation").value = data;
//         },
//         error: function(xhr){
//             alert("An error occured: " + xhr.status + " " + xhr.statusText);
//         },
//     })
// })

function add_id_other(id_other, my_id, id_form,chat_name,flag) {

    console.log("ID OTHER::::::: "+id_other);

    //Richiesta AJAX al model per ritornare l'id di conversazione, se non esisteva, lo crea.
    $('#'+id_form).on('submit', function(e) {
    e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');

        $.ajax({
            type : post,
            url : url,
            data : data,
            dataTy : 'json',
            success:function(data) {    //data: id di conversazione
                console.log(data);
                $('#'+id_form+' input[name="id_conversation"]').val(data);
                crea(chat_name,id_other,$('#'+id_form+' input[name=id_conversation]').val(),my_id, flag);
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
        });
    });

    $('#'+id_form).submit();
    console.log("id_other--> " + id_other + " ||| my_id--> " + my_id);
}