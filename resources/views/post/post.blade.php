@extends('layouts.app')

@section('content')

{{Auth::user()->unreadNotifications->markAsRead()}}

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">  
                	<div class="panel-body" id="posts_div">
                		{{$post->body}} - <strong>{{$post->name}} {{$post->surname}}</strong>
                		<?php if(!empty($post->photo)) { ?>
                            <img id="show_group_pic" class = "img-responsive img-circle" src="{{$post->photo}}" height="200" width="200"/>
                            <span class="custom-file-control"></span>
                            <input type="hidden" name="group_pic_value"> 
                        <?php } ?>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection