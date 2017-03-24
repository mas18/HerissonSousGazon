@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <h2>Hérisson sous gazon</h2>
            </div>

            <!-- Trigger the modal with a button -->
            <div class="col-xs-3">
                <button type="button" style="float: right; margin-top: 22px;"  class="btn btn-primary" data-toggle="modal" data-target="#myModal">Créer un événement</button>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
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

                            <div class="form-group{{ $errors->has('dateFrom') ? ' has-error' : '' }}">
                                <label for="dateFrom" class="col-md-3 control-label">Date de: </label>

                                <div class="col-md-6">
                                    <input id="dateFrom" type="date" class="form-control" name="dateFrom" value="{{ old('date') }}" required>

                                    @if ($errors->has('dateFrom'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dateFrom') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('dateTo') ? ' has-error' : '' }}">
                                <label for="dateFrom" class="col-md-3 control-label">Date à: </label>

                                <div class="col-md-6">
                                    <input id="dateTo" type="date" class="form-control" name="dateTo" value="{{ old('date') }}" required>

                                    @if ($errors->has('dateTo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dateTo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="checkbox col-md-6 col-md-offset-3">
                                <label>
                                    <input type="checkbox"> Copy schedule from last event
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
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{ $event->id }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="{{ $firstItem ? 'true' : 'false' }}" href="#collapse{{ $event->id }}" aria-controls="collapse{{ $event->id }}">
                                Edition {{ str_limit($event->starting, $limit=4, $end = '') }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $event->id }}" class="panel-collapse collapse {{ $firstItem ? ' in' : '' }}" role="tabpanel" aria-labelledby="heading{{ $event->id }}">
                        <div class="panel-body">
                            <p>{{ $event->starting }}</p>
                            <p>{{ $event->ending }}</p>
                        </div>
                    </div>
                </div>
                {{ $firstItem = false }}
            @endforeach
        </div>
    </div>



@endsection