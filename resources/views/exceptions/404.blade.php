<?php ?>

@extends('layouts.template')
@section('header_title','Erreur')
@section('main_content')
    <h1 style="color: red">Page non trouvée...</h1>

    <a href="{{ route('/home') }}">Login</a>
@endsection