 $('#form_store_conversation').on('submit', function(e) {
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
            document.getElementById("id_conversation").value = data;
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
})

function add_id_other(id_other, my_id) {
    document.getElementById('id_other').value = id_other;
    socket.emit('receiver', {
        nick_receiver: id_other,
        my_identifier: my_id
    });
}