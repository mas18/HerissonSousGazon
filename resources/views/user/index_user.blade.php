<?php  ?>
@extends('layouts.template')
@section('header_title','gestion utilisateur')
@section('main_content')

    <br>
    <div class="col-sm-offset-1 col-sm-10">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-size:18px">Liste des bénévoles</div>
                <div class="table-responsive">
                <table class="table" style="font-size:12px">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
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
                            <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-info btn-block btn-sm']) !!}</td>
                            <td>{!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-primary btn-block btn-sm']) !!}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block btn-sm', 'onclick' => 'return confirm(\'Voulez-vous vraiment supprimer ce bénévole ?\')']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
            {!! link_to_route('user.create','Ajouter un bénévole', [], ['class' => 'btn btn-default pull-right btn-sm']) !!}
            {{ Html::link('/export/user', 'Exporter ', ['class' => 'btn btn-default pull-right btn-sm'])}}
        {!! $links !!}
    </div>
@endsection


