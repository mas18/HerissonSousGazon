<?php ?>

@extends('layouts.template')
@section('header_title','page test')
@section('main_content')
    <div class="container">Middle text</div>



    <div class="dropdown col-md-3">
        <button class="btn btn-default dropdown-toggle" type="button" id="menuVolunteers" data-toggle="dropdown">Volunteers
            <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menuVolunteers">
            <li role="presentation"><a role="menuitem" >Volunteers1</a></li>
            <li role="presentation"><a role="menuitem" >Volunteers2</a></li>
            <li role="presentation"><a role="menuitem" >Volunteers3</a></li>
        </ul>
    </div>



    <button class="btn btn-info">Mon bouton</button>

@endsection




