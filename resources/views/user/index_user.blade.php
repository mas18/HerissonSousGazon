<?php  ?>
@extends('layouts.template')
@section('header_title','gestion utilisateur')
@section('main_content')

    <br>
    <div class="col-sm-offset-0 col-sm-12" style="position:relative;top:40px;">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:28px">Liste des utilisateurs</div>
            <table class="table" style="font-size:22px">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-left">{!! $user->lastname !!}</td>
                        <td class="text-left">{!! $user->firstname !!}</td>
                        <td class="text-left">{!! $user->email !!}</td>
                        <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-info btn-block']) !!}</td>
                        <td>{!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-primary btn-block']) !!}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-default pull-right btn-lg']) !!}
        {!! $links !!}
    </div>
@endsection


