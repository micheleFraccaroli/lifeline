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
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function select_id(id) {
            var identifier = "#conversa" + id;

            $.post('/conversations/create', {
                id_log: $('#id_utente_log').val(),
                id_other: $(identifier).val(),
                type: $('#tipo').val()
            },
            function(status){
                alert("Status: " + status);
            });
        }
    </script>

    <script>

    /* NON TOCCARE CI STO LAVORANDO SOPRA */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $("#aggiorna_gruppi").click(function(){

                $.ajax({
                        method: "POST",
                        url: "/groups/index",
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
            $("#show_group_pic").attr("src", e.target.result); /* sull' evento onload leggo il contenuto */ 
            $("input[name*='group_pic_value']").val(e.target.result);
            }                                                                                               

            reader.readAsDataURL(input.files[0]);  /* ritorna il contenuto del file sotto forma di URL */
            $("input[name*='group_pic_value']").val(reader.readAsDataURL(input.files[0]));
            }
        }

        $("#group_pic").change(function() {
            readURL(this);
        });

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
