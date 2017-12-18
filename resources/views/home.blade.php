@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Stato</div>

                <div class="panel-body text-right">
                    Test
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Gruppi</div>

                <div class="panel-body">
                    Gruppetti Fighetti
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
