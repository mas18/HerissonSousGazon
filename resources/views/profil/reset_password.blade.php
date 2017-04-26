<?php ?>
@extends('layouts.template')

@section('header_title','réinitialisation de mot de passe')
@section('main_content')
<div>

    {!! Form::open( ['action' => ['ProfilController@resetPassword'], 'method' => 'post', 'class' => 'form-horizontal panel']) !!}

        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            <div class="col-md-3">
                {{Form::label('password','Nouveau mot de passe')}}
            </div>
            <div class="col-md-9"  style="height: 25px;">
                {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'password']) !!}
                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
            </div>
        </div>

    <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
        <div class="col-md-3">
            {{Form::label('password_confirmation','Confirmer mot de passe')}}
        </div>
        <div class="col-md-9"  style="height: 25px;">
            {!! Form::password('password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Confirmation de mot passe']) !!}
            {!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
    {!! Form::submit('Confirmer', ['class' => 'btn btn-primary btn-sm']) !!}
    {!! Form::close() !!}

</div>
    @endsection