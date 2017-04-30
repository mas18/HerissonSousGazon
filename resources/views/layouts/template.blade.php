<?php ?>

<html>
<head>
    <title>@yield('header_title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link href="//code.jquery.com/jquery-1.10.2.min.js" rel="stylesheet">
    {{Html::style('css/bootstrap/bootstrap.min.css')}}
    {{Html::style('css/bootstrap/bootstrap-theme.min.css')}}
    {{Html::style('css/circle.css')}}

    <link href="../addons/bootstrap/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{Html::style('css/style.css')}}

    <script>

        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>


<body style="height: auto; background: url('{{ asset('pictures/footerHerbe.PNG') }}') repeat-x bottom; background-size: auto 60px;">
<header>


    <!-- NavBar -->
    <nav class="navbar navbar-default navbar-toggleable-md navbar-light bg-faded">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="linksNav"><a style="font-size:80%" href="{{ url('/') }}">Accueil</a></li>
                    <li class="linksNav"><a style="font-size:80%" href="{{ url('/events') }}">Voir l'événement</a></li>
                    @if(Auth::user())
                        <li class="linksNav"><a style="font-size:80%" href="{{ url('/profil') }}">Mon profil</a></li>
                    @endif
                    @if ( Auth::user() AND Auth::user()->level>0)
                        <li class="linksNav">
                            <a style="font-size:80%" href="{{ url('/user') }}">Gestion des bénévoles</a>
                        </li>
                    @endif
                    <li class="linksNav"><a style="font-size:80%" href="{{ url('/contact') }}">Contact</a></li>

            </ul>
            <!-- Navbar: Register/Connection -->
            <div class="nav navbar-right linksNav" style="padding-top:15px">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <a style="font-size:80%" href="{{ route('login') }}">Connexion</a>
                    <a style="font-size:80%" href="{{ route('register') }}">Créer un compte</a>
                @else

                    <a style="font-size:80%" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </div>



        </div>
    </nav>
</header>


<!-- Content of the page -->
<div id="main_content" class="container" style="position: relative; margin-bottom:100px;">
    @yield('main_content')
</div>



<div id="footer">
</div>


</body>
<script>
    console.log("Bonjour visiteur, ce site a été créer par Christophe Crettenand, Sandro Mathier et Clothilde Rieille.");
</script>




</html>

