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
    {{Html::style('css/style.css')}}

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>


<body>
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
                    <li class="linksNav"><a style="font-size:80%" href="{{ url('/events') }}">Évènements</a></li>
                    @if(Auth::user())
                        <li class="linksNav"><a style="font-size:80%" href="{{ url('/profil') }}">Mon profile</a></li>
                    @endif
                    @if ( Auth::user() AND Auth::user()->level>0)
                        <li class="linksNav">
                            <a style="font-size:80%" href="{{ url('/user') }}">Gestion des utilisateurs</a>
                        </li>
                    @endif

            </ul>
            <!-- Navbar: Register/Connection -->
            <div class="nav navbar-right linksNav" style="padding-top:15px">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <a style="font-size:80%" href="{{ route('login') }}">Connection</a>
                    <a style="font-size:80%" href="{{ route('register') }}">Inscription</a>
                @else

                    <a style="font-size:80%" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Déconnection
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
<div id="main_content" class="container">
    @yield('main_content')
</div>

<div style="margin-top:200px">

    {{ HTML::image('pictures\footerHerbe.png', 'This is an image', ['class' => 'img-fluid img-responsive'])}}

</div>

</body>
</html>
