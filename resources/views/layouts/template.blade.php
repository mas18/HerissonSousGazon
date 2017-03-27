<?php ?>

<html>
<head>
    <title>@yield('header_title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    {{Html::style('css/bootstrap/bootstrap.min.css')}}
    {{Html::style('css/bootstrap/bootstrap-theme.min.css')}}
    {{Html::style('css/style.css')}}

    <!-- script -->
    {{Html::style('js/app.js')}}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>


<body>
<header>
    <!-- NavBar -->
    <nav class="navbar navbar-default" style="padding-top:15px">
        <div class="container-fluid linksNav">
            <a style="font-size:80%" href="{{ url('/') }}">Accueil</a>
            <a style="font-size:80%" href="{{ url('/events') }}">Evènements</a>
            <a style="font-size:80%" href="{{ url('/profil') }}">Mon profile</a>
            <a style="font-size:80%" href="#">Administration</a>

            <!-- Navbar: Register/Connection -->
            <div class="navbar-right linksNav">
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
    </nav>
</header>


<!-- Content of the page -->
<div id="main_content" class="container">
    @yield('main_content')
</div>


<footer>
    <div class="navbar navbar-default navbar-fixed-bottom footerDiv">footer body</div>
</footer>

</body>
</html>
