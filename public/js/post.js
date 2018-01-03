$('#post_form').on('submit', function(e) {
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
            var post_div = document.createElement('div');
            var hr = document.createElement('hr');
            post_div.className = 'panel-body';
            if(data.photo == 0) {
                post_div.appendChild(hr);
                post_div.appendChild(document.createTextNode(data.body));
            }
            else {
                //...ci guarderò!
            }
            document.getElementById('post_page').appendChild(post_div);
            document.getElementById('post_form').reset();
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
    })
})