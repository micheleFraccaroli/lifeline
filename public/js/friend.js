$('#friend_form_req').on('submit', function(e) {
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