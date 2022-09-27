
@php
  $Auth = App\Auth::Info();
  //dd($Auth)
@endphp
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Font awesome -->
    {{-- <link href="{{asset('frontend/asset/css/font-awesome.css')}}" rel="stylesheet"> --}}
    <!-- Bootstrap -->
    <link href="{{asset('frontend/asset/css/bootstrap.css')}}" rel="stylesheet">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/asset/css/slick.css')}}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/asset/css/nouislider.css')}}">
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{asset('frontend/asset/css/jquery.fancybox.css')}}" type="text/css" media="screen" />
    <!-- Theme color -->
    {{-- <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">      --}}

    <!-- Main style sheet -->

    <link href="{{asset('frontend/asset/icon/fontawesome/css/all.min.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/asset/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/asset/css/estilo/main.css')}}" rel="stylesheet">
    <style media="screen">
      #aa-menu-area .navbar-fixed-top {
        background-color: #36a38f;
      }
    </style>
  </head>
  <body class="aa-price-range">
  <!-- Pre Loader -->
  <div id="aa-preloader-area">
    <div class="pulse"></div>
  </div>
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-angle-double-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->
  <header id="aa-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-area">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="aa-header-left">
                  <!-- <div class="aa-telephone-no">
                    <i class="fa-solid fa-phone"></i>
                    1-900-523-3564
                  </div>
                  <div class="aa-email hidden-xs">
                    <span class="fa-solid fa-envelope"></span> info@markups.com
                  </div> -->
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="aa-header-right">
                  
                  <a href="{{route('web.arrendador')}}" style="font-size: 17px;" class="aa-register">Registrar</a>
                  @if(empty($Auth))
                    <a href="{{route('web.iniciarsesion')}}" style="font-size: 17px;" class="aa-login">Ingresar</a>
                  @else
                    <a href="{{route('app.inicio')}}">{{$Auth->nombre}}</a>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header section -->

  <!-- Start menu section -->
  <section id="aa-menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->
          <!-- Text based logo -->
           <a class="" href="{{route('web.inicio')}}">
             <img src="{{asset('frontend\asset\img\logo.svg')}}" style="width: 220px;" alt="">
           </a>
           <!-- Image based logo -->
           <!-- <a class="navbar-brand aa-logo-img" href="index.html"><img src="img/logo.png" alt="logo"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right aa-main-nav">
            <li><a style="font-size: 17px;" href="{{route('web.inicio')}}">Inicio</a></li>
               
            {{-- <li><a href="{{route('web.contactar')}}">Contactar</a></li> --}}
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </section>
  <!-- End menu section -->
  @yield('Content')
  <!-- Footer -->
  <footer id="aa-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <div class="aa-footer-area">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="aa-footer-left">
               {{-- <p>Designed by <a rel="nofollow" href="http://www.markups.io/">MarkUps.io</a></p> --}}
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="aa-footer-middle">
                <a href="https://www.facebook.com/Sweet-Home-Per%C3%BA-104427962248111"><i class="fa-brands fa-facebook"></i></a>
                {{-- <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-google-plus"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a> --}}
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="aa-footer-right">
                <a href="{{route('web.inicio')}}" style="font-size: 17px;">Inicio</a>
                {{-- <a href="{{route('web.contactar')}}">Contactar</a> --}}
                {{-- <a href="#">License</a>
                <a href="#">FAQ</a>
                <a href="#">Privacy & Term</a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / Footer -->
  <!-- jQuery library -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script src="{{asset('frontend/asset/js/jquery.min.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('frontend/asset/js/bootstrap.js')}}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{asset('frontend/asset/js/slick.js')}}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{asset('frontend/asset/js/nouislider.js')}}"></script>
   <!-- mixit slider -->
  <script type="text/javascript" src="{{asset('frontend/asset/js/jquery.mixitup.js')}}"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="{{asset('frontend/asset/js/jquery.fancybox.pack.js')}}"></script>
  <!-- Custom js -->
  <script src="{{asset('frontend/asset/js/custom.js')}}"></script>


  <!-- <script src="{{asset('frontend/asset/js/jquery.3.6.0.min.js')}}"></script> -->
  <script>
  (function ($) {
      "use strict";
      $('.input-form-main').each(function(){
          $(this).on('blur', function(){
              if($(this).val().trim() != "") {
                  $(this).addClass('label-fijo-form');
              }
              else {
                  $(this).removeClass('label-fijo-form');
              }
          })
      })
    })(jQuery);
  </script>
  @yield('script')
  </body>
</html>
