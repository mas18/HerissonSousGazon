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
                <th>start</th>
                <th>finish</th>
                <th>place</th>
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
                    { data: 'places', name: 'description' }
            ]
        });
        });
    </script>
    </body>
</html>