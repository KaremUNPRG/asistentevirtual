<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('lib\bootstrap\css\bootstrap.min.css')}}">
    <style>
    .input-container-main{
      position: relative;
    }

    .label-form-main{
      position: absolute!important;
      top: 17px!important;
      left: 12px!important;
      font-size: 14px!important;
      font-weight: 500!important;
      letter-spacing: normal!important;
      word-spacing: normal!important;
      color: rgb(124, 152, 167)!important;
      transition: color 200ms cubic-bezier(0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0, 0, 0.2, 1) 0ms;
      animation: 0s ease 0s 1 normal none running none;
    }


    .input-container-main:focus-within .label-form-main{
        transform: translateY(-10px)!important;
        font-size: 12px!important;
        color: #0cb596!important;
        font-weight: bold;
    }

    .input-form-main:focus{
      font-size: 14px!important;
      padding-top: 30px!important;
      /* border: 1.px solid #0cb596!important; */
    }
    .input-form-main,.select-form-main{
      font-family: Hind, sans-serif!important;
        border: 1px solid rgb(124, 152, 167)!important;
        border-radius: 8px!important;
        box-sizing: border-box!important;
        font-size: 14px!important;
        font-weight: 300!important;
        padding: 12px!important;
        height: 48px!important;
        width: 100%!important;
        background: rgb(255, 255, 255)!important;
        outline: none!important;
        transition: padding-top 200ms cubic-bezier(0, 0, 0.2, 1) 0ms, font-size 200ms cubic-bezier(0, 0, 0.2, 1) 0ms;
        animation: 0s ease 0s 1 normal none running none !important;
    }

    .label-fijo-form{
      font-size: 14px!important;
      padding-top: 30px!important;
    }

    .label-fijo-form + .label-form-main{
      transform: translateY(-10px)!important;
      font-size: 12px!important;
      color: #0cb596!important;
      font-weight: bold;
    }

    .btn{
      display: flex;
      flex-direction: row;
      -webkit-box-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      align-items: center;
      font-weight: bold;
      cursor: pointer;
      box-sizing: border-box;
      padding: 0px 12px;
      border-radius: 12px;
      margin: auto;
      text-align: center;
      font-size: 16px;
      background-color: #d53737;
      color: rgb(255, 255, 255);
      width: 100%;
      line-height: 48px;
    }

    .btn:focus{
      outline: inherit;
      outline-offset: 0px;
    }
    .btn:active:focus{
      outline: inherit;
      outline-offset: 0px;
    }
    </style>
</head>
<body>

  <div class="d-flex" style="height:100vh">
    <div class="col-md-8">
      <img class="w-100 h-100" src="https://www.ngenespanol.com/wp-content/uploads/2018/08/Playas-espectaculares-en-Per%C3%BA-770x413.jpg" alt="">
    </div>
    <div class="col-md-4">
      <div class="formularo p-5 my-5">
        <div class="text-center">
          <h1><img src="{{asset('frontend\asset\img\logoInvertido.svg')}}" style="width: 350px;" alt=""></h1>
        </div>
        <div class="content mt-5" >
          <form class="" action="{{route('web.iniciarsesionproceso')}}" id="formAuth" method="post">
            @csrf
            <div class="d-flex flex-wrap" style="background-color: #f3f7f8;">
              <div class="col-md-12 px-3 pt-5 pb-3">
                <div class="input-container-main">
                  <input id="itmCorreo" type="text" name="itmCorreo" autocomplete="off" class="input-form-main"  value="" placeholder="">
                  <label for="itmCorreo" class="label-form-main" style="">Correo</label>
                </div>
              </div>
              <div class="col-md-12 px-3 pt-3">
                <div class="input-container-main">
                  <input id="itmPassword" type="password" name="itmPassword" autocomplete="off" class="input-form-main"  value="" placeholder="">
                  <label for="itmPassword" class="label-form-main" style="">Contraseña</label>
                </div>
              </div>
              <div class="col-md-12 pt-4 px-3 pb-5">
                <div class="d-flex" style="display:flex;justify-content:center;">
                  <div class="col-md-12">
                    <button type="button" id="btnRegistrar" class="btn" name="button">Ingresar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="{{asset('frontend/asset/js/jquery.3.6.0.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

  $('#btnRegistrar').click(function () {
    $.ajax({
          url: "{{ url('/iniciarsesion/get') }}",
          method: 'post',
          dataType: "JSON",
          data: $('#formAuth').serialize(),
          success: function(response){
              // $('#formAuth')[0].reset();
              if (response.Status == 'Success') {
                window.location.href = response.Data.Url;
              }else{
                swal({
                  title: response.Meta.Error_Type,
                  text: response.Meta.Error_Message,
                  icon: "error",
                });
              }
          }
       });
  });
</script>
</html>
