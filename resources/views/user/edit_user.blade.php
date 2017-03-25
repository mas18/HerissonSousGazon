<?php ?>
@extends('layouts.template')
@section('header_title', $user->lastname)
@section('main_content')
    <div class="col-sm-offset-1 col-sm-8" style="position:relative;top:40px;">
        <br>
        <div class="panel panel-info">
            <div class="panel-heading" style="font-size:28px">Modification d'un utilisateur</div>
            <div class="panel-body" style="font-size:22px">
                <div class="col-sm-12">

                    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group {!! $errors->has('firstname') ? 'has-error' : '' !!}">
                        {{Form::label('firstname','prenom:')}}
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'prénom']) !!}
                        {!! $errors->first('firstname', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('lastname') ? 'has-error' : '' !!}">
                        {{Form::label('lastname','nom:')}}
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'nom']) !!}
                        {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {{Form::label('email','adresse email :')}}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
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

                    <div class="form-group {!! $errors->has('level') ? 'has-error' : '' !!}">
                        {{Form::label('level','statut:')}}
                        <div class="checkbox">

                                {!! Form::radio('level', 1) !!}administrateur
                                {!! Form::radio('level', 0) !!}membre

                            {!! $errors->first('level', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    </div>
                    {!! Form::submit('Confirmer', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        <a href="javascript:history.back()" class="btn btn-primary btn-lg">Retour</a>
        </div>
    </div>
@endsection

