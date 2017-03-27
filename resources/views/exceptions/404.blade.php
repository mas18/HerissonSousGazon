<?php ?>

@extends('layouts.template')
@section('header_title','Erreur')
@section('main_content')
    <h1 style="color: red">Page non trouvée...</h1>
    <h1>
        {{ Html::link('/home', 'Retour')}}
    </h1>

@endsection