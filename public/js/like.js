$("#like_div").on('submit', ".like_form" , function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var post = $(this).attr('method');
    alert(data);
    
    $.ajax({
        type : post,
        url : url,
        data : data,
        dataTy : 'json',
        success:function(data) {
            console.log("DOV È STA ROBA?"+data);
            $('#like_div').load(location.href + " #like_div");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
})

// $(document).ready(function() {

//     socket_like = io('http://localhost:3001');
//     socket_like.on('new message', function(data) {
//         socket_like.emit('user_identifier', {

//         });
//     });
// });