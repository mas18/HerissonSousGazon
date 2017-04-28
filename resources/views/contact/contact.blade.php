<?php ?>

@extends('layouts.template')
@section('main_content')


        <!-- Google MAP Script
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


        -->

    <div class="row">
        <div style="padding-top: 15%;" class="col-sm-4">
            <h3>Isaline Bruchez</h3>
            <p>isbruchez@hotmail.com</p>
            <p>079/664.87.57</p>
            <a href="https://www.facebook.com/herissonsousgazon/" title="facebook">
                <img src="pictures\fblogo.jpg" class="img-responsive" alt="Cinque Terre" style="height: 7%; width: 12%;">
            </a>
        </div>


        <div style="padding-top: 5%;" class="col-sm-8">
            <h3>Adresse de l'évènement </h3>
            <p>Avenue de la Gare 3</p>
            <p>1906 Charrat</p>

            <div id="map-container" class="col-md-12; padding-left: 0;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16814.97781560817!2d7.120889220325206!3d46.12208899343643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478ec8952b66122b%3A0x33d053fbf04e3877!2sRue+des+Villages+17%2C+1906+Charrat%2C+Schweiz!5e0!3m2!1sde!2sde!4v1493296131883" width="100%;" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

        </div>
    </div>










@endsection

