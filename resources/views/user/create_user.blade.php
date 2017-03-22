<?php ?>

@extends('layouts.template')
@section('header_title','creation utilisateur')
@section('main_content')
    <div class="col-sm-offset-4 col-sm-4">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Création d'un utilisateur</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal panel']) !!}


                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {{Form::label('email','email :')}}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>

                        <div class="form-group {!! $errors->has('firstname') ? 'has-error' : '' !!}">
                            {{Form::label('firstname','prénom')}}
                            {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
                            {!! $errors->first('firstname', '<small class="help-block">:message</small>') !!}
                        </div>

                    <div class="form-group {!! $errors->has('lastname') ? 'has-error' : '' !!}">
                        {{Form::label('lastname','nom')}}
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'nom']) !!}
                        {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('street') ? 'has-error' : '' !!}">
                        {{Form::label('street','rue :')}}
                        {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'rue']) !!}
                        {!! $errors->first('street', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('city') ? 'has-error' : '' !!}">
                        {{Form::label('city','ville  :')}}
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'ville']) !!}
                        {!! $errors->first('city', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('tel') ? 'has-error' : '' !!}">
                        {{Form::label('tel','téléphone  :')}}
                        {!! Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'téléphone']) !!}
                        {!! $errors->first('tel', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('comment') ? 'has-error' : '' !!}">
                        {{Form::label('comment','commentaire  :')}}
                        {!! Form::text('comment', null, ['class' => 'form-control', 'placeholder' => 'comment']) !!}
                        {!! $errors->first('comment', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                        {{Form::label('password','mot de passe')}}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
                        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe']) !!}
                    </div>

                    <div class="form-group {!! $errors->has('level') ? 'has-error' : '' !!}">
                        {{Form::label('level','statut:')}}
                        <div class="checkbox">

                            {!! Form::radio('level', 1) !!}administrateur
                            {!! Form::radio('level', 0, 'checked') !!}membre

                            {!! $errors->first('level', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
    </div>
@endsection

