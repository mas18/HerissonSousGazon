<?php ?>

<head>
    <title>@yield('header_title')</title>
    {{Html::style('css/bootstrap/bootstrap.min.css')}}
    {{Html::style('css/bootstrap/bootstrap-theme.min.css')}}
    {{Html::style('css/style.css')}}
</head>
<body>
<h1 class="container">@yield('exception')</h1>
</body>


