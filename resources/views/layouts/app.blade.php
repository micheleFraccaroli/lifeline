<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

</head>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <form class="navbar-form" role="search" action="/search" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group add-on">
                                <input class="form-control" placeholder="Cerca" name="srch-term" id="srch-term" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                      </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
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
    <script src = "{{ asset('js/groups.js') }}" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- per le richieste d'amicizia-->
    <script>
        $('#friend_form_req').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type : post,
                url : url,
                data : data,
                dataTy : 'json',
                success:function(data) {
                    console.log(data);
                    $('#requester').load(document.URL + ' #requester');
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },
            })
        })

        $('#friend_form_del').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type : post,
                url : url,
                data : data,
                dataTy : 'json',
                success:function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },
            })
        })
    </script>
    <!-- -->
    <script>
        $('#post_form').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type : post,
                url : url,
                data : data,
                dataTy : 'json',
                success:function(data) {
                    console.log(data);
                    var post_div = document.createElement('div');
                    var hr = document.createElement('hr');
                    post_div.className = 'panel-body';
                    if(data.photo == 0) {
                        post_div.appendChild(hr);
                        post_div.appendChild(document.createTextNode(data.body));
                    }
                    else {
                        //...ci guardarò!
                    }
                    document.getElementById('post_page').appendChild(post_div);
                    document.getElementById('post_form').reset();
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },
            })
        })
    </script>
    
    <script>
        $('#form_store_conversation').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type : post,
                url : url,
                data : data,
                dataTy : 'json',
                success:function(data) {
                    console.log(data);
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                },
            })
        })

        function add_id_other(id) {
            document.getElementById('id_other').value = id;
        }
    </script>

    <script>
    // Parte Fracca **************************************************************************

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $("#aggiorna_users").click(function(){

                $.ajax({
                        method: "POST",
                        url: "/users/index",
                        data: "",
                        dataType: "json",
                        success: function(data){
                            console.log(data.response);
                        },
                        error: function(xhr){
                            alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    },

                });

            });
        });

        /*La funzione ReadURL viene utilizzata per mostrare l'immagine in anteprima nel form relativo
        alla creazione del gruppo o per la modifica*/
        function readURL(input) {

            if (input.files && input.files[0]) {
            var reader = new FileReader();                 /* vado ad instanziare l'oggetto FileReader */

            reader.onload = function(e) {
                $("#show_users_pic").attr("src", e.target.result); /* sull' evento onload leggo il contenuto */ 
                $("input[name*='user_pic_value']").val(e.target.result);
            }                                                                                               

            reader.readAsDataURL(input.files[0]);  /* ritorna il contenuto del file sotto forma di URL */
                $("input[name*='user_pic_value']").val(reader.readAsDataURL(input.files[0]));
            }
        }

        $("#user_pic").change(function() {
            readURL(this);
        });

    </script>
</body>
</html>