<?php ?>

@extends('layouts.template')
@section('main_content')


        <!-- Google MAP Script-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
        <script>
            function init_map() {
                var var_location = new google.maps.LatLng(46.1208627,7.135113899999965);

                var var_mapoptions = {
                    center: var_location,
                    zoom: 14
                };

                var var_marker = new google.maps.Marker({
                    position: var_location,
                    map: var_map,
                    title:"Hérisson sous gazon"});

                var var_map = new google.maps.Map(document.getElementById("map-container"), var_mapoptions);

                var_marker.setMap(var_map);

            }
            google.maps.event.addDomListener(window, 'load', init_map);
        </script>


        <style>
            #map-container { height: 40%; width: 120%; }
        </style>




    <div class="form-group">
        <div style="padding-top: 15%;" class="col-sm-5">
            <h3>Isaline Bruchez</h3>
            <p>isaline.bruchez@gmail.com</p>
            <a href="https://www.facebook.com/herissonsousgazon/" title="facebook">
                <img src="pictures\fblogo.jpg" class="img-responsive" alt="Cinque Terre" style="height: 8%; width: 12%;">
            </a>
        </div>


        <div style="padding-top: 5%;" class="col-sm-5">
            <h3> Adresse </h3>
            <p>Rue des Village 17</p>
            <p>1906 Charrat</p>

            <div id="map-container" class="col-md-6"></div>
        </div>
    </div>










@endsection

