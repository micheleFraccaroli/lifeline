@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <?php if(Auth::user()->image == '0'){?>
                    <a href="/users/{{ Auth::user()->id }}"><img src="{{URL::asset('/default-profile-image.png')}}" width="163" height="200"></a>
                <?php } else { ?>
                    <a href="/users/{{ Auth::user()->id }}"><img src="{{asset(Auth::user()->image)}}" height="200" width="163"></a>
                <?php } ?>
                <hr>
                {{ Auth::user()->name }}    
                {{ Auth::user()->surname }} <br>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default" id="post_page">
                <div class="panel-heading">Bacheca</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        Write your post!<hr>
                        <form class="form-horizontal" method="POST" action="{{ URL::to('/home/post') }}" enctype="multipart/form-data" id="post_form">

                            {{ csrf_field() }}

                            <input type="hidden" name="your_id" value="{{Auth::user()->id}}">
                            <input type="text" name="body_post">
                            <br>
                            <label for="Immagine gruppo">Aggiungi immagine al post</label>
                            <br>
                            <input type="file" id="photo" name="photo" accept="image/*"/>
                            <button type="submit" class="btn btn-primary">
                                Pubblica
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($totale)) { ?>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">  
                    <?php foreach ($totale as $p) { ?>
                            <div class="panel-body" id="posts_div">
                                {{$p->body}} - <strong>{{$p->name}} {{$p->surname}}</strong><br>
                                <?php if(!empty($p->photo)) { ?>
                                    <img id="show_group_pic" class = "img-responsive img-circle" src="{{$p->photo}}" height="200" width="200"/>
                                    <span class="custom-file-control"></span>
                                    <input type="hidden" name="group_pic_value"> 
                                <?php } ?>
                                <form class="form-horizontal" method="POST" action="{{ URL::to('/post/like') }}" enctype="multipart/form-data" id="like_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_post" value="{{$p->id_post}}">
                                    <input type="hidden" name="id_utente" value="{{Auth::user()->id}}">
                                    <button type="submit" class="btn btn">
                                        Mi piace    
                                    </button>
                                </form>
                                <hr>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="container">

</div>

@endsection