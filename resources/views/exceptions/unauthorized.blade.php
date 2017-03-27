<?php ?>
@extends('layouts.template')
@section('header_title','Erreur')
@section('main_content')
    <h1 style="color: red">Vous n'êtes pas autorisé à accéder cette page</h1>

    <a class="" href="{{ route('/') }}"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></a>

    @endsection