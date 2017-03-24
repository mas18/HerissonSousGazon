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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Accueil</a>
            <a class="navbar-brand" href="#">Evènements</a>
            <a class="navbar-brand" href="#">Mon profile</a>
            <a class="navbar-brand" href="#">Administration</a>

            <!-- Navbar: Register/Connection -->
            <ul class="nav navbar-nav navbar-right" style="font-size:18px">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
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
                        </ul>
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
