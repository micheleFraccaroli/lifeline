$(document).ready(function() {

    socket = io('http://localhost:65001');
    socket.on('new message', function(data){
        console.log("nel new message" + data);
        console.log("nel new message ---->" + $('#id_utente_log').val());
        
        socket.emit('friend_identified', {
            my_id: $('#id_utente_log').val()
        });
    });

    $('#requester').on('submit','#friend_form_req' , function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');

        $.ajax({
            type : post,
            url : url,
            data : data,
            dataTy : 'json',
            success:function(data) {
                console.log("Richiesta di amicizia----> " + data.id);
                socket.emit('friend_request', {
                    user_requester: data.id_utente1,
                    user_receiver: data.id_utente2,
                });
                $('#requester').load(location.href + " #requester");
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
        })
    })

    $('#requester').on('submit','#friend_form_resp' , function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');

        $.ajax({
            type : post,
            url : url,
            data : data,
            dataTy : 'json',
            success:function(data) {
                console.log("risposta: " + data);
                socket.emit('friend_response', {
                    user_resp_receiver: data
                });
                $('#requester').load(location.href + " #requester");
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
        })
    })


    $('#requester').on('submit','#friend_form_del', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var post = $(this).attr('method');

        $.ajax({
            type : post,
            url : url,
            data : data,
            dataTy : 'json',
            success:function(data) {
                console.log(data);
                $('#requester').load(document.URL + ' #requester');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },
        })
    })

    $(document).ready(function() {
        socket.on('send_fr_req', function(data) {
            console.log(data);
            $('#requester').load(location.href + " #requester");
        });
        
        socket.on('friend_resp', function(data) {
            console.log(data);
            $('#requester').load(location.href + " #requester");
        });
    });
});

function acceptRequest() {
    document.getElementById("type_request").value = 0;
    return;
}

function rejectRequest() {
    document.getElementById("type_request").value = 2;
    return;
}