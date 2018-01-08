$("#like_div").on('submit', ".like_form" , function(e) {
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
            $('#like_div').load(location.href + " #like_div");
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
})