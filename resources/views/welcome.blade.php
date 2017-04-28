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
        <header>
            @if (Route::has('login'))
            <!-- NavBar -->
            <nav class="navbar navbar-default navbar-toggleable-md navbar-light bg-faded" style="border:0; background-color: #fff;">
                <div class="container-fluid">
                    <div class="navbar-header" style="margin-left: 20px;">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::check())
                                <li class="linksNav"><a style="font-size:100%" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <li class="linksNav"><a style="font-size:100%" href="{{ url('/login') }}">Connexion</a></li>
                                <li class="linksNav"><a style="font-size:100%" href="{{ url('/register') }}">Créer un compte</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @endif
        </header>


            <div class="content" style="text-align:center; padding: 5px;">

                <!-- CAROUSEL -->
                <div class="container flex-center" style="width:75%">
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
                <div style="font-size:3em;">Hérisson sous gazon</div>

                </br>

                <!-- HREF -->
                <div class="container flex-center ">
                <ul class="navbar-nav">
                    @if(Auth::user())
                    <li class="linksNav" style="list-style-type:none"><a style="font-size:1em;" href="{{ url('/events') }}">Voir l'événement</a></li>
                    <li class="linksNav" style="list-style-type:none"><a style="font-size:1em" href="{{ url('/profil') }}">Mon profil</a></li>
                    @endif
                    @if(Auth::user()  AND Auth::user()->level>0)
                         <li class="linksNav" style="list-style-type:none"><a style="font-size:1em" href="{{ url('/user') }}">Gestion des bénévoles</a></li>
                    @endif
                    <li class="linksNav" style="list-style-type:none"><a style="font-size:1em" href="{{ url('/contact') }}">Contact</a></li>
                </ul>
                </div>


                <br/>

                <!-- Text -->
                <div class="container flex-center col-md-offset-2 col-sm-8">
                    <p style="font-size:1em; color:#2a88bd; font-weight: bold;">Bienvenue sur le site des inscriptions pour l'événement Hérisson sous gazon dédié aux bénévoles.
                    Pour accéder à l'évènement, veuillez vous connecter au site web.</p>
                </div>

            </div>
        </div>
    </body>
</html>
