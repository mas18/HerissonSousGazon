<?php ?>
@extends('layouts.template')
@section('main_content')

    <div class="col-sm-offset-3 col-sm-5">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:18px">Fiche d'utilisateur</div>
            <div class="panel-body" style="font-size:12px">
                <p>Prénom : {{ $user->firstname }}</p>
                <p>Nom : {{ $user->lastname }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Rue : {{ $user->street }}</p>
                <p>NPA & Ville : {{ $user->city }}</p>
                <p>Remarques : {{ $user->comment }}</p>
                <br/>
                statut :
               {{$user->level==0 ? "membre":"administrateur"}}
            </div>
        </div>
        <div>
            <a href="javascript:history.back()" class="btn btn-primary pull-right btn-sm">Retour</a>
        </div>
    </div>
@endsection
