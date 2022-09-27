
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | </title>
    <style>
        .table-responsive{
            overflow: hidden;
        }
        .right_col{
            min-height: 100vh!important;
        }
    </style>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('backend/asset/lib/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/asset/lib/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- NProgress -->
    <link href="{{asset('backend/asset/lib/gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/asset/lib/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}">
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{asset('backend/asset/lib/gentelella/build/css/custom.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/css/main.css')}}?v={{time()}}">
    
      <link rel="stylesheet" href="{{asset('lib/sweetalert2/dist/sweetalert2.min.css')}}">
    @yield('style')
    <style>
        .bg-app{
         /* background: #e15000!important; */
       }
       th{
          text-align: center;
      }
      .num{
          text-align: center;
      }
      .swal2-popup{
        font-size: 1.7rem;
        text-transform: initial;
    }
  </style>
</head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;">
            <div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
                <div id="mCSB_1_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                    <div class="left_col scroll-view bg-app">
                        <div class="navbar nav_title bg-app" style="border: 0;">
                            <a href="{{route('app.inicio')}}" class="site_title"> <span>
                              <img src="{{asset('frontend\asset\img\logo.svg')}}" style="width: 170px;" alt=""> </span></a>
                        </div>

                        <div class="clearfix"></div>

                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <center><b style="font-size:20px">MENÚ</b></center>

                                <ul class="nav side-menu">
                                    <li><a href="{{route('app.inicio')}}"><i class="fa fa-home"></i> INICIO <span class=""></span></a></li>
                                    <li><a href="{{route('app.realizarpublicacion')}}"><i class="fa fa-camera"></i> Realizar Publicación <span class=""></span></a></li>
                                    <li><a href="{{route('app.visitasolicitud')}}"><i class="fa fa-calendar"></i> Visitas o Solicitud <span class=""></span></a></li>
                                    <li><a href="{{route('app.visitarespuesta')}}"><i class="fa fa-eye"></i> Respuesta</a></li>

                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        {{-- <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" class="bg-app" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" class="bg-app" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" class="bg-app" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" class="bg-app" data-placement="top" title="Logout" href="login.html">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div> --}}
                        <!-- /menu footer buttons -->
                    </div>
                </div>
            </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <span style="
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            display: inline-block;
        ">@yield('title')</span>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li style="padding:10px;font-weight:bold">                    
                        <button style="    border: 0px;
                        background: #fff;
                        border-bottom: 1px solid #0c7087;
                        width: 100%;
                        padding: 10px;
                        text-transform: unset;" type="button" class="btnCambiarPassword">Cambiar Contraseña</button>    
                    </li>
                    <li style="padding:10px;font-weight:bold">
                        <form action="{{route('app.cerrarsesion')}}" method="post">
                            @csrf
                            <button style="    border: 0px;
                            background: #fff;
                            border-bottom: 1px solid #0c7087;
                            width: 100%;
                            padding: 10px;
                            text-transform: unset;" type="submit">Cerrar Sesión</button>
                        </form>
                 
                    </li>

                </ul>
    </li>
</ul>
</nav>
</div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
         @yield('controles')
     </div>

     {{-- <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
          </span>
      </div>
  </div>
</div> --}}
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      @yield('content')
  </div>
</div>
</div>
</div>
</div>
<!-- /page content -->

<!-- footer content -->
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="{{asset('backend/asset/lib/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/asset/lib/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('backend/asset/lib/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('backend/asset/lib/gentelella/vendors/nprogress/nprogress.js')}}"></script>
<!-- jQuery custom content scroller -->
<script src="{{asset('backend/asset/lib/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('backend/asset/lib/gentelella/build/js/custom.min.js')}}"></script>

<script type="text/javascript">
function ValidarFormularios(content) {
    var validar = $(content+' .validar-formulario');
    var pass = true;
    var mensaje = [];
    // console.log(validar);
    validar.each(function(){
        // console.log($(this).val().trim().length);
        if ($(this).val().trim().length <= 0 && $(this).prop('disabled') == false) {
        pass = false;
        mensaje.push($(this).attr('text-validate'))
        }
    });

    return [pass,mensaje];
}
function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('script')

<script src="{{asset('lib/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script>
    $('.btnCambiarPassword').click(function () {
        Swal.fire({
            title: 'Desea Cambiar Contraseña!',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI',
            cancelButtonText: 'NO',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch(`/cambiarpassword`,{
                method: "post",
                body:JSON.stringify({itmPassword:password}),
                dataType: "json",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then(response => {
                    if (!response.ok) {
                    throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.Status == 'Success') {
                        Swal.fire({
                        title: 'Confirmado!',
                        icon: 'success',
                        confirmButtonColor: '#0db999',
                        confirmButtonText: 'Listo',
                        width:'40rem'
                        })
                        
                        location.reload();
                    }else{
                        Swal.fire({
                        text: 'Ups hubo un problema!',
                        icon: 'error',
                        confirmButtonColor: '#fd256b',
                        confirmButtonText: 'Listo'
                        })
                        Swal.showValidationMessage(
                        `${result.value.Meta.Code}: ${result.value.Meta.Error_Message}`
                        )
                    }

                    }
            })    
    })
    
</script>
</body>
</html>
