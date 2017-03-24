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
    <nav class="navbar navbar-default" style="padding-top:30px">
        <div class="container-fluid linksNav">
            <a class="navbar-brand" href="{{ url('/') }}">Accueil</a>
            <a class="navbar-brand" href="#">Evènements</a>
            <a class="navbar-brand" href="#">Mon profile</a>
            <a class="navbar-brand" href="#">Administration</a>

            <!-- Navbar: Register/Connection -->
            <div class="navbar-right linksNav">
                <!-- Authentication Links -->
                @if (Auth::guest())

                    <a class="navbar-brand" href="{{ route('login') }}">Connection</a>
                    <a class="navbar-brand" href="{{ route('register') }}">Inscription</a>
                @else

                    <a class="navbar-brand" href="{{ route('logout') }}"
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
