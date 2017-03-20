<?php ?>

<html>
<head>
    <title>@yield('header_title')</title>
    @yield('script')
    {{Html::style('css/bootstrap/bootstrap.min.css')}}
    {{Html::style('css/bootstrap/bootstrap-theme.min.css')}}
</head>
<body>
<header>
    page header

</header>
<div id="main_content" class="">
    @yield('main_content')
</div>
<footer id="footer">
    page footer

</footer>
</body>
</html>
