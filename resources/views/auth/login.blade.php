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

<button id="pippo">
    Show/Hide
</button>

<div>
    <button><span id="pi">ciao bel!</span></button>
</div>
<button id="overlay">ciao</button>

<div class="container" id="chat">
    <div style="background-color: #000080;height: 25px;width: 100%;">
        <div style="width: 25px;height: 25px;position: absolute; top: 0;left: 350;margin: 0;padding: 0;"><span class="glyphicon glyphicon-resize-small" style="font-size: 25px;text-align: center;display: block;"></span></div>

        <div style="width: 25px;height: 25px;position: absolute; top: 0;left: 375;margin: 0;padding: 0;"><span class="glyphicon glyphicon-remove" style="font-size: 25px;text-align: center;display: block;"></span></div>
    </div>
        <div class="container" id="box" style="height: 315; width: 100%; position: absolute; left: 0; top: 25; background-color: #313131; border-bottom: 2px solid black; overflow-y: scroll; word-wrap: normal;"></div>
        <textarea id="text" class="scrollabletextbox" rows="2" name="message" style="width: 100%; resize: none; border: none; line-height: 30px; font-size: 20px; font-family: 'Times New Roman'; color: black; overflow: hidden; position: absolute; bottom: 0; background-color: #818181;"></textarea>
</div>
<div class="container" id="nomi">
</div>
<span id="caio" style="width: auto;">i</span>
@endsection
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

    var visible=true;
    $(document).ready(function(){

        var diff=$('#nomi').width()-$('#chat').width();
        
        $('#chat').css({"right":diff});

        var right=-($('#chat').position().left+$('#chat').outerWidth()-$(window).width());
        var chatW=$('#chat').outerWidth()+100;

        $('#pippo').click(function(){
            if (visible) {
                //$('#pippos').css("visibility","hidden");
                visible=false;
                $('#chat').animate({
                    right: right+chatW
                });
            }
            else {
                //$('#pippos').css("visibility","visible");
                $('#chat').animate({
                    right: right
                });
                visible=true;    
            }
        });

        $('#text').keyup(function(e) {
            var code=e.keyCode;
            var txt=$('#text').val();
            //txt=txt.replace(/(.{50})/g,"$1<br>");
            if(code==13 && !e.shiftKey){$('<span id="pippop" style="width: 300; word-break: keep-all; word-wrap: normal; display: inline-block">'+txt+'</span>').appendTo('#box');$('#text').val('');}//alert($('span:last-child').width());}
        });
    });/*
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