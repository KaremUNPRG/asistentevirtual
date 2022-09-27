@extends('web.layout.appWeb')
@section('Content')
  <style media="screen">
    .title-mensaje{
      text-align: center;
      padding: 10px 0px;
      line-height: 22px;
      width: 100%;
      cursor: pointer;
      font-weight: 600;
    }
    .title-mensaje::after{
      content: "";
      width: 64px;
      background: rgb(255, 85, 0);
      height: 2px;
      display: block;
      margin: 0px auto;
    }
    #botmanWidgetRoot > div > div > div {
            color: #fff!important;
    }
  </style>
      <!-- Start Proerty header  -->
  @php
    $imagen = strpos($Propiedad->imagen, 'base64');
    if($Propiedad->imagen == null){
      $Propiedad->imagen = 'frontend\asset\img\camera.jpg';
    }
  @endphp
  <section id="aa-property-header" style="background:none;height:500px">
    <img src="{{$imagen === false?asset($Propiedad->imagen):$Propiedad->imagen}}" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;width: 100%;height: 100%;z-index: -11;" alt="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2>DETALLE DE LA PROPIEDAD</h2>
            <ol class="breadcrumb">
            <li><a href="{{route('web.inicio')}}">INICIO</a></li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Proerty header  -->
  <!-- Start Properties  -->
  <section id="aa-properties">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="aa-properties-content">
            <!-- Start properties content body -->
            <div class="aa-properties-details">
             <div class="aa-properties-details-img">
               @if($Galeria[0]->ubicacion != null)
                 @foreach ($Galeria as $item)
                  <img src="{{asset($item->ubicacion)}}" alt="img">
                 @endforeach
               @else
                <img src="{{asset('frontend\asset\img\camera.jpg')}}" alt="img">
               @endif
             </div>
             <div class="aa-properties-info">
               <h2>{{$Propiedad->DescripcionPropiedad}}</h2>
               <span class="aa-price" style="    font-size: 1.4rem;
               background: #fbff00;
               padding: 5px 10px;
               border-radius: 50px;margin:0">
                LA NOCHE :  {{($Propiedad->moneda == 'SOLES')?'S/ ':(($Propiedad->moneda == 'DOLAR')?'$ ':'E ')}} {{$Propiedad->precio}}
              </span>
              <br>
              <span class="aa-price" style=" font-size: 1.4rem;
              background: #ffb716;
              padding: 5px 10px;
              border-radius: 50px;">
                EL MES : {{($Propiedad->moneda == 'SOLES')?'S/ ':(($Propiedad->moneda == 'DOLAR')?'$ ':'E ')}} {{($Propiedad->precio_mensual == null)?'--':$Propiedad->precio_mensual}}
              </span>
               <p>{{$Propiedad->informacion}}</p>
               <h4>Características de la Propiedad</h4>
               <ul>
                 @foreach ($Caracteristicas as $item)
                  <li>{{$item->descripcion}}</li>
                 @endforeach
               </ul>
               @empty(!$Propiedad->video)
                <h4>Video de la propiedad</h4>
                <iframe width="100%" height="480" src="{{$Propiedad->video}}" frameborder="0" allowfullscreen></iframe>
               @endempty
               <h4>Ubicación de la Propiedad</h4>
               <p><a href="https://google.cl/maps/place/{{$Propiedad->longitud}},{{$Propiedad->latitud}}" target="_black">{{$Propiedad->Departamento}} / {{$Propiedad->Provincia}} / {{$Propiedad->Distrito}} / {{$Propiedad->direccion}}</a></p>
               <div id="map-resumen" style="height: 500px;" class="map">
               </div>
               {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6851.201919469417!2d{{$Propiedad->longitud}}!3d{{$Propiedad->latitud}}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x888bdb60cc49c571%3A0x40451ca6baf275c7!2s36008+AL-77%2C+Talladega%2C+AL+35160%2C+USA!5e0!3m2!1sbn!2sbd!4v1460452919256" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> --}}
             </div>
             <!-- Properties social share -->
            </div>
          </div>
        </div>
        <!-- Start properties sidebar -->
        <div class="col-md-4">
          <div class="aa-contact-form" style="display: flex;flex-wrap: wrap;justify-content: center;background:#e7eef0">
            <h4 class="title-mensaje">Mensaje</h4>
            <form id="formProceso" class="form_solicitar row col-xs-12" action="{{route('app.solicitudproceso')}}" method="post">
              @csrf
              <input type="hidden" name="itmPublicacion" id="itmPublicacion" value="{{$Propiedad->idPropiedad}}">
              <div class="col-md-12" style="padding-bottom:1rem;">
                <div class="input-container-main">
                  <!-- <label for="input-email" class="label-form-main" style="">Documento</label> -->
                  <select class="select-form-main" name="imtTurno">
                    <option value="Dia">Día</option>
                    <option value="Noche">Noche</option>
                  </select>
                  <!-- <input id="input-email" type="text" name="email" inputmode="text" class="input-form-main"  value="" placeholder=""> -->
                </div>
              </div>
              <div class="col-md-12" style="padding-bottom:1rem;">
                <div class="input-container-main">
                  <input id="itmVisita" type="date" name="itmVisita" autocomplete="off" class="input-form-main"  value="" placeholder="">
                  <label for="itmVisita" class="label-form-main" style="background:#fff;width: 50%">Dia Visita</label>
                </div>
              </div>
              <div class="col-md-12" style="padding-bottom:1rem;">
                <div class="input-container-main">
                  <input id="itmCorreo" type="email" name="itmCorreo" autocomplete="off" class="input-form-main"  value="" placeholder="">
                  <label for="itmCorreo" class="label-form-main" style="">Correo</label>
                </div>
              </div>
              <div class="col-md-12" style="padding-bottom:1rem;">
                <div class="input-container-main">
                  <input id="itmTelefono" type="text" name="itmTelefono" autocomplete="off" class="input-form-main"  value="" placeholder="">
                  <label for="itmTelefono" class="label-form-main" style="">Telefono</label>
                </div>
              </div>
              <div class="col-md-12 px-3 pt-5 pb-3" style="padding-bottom:1rem;">
                <div class="input-container-main">
                  <textarea style="height: 140px!important;" name="itmInformacion" id="itmInformacion" placeholder="Mensaje" class="input-form-main" autocomplete="off" rows="8" cols="6"></textarea>
                  <!-- <label for="itmInformacion" class="label-form-main" style="">Descripción</label> -->
                </div>
              </div>
              <div class="col-md-12" style="margin-bottom:50px">
                <div class="d-flex" style="display:flex;justify-content:center;">
                  <div class="col-md-12">
                    <button type="button" id="btnContactar" class="btn" name="button">Contactar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @php
      $auth = (Auth::check() ? Auth::user()->id_usuario : 0);
  @endphp
  <!-- / Properties  -->
@endsection

@section('script')
  <!-- <script src="{{asset('backend/asset/lib/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('lib/gmap/markerclusterer.js')}}"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_5nony-2rp7PWwEipl9Yx-o510ATWZvk"></script>
  <script src="{{asset('lib/gmap/gmaps.js')}}"></script>

  <script>
   var botmanWidget = {
    // aboutText: 'Write Something',
    introMessage: `¡Hola! Soy Noely, el contestador automático de SweetHome. ¡Somos la mejor plataforma de servicios de alquiler de casas de playa en el norte del Perú! 😎. 
                  ¿Cuál es tu Nombre ?`,
    title:'Noely',
    chatServer: '/botman',
    placeholderText:'Escribir mensaje...',
    mainColor:'linear-gradient(90deg, rgba(13,85,191,1) 0%, rgba(13,157,191,1) 79%, rgba(0,173,142,1) 100%)',
    bubbleBackground:'blue',
    bubbleAvatarUrl:'https://images.asksuite.com/09d624cc-52f3-4d00-803f-18bbe3b4e2a5.gif',
    userId: @json($auth)+'-'+@json($Propiedad).id_propiedad,
    // placeholderText:'Escribient'
};
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

  <script type="text/javascript">
    function EjecutarProceso() {
      $.ajax({
          type: "post",
          url: $('#formProceso').attr('action'),
          data: $('#formProceso').serialize(),
          dataType: "json",
          headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            if (response.Status == 'Success') {
              $('#formProceso')[0].reset();
              swal({
                title: 'Resultado',
                text: response.Mesagge,
                icon: "success",
              });
            }else{
              swal({
                title: response.Meta.Error_Type,
                text: response.Meta.Error_Message,
                icon: "error",
              });
            }
          }
      });
    }
    $('#btnContactar').click(function () {
      EjecutarProceso();
    })
  </script>
  <script>

    var markerClusterer_atendidas = null;
    var estilo = [{
        url: "https://images.vexels.com/media/users/3/199996/isolated/preview/f79ce454b6b358fcc1275f74173da3d6-icono-de-ubicacion-isometrico.png",
        height: 48,
        width: 30,
        anchor: [-18, 0],
        textColor: '#ffffff',
        textSize: 10,
        iconAnchor: [15, 48]
    }];
    var map_atendidas = new GMaps({
      el: '#map-resumen',
      lat: @JSON($Propiedad).latitud,
      lng: @JSON($Propiedad).longitud,
      zoom: 17,
      zoomControl : true,
      zoomControlOpt: {
          style : 'SMALL',
          position: 'TOP_LEFT'
      },
      panControl : false,
      streetViewControl : false,
      mapTypeControl: false,
      overviewMapControl: false,
      markerClusterer: function(map) {
          options = {
              gridSize: 40,
              styles:estilo
          }
          return markerClusterer_atendidas = new MarkerClusterer(map, [], options);
      }
    });

    map_atendidas.addListener("click", () => {
      window.open("https://google.cl/maps/place/"+@JSON($Propiedad).latitud+","+@JSON($Propiedad).longitud+"", '_blank');
    });
  
    var control = null;
  
    function mapa_load(){
      // alert('assa');
      if (markerClusterer_atendidas) {
          markerClusterer_atendidas.clearMarkers();
      }
      const svgMarker = {
          path: "M10.453 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
          fillColor: 'red',
          fillOpacity: 1,
          strokeWeight: 1,
          rotation: 0,
          scale: 2,
          anchor: new google.maps.Point(15, 30),
        };
        // console.log(@JSON($Propiedad).latitud + ' - ' + @JSON($Propiedad).longitud);
      map_atendidas.addMarker({
          lat: @JSON($Propiedad).latitud,
          lng: @JSON($Propiedad).longitud,
          title:'Propiedad',
          label:'Propiedad',
          icon: svgMarker
      });
    }
    document.addEventListener('DOMContentLoaded', function() {
      mapa_load();
    });
  </script>
@endsection
