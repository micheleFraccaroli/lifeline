@section('chat')
<div class="container chat" id="overlay">
    
    <div>
        <div class="resizeChat" onclick="resizeChat()"><span class="glyphicon glyphicon-resize-small"></span></div>

        <div class="closeChat" onclick="closeChat();"><span class="glyphicon glyphicon-remove"></span></div>
    </div>

    <div id="buttons"></div>

    <textarea id="text" class="scrollabletextbox" rows="2" name="message"></textarea>
</div>

<div class="container nomi" id="overlay">
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