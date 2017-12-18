@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="panel-body">
                        <h1>This is your data:</h1><br>
                        {{ Auth::user()->name }}<br>
                        {{ Auth::user()->surname }}<br>
                        {{ Auth::user()->email }}<br>
                        {{ Auth::user()->sex }}<br>
                        {{ Auth::user()->born }}<br>
                        {{ Auth::user()->job }}<br>
                        {{ Auth::user()->relation }}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
