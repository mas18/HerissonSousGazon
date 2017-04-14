<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hérisson sous gazon</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        {{Html::style('css/style.css')}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-relative full-height">
            @if (Route::has('login'))
                <div class="navbar-top-right linksNav">
                    @if (Auth::check())
                        <a style="font-size:100%" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Déconnection
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a style="font-size:100%" href="{{ url('/login') }}">Connection</a>
                        <a style="font-size:100%" href="{{ url('/register') }}">Inscription</a>
                    @endif
                </div>
            @endif

            <div class="content" style="text-align:center">

                <!-- CAROUSEL -->
                <div class="container flex-center" style="width:50%">
                    <br>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active" >
                                {{ HTML::image('pictures\img1.jpg') }}
                            </div>

                            <div class="item">
                                {{ HTML::image('pictures\img2.jpg') }}
                            </div>

                            <div class="item">
                                {{ HTML::image('pictures\img3.jpg') }}
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Dernier</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>


                <!-- TITLE -->
                <div style="font-size:5vw;color:#2aabd2">Hérisson sous gazon</div>

                </br>

                <!-- HREF -->
                <div class="container flex-center ">
                <ul class="navbar-nav">
                    @if(Auth::user())
                    <li class="linksNav" style="list-style-type:none"><a style="font-size:1vw;" href="{{ url('/events') }}">Événements</a></li>
                    <li class="linksNav" style="list-style-type:none"><a style="font-size:1vw" href="{{ url('/profil') }}">Mon profile</a></li>
                    @endif
                    @if(Auth::user()  AND Auth::user()->level>0)
                         <li class="linksNav" style="list-style-type:none"><a style="font-size:1vw" href="{{ url('/user') }}">Gestion des utilisateurs</a></li>
                    @endif
                </ul>
                </div>


                <br/><br/>

                <!-- Text -->
                <div class="container flex-center">
                    <p style="font-size:1vw; font-weight: bold;">Bienvenue sur le site des inscriptions pour l'évènement Hérisson sous gazon dédié aux volontaires
                    Pour accéder au planning, veuillez vous connecter au site web.</p>
                </div>

            </div>
        </div>
    </body>
</html>
