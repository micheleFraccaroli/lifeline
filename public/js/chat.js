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

    console.log("Numero containers: " + $('#buttons').children().length);

    socket = io('http://localhost:65000');
    socket.on('new message', function(data){
        console.log("E QUA CI SONO "+ data.message);
        socket.emit('identified', {
            nickname: $('#id_user_logged').val()
        });
    });

    socket.on('mess', function(data){
        console.log("MESSAGGIO ----> " + data.body + "     "+ data.id_utente);
        //decrypt message from other socket
        var decryptedMess = CryptoJS.AES.decrypt(data.body, "testKey").toString(CryptoJS.enc.Utf8);

        var div=$('<span class="chatMex">' + decryptedMess+'</span>');

        div.css("float","right");
        div.css("background-color","#ddf");
        div.css("font-size",($('#buttons').height()/1.7)+'px');

        if(boxActive !== containers[data.id_utente]) {
            var suono=new Audio("Sonar.ogg");
            suono.play();
        }

        if(ChatIsOpen) {
            if(typeof containers[data.id_utente] === 'undefined') {
                console.log('creo tab');
                //add_id_other(data.id_utente,data.id_other,,data.chat_name,1);
                crea(data.chat_name, data.id_utente, data.id_conv, data.id_other, 1);
                $('#sound')[0].play();
            }

            div.css("clear","both");

            console.log("APP ULTIMO MESS " + containers[data.id_utente].children().length);
            containers[data.id_utente].append(div);
            $('.chat_div').scrollTop($('.chat_div')[0].scrollHeight);
        }
        else {
            console.log("DATA ID UTENET: " + data.id_utente);
            console.log("DATA ID ohter: " + data.id_other);

            //add_id_other(data.id_utente,data.id_other);

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

    var sb_button=new PerfectScrollbar('#buttons');

    $('#text').keyup(function(e) {
        var code=e.keyCode;
        

        if(code==13 && !e.shiftKey){
            var txt = $('#text').val();
            if(txt.indexOf("<")>-1 || txt.indexOf(">")>-1) {
                txt = "*** MESSAGE BLOCKED FOR HACKING ATTEMPT ***";
            }
            else if(txt.length == 1) {
                $('#text').val("");
                return;
            }
            console.log("LUNGHEZZA TESTO ----> " + txt.length);
            var div=$('<span class="chatMex">'+txt+'</span>');
            div.css("float","left");
            div.css("background-color","#dffddf");

            div.css("clear","both");
            div.css("font-size",($('#buttons').height()/1.7)+'px');

            div.appendTo(boxActive);$('#text').val('');
            boxActive.scrollTop(boxActive[0].scrollHeight);
                
            var id_conv=boxActive.id_conv;
            var id_user = $('#0 input[name=user_log]').val()

            var mess = txt;           
            var url = "/message/create";
            var method = "post";

            //encrypt message
            var encryptedAES = CryptoJS.AES.encrypt(mess, "testKey").toString() ;
            console.log("MESSAGGIO IN SCRITTURA ----> " + encryptedAES + " UTENTE " + id_user + " ID CONV " + id_conv);

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
    if(typeof containers[id_other] != 'undefined') {
        boxActive = containers[id_other];
    }
    else {
        var cont=$('<div></div>').addClass("btn-group");
        var element=$('<div></div>').addClass("btn btnName").text(text);
        var elementChild=$('<div></div>').addClass("btn btnX").text("X");

        element.css("font-size",($('#buttons').height()/1.7)+'px');
        elementChild.css("font-size",($('#buttons').height()/1.7)+'px');

        var container=$('<div></div>').addClass("chat_div");

        containers[id_other]=container;
        container.css("height",($('.chat').width()/100*72.5)+'px');
        container.css("top",$('#text').position().top-container.height());
        console.log("CONTAINER CONVERSATION ----> "+id_conv);
        container.id_conv=id_conv;

        cont.append(element);
        cont.append(elementChild);
        $('#buttons').append(cont);
        $('#text').before(container);

        element.click(changeContext.bind(null,id_other));

        var selectors=document.querySelectorAll(".chat_div");   //Seleziono tutti i container
        container.ps=new PerfectScrollbar(selectors[selectors.length-1]);           //Creo scrollbar al container

        if(flag == 0) {
            if(boxActive!=null) {
                boxActive.css("visibility","hidden");
                boxActive.buttonName.css("background-color","#aeeaae");
            }
            boxActive=container;
            boxActive.buttonName=element;
            element.css("background-color","#7bb77b");
        }
        else if(flag == 1 && $('#buttons').children().length == 1) {
            boxActive=container;
            boxActive.buttonName=element;
            element.css("background-color","#7bb77b");
        }
        else {
            container.css("visibility","hidden");
            container.buttonName=element;
        }

        elementChild.click(removeTab.bind(null,cont,container,id_other));
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

                div.css("clear","both");
                div.css("font-size",($('#buttons').height()/1.7)+'px');

                if(data[i].id_utente == id_other) {
                    div.css("float","right");
                    div.css("background-color","#ddf");
                    div.appendTo(containers[id_other]);

                    $('.chat_div').scrollTop($('.chat_div')[0].scrollHeight);

                }
                else {
                    div.css("float","left");
                    div.css("background-color","#dffddf");
                    div.appendTo(containers[id_other]);

                    $('.chat_div').scrollTop($('.chat_div')[0].scrollHeight);//console.log("Aggiunto: "+boxActive.children().last().css("background-color"));

                }
            }
            console.log("A PRESCINDERE " + containers[id_other].children().length);
        }
    });
}

//Funzione per rimuovere un tab dalla chat

function removeTab(element,container,id_other) {
    
    if($('#buttons').children().length==1) { //Se hai una tab unica rimuovi direttamente la chat
        closeChat();
    }
    else {                                   //Altrimenti rimuovi solo la tab interessata
        element.remove();
        container.remove();
        containers.splice(id_other,1);
        
        if(boxActive===container) {
            var index=Object.keys(containers);
            changeContext(index[index.length-1]);
        }
    }
}


function changeContext(id_other) {
    boxActive.buttonName.css("background-color","#aeeaae");
    boxActive.css("visibility","hidden");

    containers[id_other].css("visibility","visible");
    containers[id_other].buttonName.css("background-color","#7bb77b");

    boxActive=containers[id_other];

    $('#text').focus();
}

function openChat() {

    $('.chat').animate({
            left: lefts-$('.chat').width()-10
    }, function() {
        ChatIsOpen = true;
        $('#text').focus();
    });
    
}

function closeChat() {
    $('.chat').animate({
            left: lefts
    }, function() {
        ChatIsOpen = false;
        $('#buttons').empty();      //Elimino le tap
        $('.chat_div').remove();    //Elimino i contenitori chat
        containers=[];              //e l'array associato
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