<?php ?>

@extends('layouts.template')
@section('header_title', $user->lastname)
@section('main_content')
    <div class="col-sm-offset-2 col-sm-8">

        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif

        <br>
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:18px">Modification d'un utilisateur</div>
            <div class="panel-body" style="font-size:12px">
                <div class="col-sm-12">

                    {!! Form::model($user, ['action' => ['ProfilController@save'], 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group {!! $errors->has('firstname') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('firstname','Prénom')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'prénom']) !!}
                            {!! $errors->first('firstname', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('lastname') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('lastname','Nom')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'nom']) !!}
                            {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('email','Email')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('street') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('street','Rue')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'rue']) !!}
                            {!! $errors->first('street', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('city') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('city','NPA & Ville')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'ville']) !!}
                            {!! $errors->first('city', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('tel') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('tel','Téléphone')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'téléphone']) !!}
                            {!! $errors->first('tel', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('comment') ? 'has-error' : '' !!}">
                        <div class="col-md-2">
                            {{Form::label('comment','Commentaire')}}
                        </div>
                        <div class="col-md-9"  style="height: 25px;">
                            {!! Form::text('comment', null, ['class' => 'form-control', 'placeholder' => 'comment']) !!}
                            {!! $errors->first('comment', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>

                </div>
                {!! Form::submit('Confirmer', ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
