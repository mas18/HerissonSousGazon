@extends('layouts.template')

@section('main_content')
        <script>

            function delete_Event(id) {
                var id = id;
                if (!confirm("Êtes-vous sûr de vouloir supprimer cet événement? Cette action est irréversible"))
                {
                    e.preventDefault();
                    return;
                } else {
                    location.href = "{{URL::to('events/delete')}}"+"/"+id;
                }

            }

        </script>
        <div class="row">
            <div class="col-xs-9">
            </div>

            <!-- Trigger the modal with a button -->
            <div class="col-xs-3">
                <button type="button" style="float: right; margin-top: 22px;"  class="btn btn-primary" data-toggle="modal" data-target="#modalNew">Créer un événement</button>
            </div>
        </div>
        <br/><br/>

        <!-- Modal - New -->
        <div id="modalNew" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="padding: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Créer un événement</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('event.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="dateFrom" class="col-md-3 control-label">Date de: </label>

                                <div class="col-md-6">
                                    <input id="dateFrom" type="date" class="form-control" name="dateFrom" value="{{ old('date') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateFrom" class="col-md-3 control-label">Date à: </label>

                                <div class="col-md-6">
                                    <input id="dateTo" type="date" class="form-control" name="dateTo" value="{{ old('date') }}" required>
                                </div>
                            </div>
                            <div class="checkbox col-md-6 col-md-offset-3">
                                <label>
                                    <input type="checkbox" name="copy" checked /> Copier planning de l'année passée
                                </label>
                            </div>
                            <br />
                            <br />
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        Créer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>



        <br />
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">

            <?php $firstItem = true; ?>
            @foreach ($events as $event)
                <!-- Modal - Update -->
                    <div id="modalUpdate{{ $event->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="padding: 5px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Créer un événement</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('event.update') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="dateFrom" class="col-md-3 control-label">Date de: </label>

                                            <div class="col-md-6">
                                                <input id="dateFrom" type="date" class="form-control" name="dateFrom" value="{{ $event->starting }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dateTo{{ $event->id }}" class="col-md-3 control-label">Date à: </label>

                                            <div class="col-md-6">
                                                <input id="dateTo{{ $event->id }}" type="date" class="form-control" name="dateTo" value="{{ $event->ending }}" required>

                                            </div>
                                        </div>
                                        <input type="hidden" name="eventId" value="{{ $event->id }}">

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">
                                                    Modifier
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>

                        </div>
                    </div>
                <div class="panel panel-primary" style="margin-bottom: 5px;">
                    <div class="panel-heading" role="tab" id="heading{{ $event->id }}">
                        <div class="row">
                            <div class="col-xs-10">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" style="font-size: 20px;" data-parent="#accordion" aria-expanded="{{ $firstItem ? 'true' : 'false' }}" href="#collapse{{ $event->id }}" aria-controls="collapse{{ $event->id }}">
                                        Événement du {{ $event->starting }} au {{ $event-> ending}}
                                    </a>
                                </h4>
                            </div>
                            <div class="col-xs-2">
                                <button type="button" style="float: right; color:#f5f8fa"  class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalDelete" >Supprimer</button>
                                <button type="button" style="float: right; color:#f5f8fa"  class="btn btn-link btn-sm" onclick="$('#modalUpdate{{ $event->id }}').modal({'backdrop': 'static'});" >Modifier</button>
                            </div>
                        </div>
                    </div>
                    <div id="collapse{{ $event->id }}" class="panel-collapse collapse{{ $firstItem ? ' in' : '' }}" role="tabpanel" aria-labelledby="heading{{ $event->id }}">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="inner-content text-center">

                                        <div class="c100 big p{{ $controller->getPlaces($event->id) }} center">
                                            <span>{{ $controller->getPlaces($event->id) }}%</span>
                                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                                        </div>

                                        <p><em>Places occupées</em></p>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="inner-content text-center">

                                        <div class="c100 p100 big dark center">
                                            <span>{{ $controller->getVolunteers($event->id) }}</span>
                                            <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                                        </div>

                                        <p><em>Volontaires inscrit</em></p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 ">
                                    <a href="{{ route('schedule.show', $event->id) }}" class="btn pull-right  btn-default">Ouvrir le planning</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php $firstItem = false; ?>

            @endforeach
        </div>

    @if($errors->has('dateFrom') || $errors->has('dateTo'))
        <!-- Modal - New -->
        <div id="modalValidation" class="modal fade in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="padding: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Erreur de validation</h4>
                    </div>
                    <div class="modal-body">
                        @if ($errors->has('dateFrom'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dateFrom') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('dateTo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dateTo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>
        <script>
            $('#modalValidation').modal('show');
        </script>
    @endif

        <!-- Modal - DeleteEvent -->
        <div id="modalDelete" class="modal fade in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="padding: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmer la suppression de l'événement</h4>
                    </div>
                    <div class="modal-body alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"> </span>
                        Êtes-vous sûr de vouloir supprimer cet événement? Cette action est irréversible
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="delete_Event({{ isset($event) ? $event->id : '' }})" >Supprimer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>
        </div>
@endsection