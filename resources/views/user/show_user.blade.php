<?php ?>
@extends('layouts.template')
@section('main_content')
    <div class="col-sm-offset-4 col-sm-4">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche d'utilisateur</div>
            <div class="panel-body">
                <p>prénom : {{ $user->name }}</p>
                <p>nom : {{ $user->email }}</p>
                <p>email : {{ $user->email }}</p>
                <p>Rue : {{ $user->street }}</p>
                <p>ville : {{ $user->city }}</p>
                <p>Remarques : {{ $user->comment }}</p>
                <br/>
                statut :
               {{$user->level==0 ? "membre":"administrateur"}}

            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>
@endsection

