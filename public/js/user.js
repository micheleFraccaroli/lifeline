$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $("#aggiorna_users").click(function(){

        $.ajax({
                method: "POST",
                url: "/users/index",
                data: "",
                dataType: "json",
                success: function(data){
                    console.log(data.response);
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
            },

        });

    });
});

/*La funzione ReadURL viene utilizzata per mostrare l'immagine in anteprima nel form relativo
alla creazione del gruppo o per la modifica*/
function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();                 /* vado ad instanziare l'oggetto FileReader */

    reader.onload = function(e) {
        $("#show_users_pic").attr("src", e.target.result); /* sull' evento onload leggo il contenuto */ 
        $("input[name*='user_pic_value']").val(e.target.result);
    }                                                                                               

    reader.readAsDataURL(input.files[0]);  /* ritorna il contenuto del file sotto forma di URL */
        $("input[name*='user_pic_value']").val(reader.readAsDataURL(input.files[0]));
    }
}

$("#user_pic").change(function() {
    readURL(this);
});


$(document).ready(function() {
    setInterval(function() {
        $('#notification_div').load(location.href + " #notification_div>*")}, 5000);
        
});