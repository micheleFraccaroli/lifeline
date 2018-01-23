@extends('layouts.app')

@section('content')

<?php if(Auth::check()) { ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default homeImage">
                    <?php if(Auth::user()->image == '0' && Auth::user()->sex == 'M'){ ?>
                        <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{URL::asset('/default-profile-image-M.png')}}" alt="Profile Image"></a>
                    <?php } elseif (Auth::user()->image == '0' && Auth::user()->sex == 'F'){ ?>
                        <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{URL::asset('/default-profile-image-F.png')}}" alt="Profile Image"></a>
                    <?php } else { ?>
                        <a href="/users/{{ Auth::user()->id }}"><img class="photo" src="{{asset(Auth::user()->image)}}" alt="Profile Image"></a>
                    <?php } ?>
                    <div id="nick"> 
                        {{ Auth::user()->name }}    
                        {{ Auth::user()->surname }}
                    </div>
                </div>
                <div class="panel panel-default homeGroups">
                    <div class="panel-heading">Friends</div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default"> 

                    <ul class="list-group">
                        <?php
                        foreach ($users as $usr) { ?>
                            <li class="list-group-item">
                                <img src="{{$usr['image']}}" class='img-circle' height='30' width='30'/>
                                <a href="/users/{{$usr['id']}}">{{$usr['name']}} {{$usr['surname']}}</a>
                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </div>

        </div>
    </div>
<?php } else {
    header('Location: ' . route('login'));
    die();
} ?>

@endsection