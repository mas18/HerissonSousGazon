<?php ?>
@extends('layouts.template')
@section('main_content')

    <div class="col-xs-12" style="padding-right: 0;">

    @if(Auth::user()->level>0)
        <button type="button"  class="btn btn-primary pull-right btn-sm" style="margin-left:5px;" data-toggle="modal" data-target="#modalNewRoom">Ajouter un poste</button>
        <button type="button"  class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#scheduleNew">Créer une plage horaire</button>
    @endif
    </div>
    </br></br></br>
    @if(session()->has('unsub'))
        <div class="alert alert-success alert-dismissible">{!! session('unsub') !!}</div>
    @endif

    <!-- SCHEDULE TABLE -->
    <div class="table-responsive">
        <h5 class="text-danger pull-right">Les mineurs ne peuvent pas s’inscrire aux bars ou aux caisses.</h5>
        <table class="table table-hover table-striped" id="allschedule" style="font-size:12px; border:1px solid #D9D8D8; border-radius:5px">
            <thead>
            <tr style="font-size:14px">
                <th>Numéro</th>
                <th>Jour</th>
                <th>Date</th>
                <th>Poste</th>
                <th>Heure début</th>
                <th>Heure fin</th>
                <th>Places totales</th>
                <th>Places restantes </th>
                <th>Bénévoles inscrits</th>
                @if(Auth::user()->level==0)
                <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>



    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>




    {{ Html::script('js/pdfmake.min.js')}}
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>

    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
    <!-- App scripts -->
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

    <script type="text/javascript">

        $(document).ready(
            function() {
                @if(Auth::user()->level>0)
                    var submitButton = document.querySelector("#submitVolunteers");
                    submitButton.addEventListener("click", function(event) {
                     event.preventDefault();


                        var list = document.querySelector("#subscribed_user_list");

                        var listElement = list.childNodes;


//                        listElement.forEach(function(element){
//                           element.selected = true;
//                        });
                        for (var k=0;k<listElement.length;k++)
                        {
                            var element=listElement[k];
                            element.selected = true;
                        }

                        var formSubscribe = document.querySelector("#formSubscribe");
                        formSubscribe.submit();

                    });
                @endif

                //marche
                $("#btnLeft").click(function () {
                    var selectedItem = $("#non_subscribed_userList option:selected");
                    var subscribed = $("#subscribed_user_list option");

                    if(selectedItem.length + subscribed.size() > $('#number_edit').val()){
                        alert("Le nombre de bénévoles est plus grande que le nombre des places");
                    } else {
                        $('#subscribed_user_list').append(selectedItem);
                    }

                });

                $("#btnRight").click(function () {
                    var selectedItem = $("#subscribed_user_list option:selected");
                    $('#non_subscribed_userList').append(selectedItem);
                });

            });


        $(document).ready(
            function() {
            $("#updateSchedule").hide();
            var max_fields      = 10; //maximum input boxes allowed
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
                            + '<input type="time" name="timeFrom[]" size="6" required>'
                            + '</div>'
                            + '<label for="timeTo[]" class="col-md-2 control-label">À: </label>'
                            + '<div class="col-md-2">'
                            + '<input type="time" name="timeTo[]" size="6" required>'
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
                responsive: true,
               // "bStateSave": true, //add state button to save the current display
                dom: 'Blfrtip', //display button and entries

                buttons: [ //set language of the button text
                        @if(Auth::User()->level==1)
                    {extend: 'copy', text: 'Copier  - '},
                    {extend: 'csv', text:  'Enregister en CSV -  ', title: 'Horaire' },
                    {extend: 'excel', text:  'Enregister au format excel - ', title: 'Horaire' },
                    {extend: 'print', text:  'imprimer'},
                    @endif
                ],



                    processing: false,
                    serverSide: false,
                    ajax: {
                        url:'{!! URL::asset('schedule_data') !!}',
                        data: function (d) { //the param we want send to serv
                            d.event_id = <?php $urls= explode('/' ,Request::url());
                                                echo $urls[count($urls)-1]?>}},
                //set the display length option by default
                'iDisplayLength':100,
                //set language for the paginate option
                "language": {
                    "paginate": {
                        "previous": "Page précédente",
                        "next":'Page suivante',
                    },
                    //other language options:
                    "processing":     "Traitement...",
                    "info":           "Affichage de  _START_ à _END_ entrées, pour un total de  _TOTAL_ entrées",
                    "search":          "Rechercher un élément ",
                    "lengthMenu":     "Affichage de  _MENU_ entrées",
                    "infoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "emptyTable":     "Il n'y a pas encore de plage horaire dans cette évènement.",
                },

                //pagination action


                //set the column option (sort and display element)
                columns : [
                { data: 'id', name: 'id', title: 'Numéro' },

                { data: 'day', name: 'day', title: 'Jour', type: 'num',
                    render : {
                        _: 'display', //valeur uniquement pour le display
                        sort: 'number' //valeur pour le order by
                    }},

                    { data: 'date', name: 'date', title: 'Date', type: 'num',
                        render : {
                            _: 'display', //valeur uniquement pour le display
                            sort: 'timestamp' //valeur pour le order by
                        }},

                    { data: 'rooms', name: 'rooms', title: 'Poste',
                        render : {
                            _: 'display', //valeur uniquement pour le display
                            sort: 'alpha' //valeur pour le order by
                        }},

                { data: 'start', name: 'title', title: 'Heure début', type: 'num',
                render : {
                    _: 'display', //valeur uniquement pour le display
                    sort: 'timestamp' //valeur pour le order by

                }},

                { data: 'finish', name: 'description', title: 'Heure fin', class: 'num',
                    render : {
                        _: 'display', //valeur uniquement pour le display
                        sort: 'timestamp' //valeur pour le order by
                }},

                { data: 'places', name: 'description', title:'Places totales', },

                { data: 'occuped', name: 'occuped', title : 'Places restantes', class : 'num'},

                { data: 'users', name: 'users', title : 'Bénévoles inscrits',
                    render : {
                        _: 'display',
                        sort: 'alpha'
                    }},

            @if(Auth::user()->level==0)
                {data: 'action', name: 'action', orderable: false, searchable: false}
            @endif
            ],

                'fnInitComplete':function(){
                        data_table_listener();


                    }

            })});



        function format_style_based_on_day(rows)
        {
           //retrive all the row
            console.log(rows);
//            rows.forEach(function(aRow)
//            {
//                var day=aRow.childNodes[1].innerHTML;
//                    assignStyle(day,aRow);
//
//            });

            for (var k=0;k<rows.length;k++)
            {
                var day=rows[k].childNodes[1].innerHTML;
                assignStyle(day,rows[k]);
            }


            function assignStyle(day, row)
            {

                switch(day) {
                    case 'Lundi':
                        row.style.backgroundColor="#D4C4DB";
                        break;
                    case 'Mardi':
                        row.style.backgroundColor="#F2B2B2";
                        break;
                    case 'Mercredi':
                        row.style.backgroundColor="#ADE7F3";
                        break;
                    case 'Jeudi':
                        row.style.backgroundColor="#A8CAB0";
                        break;
                    case 'Vendredi':
                        row.style.backgroundColor="#F5F6CE";
                        break;
                    case 'Samedi':
                        row.style.backgroundColor="#C7D5F8";
                        break;
                    case 'Dimanche':
                        row.style.backgroundColor="#F7BFDA";
                        break;
                    default:
                }
            }

        }

        function data_table_listener() {
            var modalAction = document.getElementById('modalAction');
            var row = document.querySelectorAll("#allschedule  tr");
            //we format the row depending on the date
            format_style_based_on_day(row);

            for (var k = 1; k < row.length; k++) {
                @if(Auth::user()->level>0)
                    admin_function();
                @endif

                //add and remove button click
                        @if(Auth::user()->level==0)
                var childsNodes = subscribe_unsubscibe();
                @endif

            }


            function admin_function() {
                row[k].addEventListener('dblclick', function () {
                    var c = this.childNodes;
                    var id = c[0].innerHTML;
                    var room = c[3].innerHTML;
                    var number = c[6].innerHTML;
                    var date = c[2].innerHTML;
                    var start = c[4].innerHTML;
                    var end = c[5].innerHTML;
                    // ajax part to retrieve user
                    getMessage();

                    function getMessage(){
                        var url="{{URL::to('adminuserslist')}}"+"/"+id;
                        $.ajax({
                            type:'GET',
                            url:url,
                            data:'1',
                            success:function(data){ //do somethings with data
                                //we retrive both list
                                var subscribedList=document.querySelector('#subscribed_user_list');
                                var nonSubscribedList=document.querySelector('#non_subscribed_userList');

                                //--------------list with subscribed user-----------------

                                //we clear the list
                                subscribedList.innerHTML="";

                                //fil the aldready subscribded data
                                for (var k=0;k<data[0].length;k++)
                                {
                                    element=data[0][k];
                                    var option=document.createElement('option');
                                    option.value=element.id;
                                    option.innerHTML=element['lastname']+" "+element['firstname'];

                                    subscribedList.appendChild(option);

                                }
//                                data[0].forEach(function(element){
//                                    console.log(element['id']);
//                                    var option=document.createElement('option');
//                                    option.value=element.id;
//                                    option.innerHTML=element['lastname']+" "+element['firstname'];
//
//                                    subscribedList.appendChild(option);
//                                });

                               //list non subscribed  data-----------------------
                                nonSubscribedList.innerHTML="";


                                //fil the aldready subscribded data
                                for (var k=0;k<data[1].length;k++)
                                {
                                    element=data[1][k];
                                    var option=document.createElement('option');
                                    option.value=element.id;
                                    option.innerHTML=element['lastname']+" "+element['firstname'];

                                    nonSubscribedList.appendChild(option);

                                }
//                                data[1].forEach(function(element){
//                                    var option=document.createElement('option');
//                                    option.value=element.id;
//                                    option.innerHTML=element['lastname']+" "+element['firstname'];
//
//                                    nonSubscribedList.appendChild(option);
//                                });

                            }
                        });
                    }


                    $('#scheduleId').val(id);
                    $('#scheduleId2').val(id);
                    $("#place_edit option:contains(" + room + ")").attr('selected', true);
                    $('#date_edit').val(date);
                    $('#number_edit').val(number);
                    $('#timeFrom_edit').val(start);
                    $('#timeTo_edit').val(end);
                    $('#scheduleUpdate').modal('show');
                });
            }
            //admin double click
            function subscribe_unsubscibe() {

                //add and remove button click
                var childsNodes = row[k].childNodes;
                console.log(childsNodes[childsNodes.length - 1]);
                //get the information to display in the alert box
                // var action_type=childsNodes[childsNodes.length-1].innerHTML.includes('Desinscription') ? "Désincription de l'horaire suivant :":"inscription à l'horaire suivant : ";
                if(childsNodes[childsNodes.length-1].innerHTML === "Desinscription"){
                    var action_type="Désincription de l'horaire suivant :";
                } else {
                    var action_type="Inscription à l'horaire suivant : ";
                }

                var schedule_number=childsNodes[0].innerHTML;
                // var action_type=childsNodes[childsNodes.length-1].innerHTML.includes('Desinscription') ? "la désincription de l'horaire : ":"l'inscription à l'horaire : ";
                var schedule_day=childsNodes[1].innerHTML;
                var schedule_date=childsNodes[2].innerHTML;
                var schedule_post=childsNodes[3].innerHTML;
                var schedule_start_hour=childsNodes[4].innerHTML;
                var schedule_end_hour=childsNodes[5].innerHTML;
                var alert_message="Veuillez confirmer "+action_type+" numéro "+schedule_number+ ", le "+schedule_day+" "+schedule_date+ " au poste '"+schedule_post+ "' commençant à "+schedule_start_hour+
                        " pour finir à "+schedule_end_hour;
                childsNodes[childsNodes.length - 1].addEventListener('click', function (event) {
                    var child = this.firstChild;
                    var id = this.parentNode.childNodes[0].innerHTML;


                    if(!child.classList.contains("disabled")){
                        if (!confirm(alert_message))
                        {
                            e.preventDefault();
                            return;
                        }

                        console.log(id);
                        var url="{{URL::to('subscribe')}}"+"/"+id;
                        console.log(url);
                        location.href = "{{URL::to('subscribe')}}"+"/"+id;
                    } else if(child.classList.contains('btn-danger')){
                        $('#unsub_schedule').val(id);
                        $('#modalUnsubscribe').modal('show');
                        // alert("Vous pouvez plus vous désincrire 3 semaines avant l'événement. Veuillez prendre contact avec l'administrateur");
                    }

                });
                return childsNodes;
            }
        }


        function edit() {
            document.getElementById("place_edit").disabled = false;
            document.getElementById("date_edit").disabled = false;
            document.getElementById("number_edit").disabled = false;
            document.getElementById("timeFrom_edit").disabled = false;
            document.getElementById("timeTo_edit").disabled = false;
        }

        function disableEdit() {
            document.getElementById("place_edit").disabled = true;
            document.getElementById("date_edit").disabled = true;
            document.getElementById("number_edit").disabled = true;
            document.getElementById("timeFrom_edit").disabled = true;
            document.getElementById("timeTo_edit").disabled = true;
            $("#updateSchedule").hide();
        }

        function edit() {
            document.getElementById("place_edit").disabled = false;
            document.getElementById("date_edit").disabled = false;
            document.getElementById("number_edit").disabled = false;
            document.getElementById("timeFrom_edit").disabled = false;
            document.getElementById("timeTo_edit").disabled = false;
            $("#updateSchedule").show();
        }

        function deleteSchedule() {
            var id = $('#scheduleId').val();
            if (!confirm("Êtes-vous sûr de vouloir supprimer cette plage horaire? Cette action est irréversible."))
            {
                e.preventDefault();
                return;
            } else {
                location.href = "{{URL::to('schedule/delete')}}"+"/"+id;
            }

        }


    </script>


    @if(Auth::user()->level>0)
    <!-- CREATE NEW SCHEDULE -->
    <div id="scheduleNew" class="modal fade in" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Créer une plage horaire</h4>
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
                            <label for="place" class="col-md-3 control-label">Poste:</label>

                            <div class="col-md-6">
                                <select id="place" class="form-control" name="place">
                                    @foreach ($rooms as $room)
                                        <option text="{{ $room->name }}" value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number" class="col-md-3 control-label">Places totales:</label>

                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control" name="number" value="1" min="1" max="20" required>
                            </div>
                        </div>
                        <div class="input_fields_wrap" style="margin-bottom: 0;">
                            <div class="form-group">
                                <label for="timeFrom[]" class="col-md-3 control-label">De: </label>

                                <div class="col-md-2">
                                    <input type="time" name="timeFrom[]" size="6" required>
                                </div>
                                <label for="timeTo[]" class="col-md-2 control-label">À: </label>

                                <div class="col-md-2">
                                    <input type="time" name="timeTo[]" size="6" required>
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
    <!--  END CREATE NEW SCHEDULE !-->



    <!-- SHOW / UPDATE SCHEDULE -->
    <div id="scheduleUpdate" class="modal fade in" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" onclick="disableEdit()" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Administrateur actions</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('schedule.update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="eventId" name="eventId" value="{{ $event->id }}">
                        <input type="hidden" id="scheduleId" name="scheduleId" value="">

                        <div class="form-group">
                            <label for="place_edit" class="col-md-3 control-label">Poste:</label>
                            <div class="col-md-6">
                                <select id="place_edit" class="form-control" name="place_edit" disabled>
                                    @foreach ($rooms as $room)
                                            <option name="{{ $room->name }}" value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_edit" class="col-md-3 control-label">Date:</label>

                            <div class="col-md-6">
                                <select id="date_edit" class="form-control" name="date_edit" disabled>
                                    @foreach ($dates as $date)
                                        <option value="{{ $date }}">{{ $date }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="number_edit" class="col-md-3 control-label">Places totales:</label>

                            <div class="col-md-6">
                                <input id="number_edit" type="number" class="form-control" name="number_edit" value="" min="1" max="20" disabled required>
                            </div>
                        </div>
                        <div class="input_fields_wrap" style="margin-bottom: 0;">
                            <div class="form-group">
                                <label for="timeFrom_edit" class="col-md-3 control-label">De: </label>

                                <div class="col-md-2">
                                    <input type="time" name="timeFrom_edit" id="timeFrom_edit" value="" disabled required>
                                </div>
                                <label for="timeTo_edit" class="col-md-2 control-label">À: </label>

                                <div class="col-md-2">
                                    <input type="time" id="timeTo_edit" name="timeTo_edit" value="" disabled required>
                                </div>
                                <br/><br/><br/>
                                <div class="col-md-11 col-md-offset-1">
                                    <button type="button" id="editButton" class="btn btn-primary" onclick="edit()">Modifier la plage horaire</button>
                                    <button type="button" id="editButton" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">Supprimer la plage horaire</button>
                                </div>
                            </div>
                        </div>
                        <div id="updateSchedule" class="form-group">
                            <div class="col-md-6 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                        <br/>
                    </form>
                </div>

                <div class="modal-footer">
                    <form id="formSubscribe" class="form-horizontal" role="form" method="POST" action="{{ route('schedule.subscriptionadmin') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="eventId" name="eventId" value="{{ $event->id }}">
                        <input type="hidden" id="scheduleId2" name="scheduleId2" value="">

                        <div class="form-group">
                            <section class="container" style="overflow:auto; width:600px;box-sizing: border-box;">
                                <div style="width:230px; text-align:center;" class="col-md-2">
                                    <label>Bénévoles inscrits</label>
                                    <select id="subscribed_user_list" name="subscribed_user_list[]" size="10" style="width: 220px;overflow:scroll;" multiple>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <br/><br/><br/>
                                    <input type="button" id="btnLeft" class="btn btn-default" value="&lt;&lt;" />
                                    <input type="button" id="btnRight" class="btn btn-default" value="&gt;&gt;" />
                                </div >
                                <div style="width:230px;text-align:center;" class="col-md-2">
                                    <label>Bénévoles non inscrits</label>
                                    <select id="non_subscribed_userList" name="non_subscribed_userList[]" size="10" style="width:220px;overflow:scroll;" multiple>
                                    </select>
                                </div>
                            </section>
                            <br/><br/>
                            <div >
                                <button id="submitVolunteers" style="margin-left:30px;" class="btn btn-primary pull-left">Enregistrer</button>
                            </div>
                        </div>

                        </br>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="disableEdit()" data-dismiss="modal">Fermer</button>
                </div>
            </div>

        </div>
    </div>



    <!-- AJOUTER EMPLACEMENT -->
    <!-- Modal - New -->
    <div id="modalNewRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter un poste</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('room.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="eventId" value="{{ $event->id }}">
                        <div class="form-group">
                            <label for="roomName" class="col-md-3 control-label">Nom du poste</label>
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
    @endif

    @if(session()->has('error_msg'))
        <!-- Modal  -->
        <div id="modalValidation" class="modal fade in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="padding: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Erreur de validation</h4>
                    </div>
                    <div class="modal-body">

                            <span  class="alert alert-warning">
                                 <span class="glyphicon glyphicon-warning-sign"> </span>
                                <strong>{{ session()->pull('error_msg', 'default') }}</strong>
                            </span>

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


    @if(session()->has('error_user_list'))
        <!-- Modal  -->
        <div id="modalValidation" class="modal fade in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="padding: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Erreur de validation</h4>
                    </div>
                    <div class="modal-body alert alert-warning">

                        <br/>
                        <span class="glyphicon glyphicon-warning-sign"> </span>
                        @foreach( session()->pull('error_user_list', 'default') as $anEntry)
                            {{ $anEntry }}

                        @endforeach

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





    @if($errors->all())
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
                            <span class="help-block">
                                <strong>{{ $errors->first() }}</strong>
                            </span>

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

    <!-- Modal - DeleteSchedule -->
    <div id="modalDelete" class="modal fade in" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Veuillez confirmer la suppression de la plage horaire</h4>
                </div>
                <div class="modal-body alert alert-danger">
                    <span class="glyphicon glyphicon-warning-sign"> </span>
                    Êtes-vous sûr de vouloir supprimer cette plage horaire? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteSchedule()" >Supprimer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal - DeleteSchedule -->
    <div id="modalUnsubscribe" class="modal fade in" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="padding: 5px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Désinscription à une plage horaire</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 alert alert-info">
                        Trois semaines avant l'événement il n'est plus possible pour un bénévole de se désinscrire à une plage horaire pour des questions d'organisation.
                        Veuillez envoyer une demande à l'administrateur en remplissant les raisons de votre désinscription en dessous et en appuyant sur le bouton "envoyer".
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('schedule.unsubscribe') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="unsub_schedule" name="schedule" value="">
                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <br />
                                <label for="comment" style="text-align: left; padding-left: 0" class="control-label col-md-12">Raison de votre désinscription</label>
                                <textarea rows="5" style="resize: none;" class="form-control col-md-12" name="message" required></textarea>
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Envoyer la demande</button>
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

    @endsection