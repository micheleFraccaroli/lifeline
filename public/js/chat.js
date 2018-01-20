var containers=[];      //Insieme di tutte le chat
var boxActive=null;     //Contenitore chat attivo da visualizzare
var ChatStatus=false;   //false chiusa true aperta
var resiChat=false;
var chatExp=null;
var lefts;
var tops;
var socket;
var chatResizeDim;
var chatInitDim;
var ChatIsOpen = false;

$(document).ready(function(){

    console.log("Numero containers: " + $('#buttons').children().length);

    socket = io('http://localhost:65000');
    socket.on('new message', function(data){
        console.log("E QUA CI SONO "+ data.message);
        socket.emit('identified', {
            nickname: $('#id_utente_log').val()
        });
    });

    socket.on('mess', function(data){
        console.log("MESSAGGIO ----> " + data.body + "     "+ data.id_utente);
        //decrypt message from other socket
        var decryptedMess = CryptoJS.AES.decrypt(data.body, "testKey").toString(CryptoJS.enc.Utf8);

        var div=$('<span class="chatMex">' + decryptedMess+'</span>');

        div.css("float","right");
        div.css("background-color","#ddf");

        if(ChatIsOpen) {
            if(typeof containers[data.id_utente] === 'undefined') {
                console.log('creo tab');
                crea(data.chat_name, data.id_utente, data.id_conv, data.id_other, 1);
            }

            if(containers[data.id_utente].children().length>2) {console.log("Ci sono messaggi!!!!");
                div.css("clear",containers[data.id_utente].children().last().css("float"));
            }

            console.log("APP ULTIMO MESS " + containers[data.id_utente].children().length);
            containers[data.id_utente].append(div);
            $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
        }
        else {
            console.log("DATA ID UTENET: " + data.id_utente);
            console.log("DATA ID ohter: " + data.id_other);
            document.getElementById('id_conversation').value = data.id_conv;
            crea(data.chat_name, data.id_utente, data.id_conv, data.id_other, 1);
            console.log("NUM FIGLI DI CONTAINRS DATA " + containers[data.id_utente].children().length);
        }
    });

    lefts=$(window).width()-$('.nomi').width();  //left del container nomi
    $('.nomi').css("left",lefts);
    $('.chat').css("left",lefts);

    $('.chat').css("height",$('.chat').css("width")); //l'altezza della chat corrisponde alla sua lunghezza (default 10% della pagina)

    chatInitDim=$('.chat').width();          //Dimensione iniziale
    chatResizeDim=$('.chat').width()/100*90; //Dimensione di ridimensionamento

    $('.chat > div > span').css("font-size",($('.chat').width()/100*6.25)+'px'); //Font-size delle icone chat

    tops=window.innerHeight-$('.chat').height();
    $('.chat').css("top",tops);
    
    $('#buttons').css("top",($('.chat > div').position().top+($('.chat').width()/100*6.25)));
    
    $('#text').css("line-height",($('.chat').width()/100*7.5)+'px');
    $('#text').css("font-size",($('.chat').width()/100*5)+'px');

    $('#text').keyup(function(e) {
        var code=e.keyCode;
        var txt = $('#text').val();

        if(code==13 && !e.shiftKey){
            var div=$('<span class="chatMex">'+txt+'</span>');
            div.css("float","left");
            div.css("background-color","#dffddf");
            
            console.log("DIV MESS DI RISPOSTA ---> " + boxActive.children().length);

            if(boxActive.children().length>2) {
                        div.css("clear",boxActive.children().last().css("float"));
            }

            div.appendTo(boxActive);$('#text').val('');
            $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
            
            var id_conv = $('#id_conversation').val();
            var id_user = $('#id_utente_log').val();
            var mess = txt;           
            var url = "/message/create";
            var method = "post";

            //encrypt message
            var encryptedAES = CryptoJS.AES.encrypt(mess, "testKey").toString() ;
            console.log("MESSAGGIO IN SCRITTURA ----> " + encryptedAES + " UTENTE " + id_user + " ID CONV " + id_conv);
            console.log("ID_CONV NELLA SCRITTURA --------->" + id_conv);
            $.ajax({
                type : method,
                url : url,
                data : {'id_conv': id_conv, 'id_user' : id_user, 'mess' : encryptedAES},
                dataTy : 'json',
                success:function(data) {
                    console.log("MESSAGGIO IN RICEZIONE ____ " + data.name_receiver);
                    console.log("MESSAGGIO scritto ____ " + data.body);
                    console.log("MESSAGGIO ID OTHER ____ " + data.id_receiver);
                    console.log("MESSAGGIO ID UTENTE ____ " + data.id_utente);
                    socket.emit('chat message', {
                        body: data.body,
                        chat_name:  data.name_receiver,
                        id_other: data.id_receiver,
                        id_conv: data.id_conversazione,
                        id_utente: data.id_utente
                    });
                }
            });
        }
    });
});

//flag serve per vedere s la chat è creata da un click dell'utente o dall'arrivo di un nuovo messaggio
function crea(text, id_other,id_conv, my_id, flag) {    
    document.getElementById("id_conversation").value = id_conv;
    if(typeof containers[id_other] != 'undefined') {
        boxActive = containers[id_other];
    }
    else {
        var element=$('<div></div>').addClass("btn btnName").text(text);
        var elementChild=$('<div></div>').addClass("btn btnX").text("X");
        var container=$('<div></div>').addClass("container");
        
        container.attr("id","chat_div");
        containers[id_other]=container;
        container.css("height",($('.chat').width()/100*72.5)+'px');
        container.css("top",$('#text').position().top-container.height());
        container.idU=id_other;

        element.append(elementChild);
        $('#buttons').append(element);
        $('#text').before(container);
        element.click(changeContext.bind(null,id_other,my_id, id_conv));

        var ps=new PerfectScrollbar('#chat_div'); //Creo scrollbar al container creando due figli

        if(flag == 0) {
            if(boxActive!=null)boxActive.css("visibility","hidden");
            boxActive=container;
        }
        else if(flag == 1 && $('#buttons').children().length == 1) {
            boxActive=container;
        }

        elementChild.click(removeTab.bind(null,element));
        getMessage(id_conv, text, id_other);
    }

    openChat();
}

function getMessage(id_conv, text, id_other) {
    console.log("Numero containers: " + $('#buttons').children().length);

    $.ajax({
        type : 'POST',
        url : '/contacts/message/show',
        data : {'id_conversazione': id_conv},
        dataTy : 'json',
        success:function(data) {
            var div; //Variabile contenitore del messaggio
            for(i=0; i<data.length; i++) {
                //decrypt message from database
                var decryptedMessages = CryptoJS.AES.decrypt(data[i].body, "testKey").toString(CryptoJS.enc.Utf8);

                console.log("MEAASGGIIIII --> " + decryptedMessages);

                div=$('<span class="chatMex">'+decryptedMessages+'</span>');
                    
                //console.log("Numero figli: "+boxActive.children().length);
                if(containers[id_other].children().length>2) {//console.log(boxActive.children().last().css("float"));
                        div.css("clear",containers[id_other].children().last().css("float"));
                }

                if(data[i].id_utente == id_other) {
                    div.css("float","right");
                    div.css("background-color","#ddf");
                    div.appendTo(containers[id_other]);
                    $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);
                }
                else {
                    div.css("float","left");
                    div.css("background-color","#dffddf");
                    div.appendTo(containers[id_other]);
                    $("#chat_div").scrollTop($("#chat_div")[0].scrollHeight);//console.log("Aggiunto: "+boxActive.children().last().css("background-color"));
                }
            }
            console.log("A PRESCINDERE " + containers[id_other].children().length);
        }
    });
}

//Funzione per rimuovere un tab dalla chat

function removeTab(e) {
    e.remove();
    if($('#buttons').children().length==0) {
        closeChat();
    }
}

function changeContext(id_other, my_id, id_conv) {
    console.log("MIO ID DENTRO A CHANGE CONTEXT --->" + id_other + " MY _ID -->" + my_id);
    console.log("ID CONV DENTRO A CHANGE CONTEXT --->" + id_conv);
    containers[id_other].css("visibility","visible");

    boxActive.css("visibility","hidden");
    boxActive=containers[id_other];

    // socket.emit('change context', {
    //     nick_receiver: id_other,
    //     my_identifier: my_id
    // });
}

function openChat() {
    $('.chat').animate({
            left: lefts-$('.chat').width()-10
    }, function() {
        ChatIsOpen = true;
    });
    
}

function closeChat() {
    $('.chat').animate({
            left: lefts
    }, function() {
        ChatIsOpen = false;
    });
}

function resizeChat() {

    if(!resiChat) {

        $('.chat').animate({
                height: chatInitDim/10,
                width: chatInitDim/10,
                left: $('.chat').position().left+chatResizeDim,
                top: $('.chat').position().top+chatResizeDim
            },function(){
                    $(this).css("visibility","hidden");
                    $('<div style="position: fixed; left: '+$(this).position().left+'; top: '+$(this).position().top+';"><span id="overlay" onclick="resizeChat()" class="glyphicon glyphicon-resize-full icon"></span></div>').appendTo($('body'))
                    $('.icon').css("font-size",(chatInitDim/10)+'px');
                    resiChat=true;
        });
    }
    else {
        $('.chat').css("visibility","visible");
        $('.chat').animate({
                height: chatInitDim,
                width: chatInitDim,
                left: $('.chat').position().left-chatResizeDim,
                top: $('.chat').position().top-chatResizeDim
            },function(){
                $('.icon').remove();
                resiChat=false;
            });
    }
}