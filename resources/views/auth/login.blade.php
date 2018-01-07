@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<button id="overlay">ciao</button>

<div class="container" id="chat">
    
    <div style="background-color: #000080;height: 25px;width: 100%;">
        <div onclick="resizeChat()" style="width: 25px;height: 25px;position: absolute; top: 0;left: 350;margin: 0;padding: 0;"><span class="glyphicon glyphicon-resize-small" style="font-size: 25px;text-align: center;display: block;"></span></div>

        <div onclick="closeChat();" style="width: 25px;height: 25px;position: absolute; top: 0;left: 375;margin: 0;padding: 0;"><span class="glyphicon glyphicon-remove" style="font-size: 25px;text-align: center;display: block;"></span></div>
    </div>

    <div id="bottoni" style="overflow: hidden; height: 25; width: 100%;"></div>

    <textarea id="text" class="scrollabletextbox" rows="2" name="message" style="width: 100%; resize: none; border: none; line-height: 30px; font-size: 20px; font-family: 'Times New Roman'; color: black; overflow: hidden; position: absolute; bottom: 0; background-color: #818181;"></textarea>
</div>

<div class="container" id="nomi" style="display: block; top: 50;">
    <p>        
        <div class="btn btn-primary" onclick="crea(this.innerText)">Matteo Gemelli</div>
    </p>
    <p>
        <div class="btn btn-primary" onclick="crea(this.innerText)">Michele Fraccaroli</div>
    </p>
    <p>
        <div class="btn btn-primary" onclick="crea(this.innerText)">Matteo Renzi</div>
    </p>
</div>

@endsection
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
      
    var containers=[];      //Insieme di tutte le chat
    var boxActive=null;     //Contenitore chat attivo da visualizzare
    var ChatStatus=false;   //false chiusa true aperta
    var right;              //Posizione iniziale della chat
    var chatW;              //Variabile di spostamento della chat
    var resiChat=false;
    var chatExp=null;

    $(document).ready(function(){

        var diff=$('#nomi').width()-$('#chat').width();
        
        $('#chat').css({"right":diff});

        right=-($('#chat').position().left+$('#chat').outerWidth()-$(window).width());
        chatW=$('#chat').outerWidth()+50;

        $('#text').keyup(function(e) {
            var code=e.keyCode;
            var txt=$('#text').val();

            if(code==13 && !e.shiftKey){$('<span id="pippop" style="width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">'+txt+'</span>').appendTo(boxActive);$('#text').val('');}
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
            $('#bottoni').append(element);
            $('#text').before(container);//'<div class="container" style="height: 290; width: 100%; position: absolute; left: 0; top: 50; background-color: #313131; border-bottom: 2px solid black; overflow-y: scroll; word-wrap: normal;"></div>');
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
            if($('#bottoni').children().length==0) {
                closeChat();
            }
        }

        function changeContext(text) {
            containers[text].css("visibility","visible");
            boxActive.css("visibility","hidden");
            boxActive=containers[text];
        }

        function openChat() {
            $('#chat').animate({
                    right: right+chatW
            });
        }

        function closeChat() {
            $('#chat').animate({
                    right: right
            });
        }

        function resizeChat() {

            if(!resiChat) {

                chatExp=$('#chat').clone();

                $('#chat').animate({
                        height: 40,
                        width: 40
                    },function(){
                            //$('#chat').replaceWith('<div id="chat" style="left: '+$('#chat').position().left+';" class="chatt"><span onclick="resizeChat()" style="position: absolute; font-size: 30; heigth=30; width:30; text-align: center;display: block; top: 5; left: 5;" class="glyphicon glyphicon-resize-full"></span></div>');
                            $(this).css("visibility","hidden");
                            $('<div id="icon" style="position: absolute; left: '+$('#chat').position().left+'; top: '+$('#chat').position().top+';"><span onclick="resizeChat()" style="position: absolute; font-size: 30; heigth=30; width:30; text-align: center;display: block; top: 5; left: 5;" class="glyphicon glyphicon-resize-full"></span></div>').appendTo($('body'))
                            resiChat=true;
                });
            }
            else {
                $('#chat').css("visibility","visible");
                $('#chat').animate({
                        height: 400,
                        width: 400
                    },function(){
                        $('#icon').remove();
                    });
                resiChat=false;
            }
        }
        /*
var arra=[];
    function do_resize(textbox) {

        var maxRows=4;
        var maxChar=24;
        var txt=textbox.value;
        var cols=textbox.cols;//alert($('#kekka').height()+' '+textbox.scrollHeight);
        var a=textbox.clientHeight;
        var b=textbox.scrollHeight;

alert(a+' '+b);
        if(a<b){ $('#kekka').css("height","80px");$('#kekka').attr("rows","2");}
        else if(b<a) $('#kekka').css("height",textbox.scrollHeight+"px");
/*        textbox.style.height=textbox.scrollHeight+"+px";
textbox.style.overflow="hidden";/*
        var arrayTxt=txt.split('\n');
        var rows=arrayTxt.length;

        textbox.rows=rows;

    }*/
</script>