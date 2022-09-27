@extends('web.layout.appWeb')

@section('Content')
  <link rel="stylesheet" href="{{asset('lib/sweetalert2/dist/sweetalert2.min.css')}}">
  <style>
    .swal2-popup {
      font-size: 1.6rem!important;
    }
    input[disabled]{
      cursor: no-drop;
      background: #d5d5d5!important;
    }
  </style>
  <!-- Start Proerty header  -->

  <section id="aa-property-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2>Crear una Cuenta !</h2>
            <ol class="breadcrumb">
            <li><a href="./">Inicio</a></li>
            <li class="active">Registro</li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Proerty header  -->

 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
          <div class="aa-contact-area" style="background-color: #f3f7f8;">
            <div class="aa-contact-bottom">
              <div class="aa-title">
                <h2>Registro</h2>
                <span></span>
              </div>
              <div class="aa-contact-form" style="display: flex;flex-wrap: wrap;justify-content: center;">
                <form id="formRegistro" class="form_registro row col-xs-6" action="{{route('web.registrar.arrendador')}}" method="post">
                  @csrf
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <!-- <label for="input-email" class="label-form-main" style="">Documento</label> -->
                      <select class="select-form-main" class="validar-formulario" text-validate="Ingrese tipo documento" name="itmTipoDocumento" id="itmTipoDocumento">
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                      </select>
                      <!-- <input id="input-email" type="text" name="email" inputmode="text" class="input-form-main"  value="" placeholder=""> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmDocumento" type="text" name="itmDocumento" autocomplete="off" text-validate="Ingrese Documento" class="input-form-main validar-formulario"  value="" placeholder="">
                      <label for="itmDocumento" class="label-form-main" style="">Documento</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmNombre" type="text" name="itmNombre" autocomplete="off" text-validate="Ingrese Nombre" class="input-form-main validar-formulario"  value="" placeholder="">
                      <label for="itmNombre" class="label-form-main" style="">Nombres</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmApellido" type="text" name="itmApellido" autocomplete="off" text-validate="Ingrese Apellido" class="input-form-main validar-formulario"  value="" placeholder="">
                      <label for="itmApellido" class="label-form-main" style="">Apellidos</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-container-main">
                      <input id="itmRazonSocial" disabled="true"  type="text" name="itmRazonSocial" text-validate="Ingrese Razón Social"  autocomplete="off" class="input-form-main validar-formulario"  value="" placeholder="">
                      <label for="itmRazonSocial" class="label-form-main" style="">Razón Social</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmCorreo" type="text" name="itmCorreo" autocomplete="off" text-validate="Ingrese Correo" class="validar-formulario input-form-main"  value="" placeholder="">
                      <label for="itmCorreo" class="label-form-main" style="">Correo</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmTelefono" type="text" name="itmTelefono" autocomplete="off" text-validate="Ingrese Teléfono" class="validar-formulario input-form-main"  value="" placeholder="">
                      <label for="itmTelefono" class="label-form-main" style="">Teléfono</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmPassword" type="password" name="itmPassword" autocomplete="off" text-validate="Ingrese Contraseña" class="validar-formulario input-form-main"  value="" placeholder="">
                      <label for="itmPassword" class="label-form-main" style="">Contraseña</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-container-main">
                      <input id="itmConfirmarPassword" type="password" name="itmConfirmarPassword" autocomplete="off" text-validate="Confirmar Contraseña" class="validar-formulario input-form-main"  value="" placeholder="">
                      <label for="itmConfirmarPassword" class="label-form-main" style="">Confirmar Contraseña</label>
                    </div>
                  </div>
                  <div class="col-md-12" style="margin-bottom:50px;margin-top:30px">
                    <div class="d-flex" style="display:flex;justify-content:center;">
                      <div class="col-md-6">
                        <button type="button" id="btnRegistrar" class="btn" name="button">Registrar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
       </div>
     </div>
   </div>
 </section>
@endsection
@section('script')
 
  <script src="{{asset('lib/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <script>
    $('#itmTipoDocumento').change(function () {
      console.log($(this).val());
        if ($(this).val() == 'RUC') {
          $('#itmRazonSocial').prop('disabled',false);
          $('#itmNombre').prop('disabled',true);
          $('#itmApellido').prop('disabled',true);
        }else{
          
          $('#itmRazonSocial').prop('disabled',true);
          $('#itmNombre').prop('disabled',false);
          $('#itmApellido').prop('disabled',false);
        }
    });

    $('#itmDocumento').change(function () {
      console.log($(this).val().length)
      if ($('#itmTipoDocumento').val() == 'RUC') {
        if (!($(this).val().length == 11)) {
          Swal.fire({
                    title: 'Documento',
                    text:'El documento no corresponde a Ruc',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                  });
        }  
      }else{
        if (!($(this).val().length == 8)) {
          Swal.fire({
                    title: 'Documento',
                    text:'El documento no corresponde a DNI',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                  });
        }  
      }
    })

    function validarForm(){
      var validar = $('#formRegistro .validar-formulario');
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
    $('#btnRegistrar').click(function (e) {
      var validacion = validarForm();
      var DocumentoCorrecto='SI'
      if (validacion[0] == true) {
        if ($('#itmTipoDocumento').val() == 'RUC') {
          if (!($('#itmDocumento').val().length == 11)) {
            Swal.fire({
                      title: 'Documento',
                      text:'El documento no corresponde a Ruc',
                      icon: 'info',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'
                    });
            DocumentoCorrecto='NO'
          }  
        }else{
          if (!($('#itmDocumento').val().length == 8)) {
            Swal.fire({
                      title: 'Documento',
                      text:'El documento no corresponde a DNI',
                      icon: 'info',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Aceptar'
                    });
            DocumentoCorrecto='NO'
          }  
        }
        if (DocumentoCorrecto == 'SI') {
          var validarPassword = ($('#itmPassword').val() == $('#itmConfirmarPassword').val())?true:false;
          if (validarPassword) {
            $.ajax({
                url: "{{ url('/registrar/arrendador') }}",
                method: 'post',
                dataType: "JSON",
                data: $('#formRegistro').serialize(),
                success: function(result){
                    if(result.Status == 'Success'){
                      $('#formRegistro')[0].reset();
                      Swal.fire({
                        title: 'Plataforma',
                        text:result.Mesagge,
                        icon:'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = '/iniciarsesion'
                        }
                      });
                    }else{
                      Swal.fire({
                        title: result.Meta.Code,
                        html:result.Meta.Error_Message,
                        icon: result.Meta.Code == 500 ? 'error' : 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                      });
                    }
                },
                error:function(error){
                  Swal.fire({
                    title: 'Upssss!',
                    text:'El servicio no se encuentra disponible.',
                    icon:'error',
                    confirmButtonText: 'Aceptar',
                  });
                }
            });
          } else {
            Swal.fire({
              title: 'Confirmar Contraseña!',
              html:'Contraseñas diferente vuelva a ingresar',
              icon:'warning',
              confirmButtonText: 'Aceptar'
            });
          }
        }
      }else{
        var newHtml = "<ul>";
        validacion[1].forEach(element => {
          newHtml += `<li>${element}</li>`;
        });
        newHtml += "</ul>";
        Swal.fire({
          title: 'Campos Imcompletos!',
          html:newHtml,
          icon:'warning',
          confirmButtonText: 'Aceptar'
        });
      }
      
    });
  </script>
@endsection
