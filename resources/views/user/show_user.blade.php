<?php ?>
@extends('layouts.template')
@section('main_content')
    <div class="col-sm-offset-1 col-sm-6" style="position:relative;top:40px;">
        <br>
        <div class="panel panel-info">
            <div class="panel-heading" style="font-size:28px">Fiche d'utilisateur</div>
            <div class="panel-body" style="font-size:22px">
                <p>Prénom : {{ $user->firstname }}</p>
                <p>Nom : {{ $user->lastname }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Rue : {{ $user->street }}</p>
                <p>Ville : {{ $user->city }}</p>
                <p>Remarques : {{ $user->comment }}</p>
                <br/>
                statut :
               {{$user->level==0 ? "membre":"administrateur"}}

            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary btn-lg">Retour</a>
    </div>
@endsection

