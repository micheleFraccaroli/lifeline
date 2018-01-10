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
            console.log(data);
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
            console.log(data);
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

function acceptRequest() {
    document.getElementById("type_request").value = 0;
    return;
}

function rejectRequest() {
    document.getElementById("type_request").value = 2;
    return;
}

$(document).ready(function() {
    setInterval(function() {
        $('#requester').load(location.href + " #requester");
    }, 5000);
});