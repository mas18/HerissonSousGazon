<?php ?>

@extends('layouts.template')
@section('header_title','Erreur')

@section('main_content')

        <div class="col-md-12">
            <div class="error-template" style="padding:40px 15px; text-align: center;">
                <h1>404 aucun résultat trouvé!</h1>
                <h3 style="color:#595959">Oops! la page que vous recherchez est introuvable.</h3>
            </br>
                <div class="error-actions" style="margin-right:10px; font-size:18px">
                    <span class="glyphicon glyphicon-home" style="color:#2a88bd"></span>
                    {{ Html::link('/home', 'Retour à la page accueil')}}
                </div>
            </div>
        </div>

@endsection