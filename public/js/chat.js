var containers=[];      //Insieme di tutte le chat
var boxActive=null;     //Contenitore chat attivo da visualizzare
var ChatStatus=false;   //false chiusa true aperta
var resiChat=false;
var chatExp=null;
var lefts;
var tops;
var socket;

$(document).ready(function(){

    socket = io('http://localhost:65000');
    socket.on('new message', function(data){
        console.log(data);
        socket.emit('identified', {
            nickname: $('#id_utente_log').val()
        });
    });

    socket.on('mess', function(data){
        console.log("MESSAGGIO ----> " + data.body + "     "+ data.id_utente);
        containers[data.id_utente].append('<span style="float: right; width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">' + data.body);
        $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
    });

    lefts=$(window).width()-$('.chat').width()+100;
    $('.chat').css("left",lefts);

    tops=window.innerHeight-$('.chat').height();
    $('.chat').css("top",tops);

    var nomiLeft=$(window).width()-$('.nomi').width();
    $('.nomi').css("left",nomiLeft);

    $('#text').keyup(function(e) {
        var code=e.keyCode;
        var txt = $('#text').val();

        if(code==13 && !e.shiftKey){
            $('<span style="width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">'+txt+'</span>').appendTo(boxActive);$('#text').val('');
            $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
            var id_conv = $('#id_conversation').val();
            var id_user = $('#id_utente_log').val();
            var mess = txt;           
            var url = "/message/create";
            var method = "post";

            $.ajax({
                type : method,
                url : url,
                data : {'id_conv': id_conv, 'id_user' : id_user, 'mess' : mess},
                dataTy : 'json',
                success:function(data) {
                    console.log(data);
                    socket.emit('chat message', {
                        body: data.body,
                        id_utente: data.id_utente
                    });
                }
            });
        }
    });

});

function crea(text, id_other, id_conv, my_id) {
    var element=$('<div></div>').addClass("btn btn-inverted").text(text);
    var elementChild=$('<div></div>').addClass("btn btn-primary").text("x");
    var container=$('<div></div>').addClass("container");
    container.attr("style","height: 290; width: 100%; position: absolute; left: 0; top: 50; background-color: #313131; border-bottom: 2px solid black; overflow-y: scroll; word-wrap: normal;");
    container.attr("id","chat_div");
    containers[id_other]=container;

    element.append(elementChild);
    $('#buttons').append(element);
    $('#text').before(container);
    element.click(changeContext.bind(null,id_other,my_id));
    
    if(boxActive!=null)boxActive.css("visibility","hidden");

    boxActive=container;

    elementChild.click(removeTab.bind(null,element));
    openChat();
    getMessage(id_conv, text, id_other);
}

function getMessage(id_conv, text, id_other) {
    $.ajax({
        type : 'POST',
        url : '/contacts/message/show',
        data : {'id_conversazione': id_conv},
        dataTy : 'json',
        success:function(data) {
            console.log(data);
            for(i=0; i<data.length; i++) {
                console.log(data[i]);
                if(data[i].id_utente == id_other) {
                    $('<span style="float: right; width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">'+data[i].body+'</span>').appendTo(boxActive);
                    $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
                }
                else {
                    $('<span style="float: left; width: 300; word-break: keep-all; word-wrap: normal; display: inline-block;">'+data[i].body+'</span>').appendTo(boxActive);
                    $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
                }
            }
        }
    });
}


function removeTab(e) {
    e.remove();
    if($('#buttons').children().length==0) {
        closeChat();
    }
}

function changeContext(id_other, my_id) {
    console.log("MIO ID DENTRO A CHANGE CONTEXT --->" + my_id);
    containers[id_other].css("visibility","visible");
    boxActive.css("visibility","hidden");
    boxActive=containers[id_other];
    socket.emit('change context', {
        nick_receiver: id_other,
        my_identifier: my_id
    });
}

function openChat() {
    $('.chat').animate({
            left: lefts-$('.chat').width()-10
    });
    
}

function closeChat() {
    $('.chat').animate({
            left: lefts
    });
}

function resizeChat() {

    if(!resiChat) {

        $('.chat').animate({
                height: 40,
                width: 40,
                left: $('.chat').position().left+360,
                top: $('.chat').position().top+360
            },function(){
                    //$('#chat').replaceWith('<div id="chat" style="left: '+$('#chat').position().left+';" class="chatt"><span onclick="resizeChat()" style="position: absolute; font-size: 30; heigth=30; width:30; text-align: center;display: block; top: 5; left: 5;" class="glyphicon glyphicon-resize-full"></span></div>');
                    $(this).css("visibility","hidden");
                    $('<div id="overlay" style="position: fixed; left: '+$('.chat').position().left+'; top: '+$('.chat').position().top+';"><span id="overlay" onclick="resizeChat()" style="position: absolute; font-size: 30; heigth=30; width:30; text-align: center;display: block; top: 5; left: 5;" class="glyphicon glyphicon-resize-full icon"></span></div>').appendTo($('body'))
                    resiChat=true;
        });
    }
    else {
        $('.chat').css("visibility","visible");
        $('.chat').animate({
                height: 400,
                width: 400,
                left: $('.chat').position().left-360,
                top: $('.chat').position().top-360
            },function(){
                $('.icon').remove();
            });
        resiChat=false;
    }
}