<?php ?>

@extends('layouts.template')
@section('main_content')




    <div class="row">
        <div style="padding-top: 15%;" class="col-sm-4">
            <h3>Isaline Bruchez</h3>
            <p>{{$mail}}</p>
            <p>{{$tel}}</p>
            @if (Auth::user())
            @if (Auth::user()->level==config("Constant.level.admin"))

                <div id="myModal" class="modal fade">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modification</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        data-target="#myModal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open( ['route' => 'contact_update', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}
                                {{Form::label('tel: ','Téléphone')}}
                                {{Form::text('tel',null, ['placehodler'=>"tel"])}}
                                {{Form::label('email: ','Email')}}
                                {{Form::text('email',null, ['placehodler'=>"email"])}}
                                {{Form::submit("enregister")}}
                                {{Form::close()}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>


                <button id="update_profil" ><span class="glyphicon glyphicon-pencil"></span></button>
                <script>
                    var button =document.querySelector('#update_profil');
                    button.addEventListener('click',function()
                    {

                        $('#myModal').modal('show');
                    })
                </script>
            @endif
            @endif
            <a href="https://www.facebook.com/herissonsousgazon/" title="facebook">
                <img src="pictures\fblogo.jpg" class="img-responsive" alt="Cinque Terre" style="height: 7%; width: 12%;">
            </a>


        </div>



        <div style="padding-top: 5%;" class="col-sm-8">
            <h3>Adresse de l'évènement </h3>
            <p>Avenue de la Gare 6</p>
            <p>1906 Charrat</p>

            <div id="map-container" class="col-md-12; padding-left: 0;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2765.425409815358!2d7.131403815343376!3d46.122355297306655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478ec894ea71a10b%3A0x4d9c1a83fc839e4e!2sAvenue+de+la+Gare+6%2C+1906+Charrat!5e0!3m2!1sde!2sch!4v1493534222797" width="100%;" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

        </div>
    </div>










@endsection

