<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <link href="{{ asset('css/Alveare.css') }}" rel="stylesheet">

    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet">

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
                        <img src="{{asset('/favicon_real.png')}}" height='35' width='35' style="margin-top: -6px;">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('register') }}" class="navigation">Sign up</a></li>

                        @else
                            <form class="navbar-form navbar-left" role="search" action="/search" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group add-on">
                                    <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text" required oninvalid="this.setCustomValidity('This field can not be empty')" oninput="setCustomValidity('')">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><img src="{{URL::asset('/search-image.png')}}" width="21" height="20"></button>
                                    </div>
                                </div>
                            </form>
                        
                            <li class="dropdown" id="notification_div">
                                <a id="fracca" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">News <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach(Auth::user()->unreadNotifications as $notification)
                                            @include('layouts.notifications.'.snake_case(class_basename($notification->type)))
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/friends">Friends</a>
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
                                    <li>
                                        <a href="/activity/{{ Auth::user()->id }}">Activity</a>
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

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            if(window.location.pathname=='/login'){
                $(document.body).addClass('login');
            }
            else{
                $(document.body).removeClass('login');   
            }
        });
    </script>
    <!-- <script src="http://localhost:65000/socket.io/socket.io.js"></script>
    <script src="http://localhost:65001/socket.io/socket.io.js"></script> -->
    <script src="{{asset('js/perfect-scrollbar.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/app.js') }}"></script>
    <script src="{{asset('js/aes.js') }}"></script>
    <script src="{{asset('js/chat.js') }}"></script>
    <script src="{{asset('js/user.js') }}"></script>
    <script src="{{asset('js/groups.js') }}"></script>
    <script src="{{asset('js/friend.js') }}"></script>
    <script src="{{asset('js/like.js') }}"></script>
    <script src="{{asset('js/modal_image.js') }}"></script>
</body>
</html>