    var containers=[];      //Insieme di tutte le chat
    var boxActive=null;     //Contenitore chat attivo da visualizzare
    var ChatStatus=false;   //false chiusa true aperta
    var resiChat=false;
    var chatExp=null;
    var lefts;
    var tops;

    $(document).ready(function(){

        lefts=$(window).width()-$('.chat').width()+100;
        $('.chat').css("left",lefts);

        tops=window.innerHeight-$('.chat').height();
        $('.chat').css("top",tops);

        var nomiLeft=$(window).width()-$('.nomi').width();
        $('.nomi').css("left",nomiLeft);

        $('#text').keyup(function(e) {
            var code=e.keyCode;
            var txt=$('#text').val();

            if(code==13 && !e.shiftKey){$('<span style="width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">'+txt+'</span>').appendTo(boxActive);$('#text').val('');}
        });
    });
    function crea(text) {
          /*  var b=document.createElement("div");
            b.className="btn btn-inverted";
            var t=document.createTextNode(text);
            b.appendChild(t);*/
            //var element='<div id="nick" class="btn btn-inverted">'+text+'</div>';
            //var elementChild='<div class="btn btn-primary">x</div>';

            var element=$('<div></div>').addClass("btn btn-inverted").text(text);
            var elementChild=$('<div></div>').addClass("btn btn-primary").text("x");
            var container=$('<div></div>').addClass("container");
            container.attr("style","height: 290; width: 100%; position: absolute; left: 0; top: 50; background-color: #313131; border-bottom: 2px solid black; overflow-y: scroll; word-wrap: normal;");
            containers[text]=container;

            element.append(elementChild);
            $('#buttons').append(element);$('#fracca').append(container);
            //$('#text').before(container);
            element.click(changeContext.bind(null,text));
            
            if(boxActive!=null)boxActive.css("visibility","hidden");

            boxActive=container;

            /*c=document.createElement("div");
            c.className="btn btn-primary";
            t=document.createTextNode("x");
            c.appendChild(t);
            b.appendChild(c);*/
            //elementChild.addEventListener("click",annienta.bind(null,element));
            elementChild.click(removeTab.bind(null,element));
            openChat();
        }

        function removeTab(e) {
            e.remove();
            if($('#buttons').children().length==0) {
                closeChat();
            }
        }

        function changeContext(text) {
            containers[text].css("visibility","visible");
            boxActive.css("visibility","hidden");
            boxActive=containers[text];
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