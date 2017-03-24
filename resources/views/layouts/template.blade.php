<?php ?>

<html>
<head>
    <title>@yield('header_title')</title>
    {{Html::style('css/bootstrap/bootstrap.min.css')}}
    {{Html::style('css/bootstrap/bootstrap-theme.min.css')}}
    {{Html::style('css/style.css')}}
</head>


<body>
<header>
    <!-- NavBar -->
    <nav class="navbar navbar-default" style="padding-top:30px">
        <div class="container-fluid linksNav">
            <a class="navbar-brand" href="#">Accueil</a>
            <a class="navbar-brand" href="#">Evènements</a>
            <a class="navbar-brand" href="#">Mon profile</a>
            <a class="navbar-brand" href="#">Administration</a>

            <!-- Navbar: Register/Connection -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="linksNav"><a class="navbar-brand" href="{{ route('login') }}">Login</a></li>
                    <li class="linksNav"><a class="navbar-brand" href="{{ route('register') }}">Register</a></li>
                @else

                    <li class="linksNav">
                        <a class="navbar-brand" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
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

<script type="text/javascript" src="js/bootstrap.js/bootstrap.min.js">
</script>

</body>
</html>
