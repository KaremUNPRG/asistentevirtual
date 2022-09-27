@extends('web.layout.appWeb')

@section('Content')
    <style media="screen">
      .estado-alquilado{
        position: absolute;
        padding: 5px;
        background: #ff557c;
        box-shadow: 1px 2px 15px 3px #ff557c;
        color: #fff;
        font-weight: bold;
        font-size: 10px;
        border-radius: 30px;
        top: 10px;
        left: 10px;
      }
      .content-paginacion nav{
        text-align: center;
        padding-top: 30px;
      }
      .content-paginacion nav .inline-flex{
        font-size: 8rem;
        margin: 0px 30px;
        color:#259fbb;
      }
    </style>
    <!-- Start slider  -->
    <section id="aa-slider">
      <div class="aa-slider-area">
        <!-- Top slider -->
        <div class="aa-top-slider">
          <!-- Top slider single slide -->
          <div class="aa-top-slider-single">
            <img src="{{asset('frontend/asset/img/Casa01.jpg')}}" style="filter: brightness(0.5);" alt="img">
            <!-- Top slider content -->
            {{-- <div class="aa-top-slider-content">
              <span class="aa-top-slider-catg">Duplex</span>
              <h2 class="aa-top-slider-title">1560 Square Feet</h2>
              <p class="aa-top-slider-location"><i class="fa fa-map-marker"></i>South Beach, Miami (USA)</p>
              <span class="aa-top-slider-off">30% OFF</span>
              <p class="aa-top-slider-price">$460,000</p>
              <a href="#" class="aa-top-slider-btn">Read More <span class="fa fa-angle-double-right"></span></a>
            </div> --}}
            <!-- / Top slider content -->
          </div>
          <!-- / Top slider single slide -->
        </div>
      </div>
    </section>
    <!-- End slider  -->

    <!-- Advance Search -->
    <section id="aa-advance-search">
      <div class="container">
        <div class="aa-advance-search-area" style="border-radius: 10px 10px 10px 10px;
        min-height: auto!important;padding: 45px 20px;">
          <div class="form">
           <div class="aa-advance-search-top">
              <div class="row" style="display: flex;flex-wrap: wrap;justify-content: center;">
                <div class="col-md-4">
                  <div class="aa-single-advance-search">
                    <input type="text" id="itmBuscarPunlicacion" class="form-control" style="font-size: 14px" placeholder="Buscar.....">
                  </div>
                </div>
                <div class="col-md-2" style="display: none">
                  <div class="aa-single-advance-search">
                    <select class="form-control">
                     <!-- <option value="0" selected>Tipo</option> -->
                      <option value="1">Casa</option>
                      <option value="2">Departamento</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="aa-single-advance-search">
                    <input class="aa-search-btn btn-info btn btn-buscar-pub"  type="button" style="font-size: 14px;font-weight: 100" value="Buscar">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- / Advance Search -->
    <!-- Latest property -->
    <section id="aa-latest-property">
      <div class="container">
        <div class="aa-latest-property-area">
          <div class="aa-title">
            <h2>PUBLICACIONES</h2>
            {{-- <p>El precio de referencia es mensual. Precio por noche en ver detalle.</p> --}}
          </div>
          <div class="aa-latest-properties-content">
            <div class="row" style="display: flex;flex-wrap: wrap;">
              @empty(!$NuevaPropiedad)
                  @foreach ($NuevaPropiedad as $key => $item)

                    <div class="col-md-4">
                      <article class="aa-properties-item" style="height:500px">
                        @if($item->estado == 'ALQ')
                          <div class="estado-alquilado">
                            Alquilado
                          </div>
                        @endif
                        <a href="{{route('web.detalle-propiedad',['codigo'=>$item->id_propiedad])}}" class="aa-properties-item-img">
                          @php
                            $img =  $item->imagen == null ?'frontend\asset\img\camera.jpg' :$item->imagen
                          @endphp
                          <img src="{{$img}}" style="height: 250px;" alt="img">
                        </a>
                        <div class="aa-properties-item-content" style="height: 250px;">

                          <div class="aa-properties-about">
                            <h3><a href="{{route('web.detalle-propiedad',['codigo'=>$item->id_propiedad])}}" class="title-propiedad">{{$item->descripcion}}</a></h3>
                            <p class="text-informacion" style="height:100px">{{$item->informacion}}</p>
                          </div>
                          <div class="aa-properties-detial">
                            <span class="aa-price">
                              {{($item->moneda == 'SOLES')?'S/ ':(($item->moneda == 'DOLAR')?'$ ':'E ')}} {{$item->precio}} <span class="lanoche" style="font-size: 1.2rem;font-weight: bold;background: #ffd747;padding: 5px 15px;border-radius: 30px;">LA NOCHE</span>
                            </span>
                            <a style="background: #00877a;border: 0px;" href="{{route('web.detalle-propiedad',['codigo'=>$item->id_propiedad])}}" class="aa-secondary-btn">Ver Detalle</a>
                          </div>
                        </div>
                      </article>
                    </div>
                  @endforeach
              @endempty         
            </div>
            @if ($Buscar == null)
              <div class="content-paginacion">
                {{$NuevaPropiedad->links()}}
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    <!-- / Latest property -->

    <!-- Client Testimonial -->
    <section id="aa-client-testimonial">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-client-testimonial-area">
              <!-- testimonial content -->
              <div class="aa-testimonial-content">
                <!-- testimonial slider -->
                <ul class="aa-testimonial-slider">
                  <li>
                    <div class="aa-testimonial-single">
                      <div class="aa-testimonial-img">
                        <!-- <img src="{{asset("frontend/asset/img/testimonio.jpg")}}" alt="testimonial img"> -->
                      </div>
                      <div class="aa-testimonial-bio">
                        <p>KAREM MERLYN CHINCHAY ALARCÓN</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="aa-client-testimonial-area">
              <!-- testimonial content -->
              <div class="aa-testimonial-content">
                <!-- testimonial slider -->
                <ul class="aa-testimonial-slider">
                  <li>
                    <div class="aa-testimonial-single">
                      <div class="aa-testimonial-img">
                        {{-- <img src="{{asset("frontend/asset/img/testimonio.jpg")}}" alt="testimonial img"> --}}
                      </div>
                      <div class="aa-testimonial-bio">
                        <p>NOELY DEL PILAR MOSCOL MONTESTRUQUE</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Client Testimonial -->
@endsection
@section('script')
    <script>
        $('.content-paginacion nav .inline-flex:first-child').html('«');
        $('.content-paginacion nav .inline-flex:last-child').html('»');
        $('.btn-buscar-pub').click(function () {
           var buscar = $('#itmBuscarPunlicacion').val();
           window.location.href = `?buscar=${buscar}`; 
        });
    </script>
@endsection