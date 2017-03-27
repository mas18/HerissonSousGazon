@extends('layouts.template')

@section('main_content')


        <div class="row">
            <div class="col-xs-9">
                <h2>Hérisson sous gazon</h2>
            </div>

            <!-- Trigger the modal with a button -->
            <div class="col-xs-3">
                <button type="button" style="float: right; margin-top: 22px;"  class="btn btn-primary" data-toggle="modal" data-target="#modalNew">Créer un événement</button>
            </div>
        </div>

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
                                    <input type="checkbox" name="copy" checked /> Copy schedule from last event
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
                                                    Update
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
                <div class="panel panel-default" style="margin-bottom: 5px;">
                    <div class="panel-heading" role="tab" id="heading{{ $event->id }}">
                        <div class="row">
                            <div class="col-xs-10">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="{{ $firstItem ? 'true' : 'false' }}" href="#collapse{{ $event->id }}" aria-controls="collapse{{ $event->id }}">
                                        Edition {{ str_limit($event->starting, $limit=4, $end = '') }}
                                    </a>
                                </h4>
                            </div>
                            <div class="col-xs-2">
                                <button type="button" style="float: right;"  class="btn btn-link btn-xs" onclick="$('#modalUpdate{{ $event->id }}').modal({'backdrop': 'static'});" >Edit</button>
                            </div>
                        </div>
                    </div>
                    <div id="collapse{{ $event->id }}" class="panel-collapse collapse {{ $firstItem ? ' in' : '' }}" role="tabpanel" aria-labelledby="heading{{ $event->id }}">
                        <div class="panel-body">
                            <p>{{ $event->starting }}</p>
                            <p>{{ $event->ending }}</p>
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



@endsection