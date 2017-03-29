<?php ?>

<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link href="//code.jquery.com/jquery-1.10.2.min.js" rel="stylesheet">
    </head>
    <body>
    <div class="table-responsive">
        <table class="table table-striped" id="allschedule">
            <thead>
            <tr>
                <th>Id</th>
                <th>Départ</th>
                <th>Fin</th>
                <th>rooms</th>
                <th>Places total</th>
                <th>Place occupée </th>
                <th>utilisateurs inscrits</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- App scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields      = 3; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initial text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group">'
                    + '<label for="timeFrom[]" class="col-md-3 control-label">De: </label>'
                    + '<div class="col-md-2">'
                        + '<input type="time" name="timeFrom[]" required>'
                    + '</div>'
                    + '<label for="timeTo[]" class="col-md-2 control-label">À: </label>'
                    + '<div class="col-md-2">'
                        + '<input type="time" name="timeTo[]" required>'
                    + '</div>'
                    + '<a href="#" class="remove_field"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></div>');
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });


        $(function(){
            $('#allschedule').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url:'{!! URL::asset('schedule_data') !!}',
                        data: function (d) { //the param we want send to serv
                            d.event_id = <?php $urls= explode('/' ,Request::url());
                                                echo $urls[count($urls)-1]?>
                        }
                    },
                columns : [
                { data: 'id', name: 'id' },

                { data: 'start', name: 'title', type: 'num',
                render : {
                    _: 'display', //valeur uniquement pour le display
                    sort: 'timestamp' //valeur pour le order by

                }},
                { data: 'finish', name: 'description', class: 'num',
                    render : {
                        _: 'display', //valeur uniquement pour le display
                        sort: 'timestamp' //valeur pour le order by
                }},
                    { data: 'rooms', name: 'rooms',
                        render : {
                            _: 'display', //valeur uniquement pour le display
                            sort: 'alpha' //valeur pour le order by

                        },
                    },
                    { data: 'places', name: 'description', title:'Places total', },

                    { data: 'occuped', name: 'occuped', title : 'places occupées', class : 'num'},


                    { data: 'users', name: 'users', title : 'Utilisateurs inscrits',
                    render : {
                        _: 'display',
                        sort: 'alpha'
                    }}
            ]
        });
        });
    </script>

    <div id="scheduleNew" class="modal fade in" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Créer schedule</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('schedule.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="eventId" value="{{ $event->id }}">
                        <div class="form-group">
                            <label for="date" class="col-md-3 control-label">Date:</label>

                            <div class="col-md-6">
                                <select id="date" class="form-control" name="date">
                                    @foreach ($dates as $date)
                                        <option value="{{ $date }}">{{ $date }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place" class="col-md-3 control-label">Place:</label>

                            <div class="col-md-6">
                                <select id="place" class="form-control" name="place">
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number" class="col-md-3 control-label">Nombre:</label>

                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control" name="number" value="1" min="1" max="20" required>
                            </div>
                        </div>
                        <div class="input_fields_wrap" style="margin-bottom: 0;">
                            <div class="form-group">
                                <label for="timeFrom[]" class="col-md-3 control-label">De: </label>

                                <div class="col-md-2">
                                    <input type="time" name="timeFrom[]" required>
                                </div>
                                <label for="timeTo[]" class="col-md-2 control-label">À: </label>

                                <div class="col-md-2">
                                    <input type="time" name="timeTo[]" required>
                                </div>
                            </div>
                        </div>
                        <button class="add_field_button col-md-offset-3 btn btn-link" style="padding-bottom: 20px; border: none; outline:none;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

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

    <div class="col-xs-3">
        <button type="button" style="float: right; margin-top: 22px;"  class="btn btn-primary" data-toggle="modal" data-target="#scheduleNew">Créer un schedule</button>
    </div>



    <!-- AJOUTER EMPLACEMENT -->
    <div class="col-xs-3">
        <button type="button" style="float:left; margin-top:25px;"  class="btn btn-primary" data-toggle="modal" data-target="#modalNewRoom">Ajouter emplacements</button>
    </div>

    <!-- Modal - New -->
    <div id="modalNewRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter un emplacements</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('room.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="roomName" class="col-md-3 control-label">Nom</label>
                            <div class="col-md-6">
                                <input id="roomName" type="text" class="form-control" name="roomName" required>
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Créer</button>
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



    </body>

</html>