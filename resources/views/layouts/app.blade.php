<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/Alveare.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('/favicon_real.png')}}" type="image/x-icon">

</head>
<body id="principal_body">
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->

                    <a class="navbar-brand" href="/">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('register') }}" class="navigation">Sigup</a></li>

                        @else
                            <form class="navbar-form navbar-left" role="search" action="/search" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group add-on">
                                    <input class="form-control" placeholder="Cerca" name="srch-term" id="srch-term" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <li class="dropdown" id="notification_div">
                                <a id="fracca" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notifiche <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach(Auth::user()->unreadNotifications as $notification)
                                            @include('layouts.notifications.'.snake_case(class_basename($notification->type)))
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/contacts">Contatti</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                    <li>
                                        <a href="/users/{{ Auth::user()->id }}">Profile</a>
                                    </li>

                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('js/groups.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/conversation.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/friend.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/post.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/like.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/user.js') }}" type="text/javascript"></script>
</body>
</html>