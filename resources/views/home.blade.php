@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        <form class="form-horizontal" method="POST" action="{{ URL::to('/home/post') }}" enctype=multipart/form-data id="post_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="your_id" value="{{Auth::user()->id}}">
                            <input type="text" name="body_post">
                            <input type="file" name="photo">
                            <input type="submit" value="pubblica">
                        </form>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

@endsection
