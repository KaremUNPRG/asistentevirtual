$(document).ready(function () {
    var table =  $('#table_info').DataTable({
                    "ajax":{
                        url:'/visita-solicitud/listar',
                        type:'post',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                        },
                        "dataSrc": function (response) {
                            if(response.Status == 'Success'){
                                return response.Data
                            }
                        },
                    },
                    "order": [[ 2, "desc" ]],
                    "deferRender": true,
                    "responsive": true,
                    "columnDefs": [
                        {
                            "title": "",
                            "targets": [ 0 ],
                            "visible": true
                        },
                        {
                            "title": "Descripción",
                            "targets": [ 1 ],
                            "visible": true
                        },
                            {
                            "title": "Dia",
                            "targets": [ 2 ],
                            "visible": true
                        },
                        {
                            "title": "Correo",
                            "targets": [ 3 ],
                            "visible": true
                        },
                        {
                            "title": "Teléfono",
                            "targets": [ 4 ],
                            "visible": true
                        },
                        {
                            "title": "Estado",
                            "targets": [ 5 ],
                            "visible": true
                        },
                        {
                            "title": "Acciones",
                            "targets": [ 6 ],
                            "visible": true
                        }
                    ],
                    "columns": [
                    {   "width": "3%",
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": '',
                        render:function (data,type,row) {
                            return `<button type="button" class="btn-info btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-plus"></i></button>`;
                        }
                    },

                    {"data":"descripcion"},
                    {
                      "data":null,
                      render:function (data,type,row) {
                        return `${row.turno} : ${row.dia}`;
                      }
                    },
                    {"data":"correo","className":'hidden-xs'},
                    {"data":"telefono","className":'hidden-xs'},

                    {
                      "data":"estado_VNT","className":'hidden-xs',
                      render:function (data,type,row) {
                        return row.estado_so;
                      }
                    },
                    {
                        "data":null,
                        "className":'hidden-xs text-center',
                        render:function (data,type,row) {
                            if (row.Respuesta != null) {
                              if (row.RespuestaAceptado == "SI") {
                                if (row.Contrato != null) {
                                  if (row.Notifico == 'SI') {
                                    if (row.Alquiler == null) {
                                      return `<a href="${row.URLContrato}" target="_black"><button type="button" class="button_control button_small btn_control_info"><i class="fa fa-eye"></i></button></a>
                                    <button type="button" class="button_control button_small btn_control_secondary"><i class="fa fa-spinner"></i></button>`;
                                    }else{
                                      return `<a href="${row.URLContrato}" target="_black"><button type="button" class="button_control button_small btn_control_info"><i class="fa fa-eye"></i></button></a>
                                    <button type="button" class="button_control button_small btn_control_success"><i class="fa fa-thumbs-up"></i></button>`;
                                    }
                                    
                                  }else{
                                    return `<a href="${row.URLContrato}" target="_black"><button type="button" class="button_control button_small btn_control_info"><i class="fa fa-eye"></i></button></a>
                                      <button data-key="${row.Contrato}" type="button" class="button_control button_small btn_control_success btn_alquiler_terminar"><i class="fa fa-university"></i></button>`;
                                    
                                  }
                                }else{
                                  return `<button data-key="${row.id_solicitud}" type="button" class="button_control button_small btn_control_warning btn_alquiler"><i class="fa fa-thumb-tack"></i></button>`;
                                }
                              }else{
                                return `<button type="button" class="button_control button_small btn_control_danger"><i class="fa fa-trash"></i></button>`;
                              }
                            }else{
                              return `<button data-key="${row.id_solicitud}" type="button" class="button_control button_small btn_control_info btn_responder"><i class="fa fa-send"></i></button>`;
                            }
                        }
                    },
                    ],
                    "language": {
                        "url": "lib/datatables/Spanish.son.json"
                    },
                    "initComplete": function(){
                    $('[data-event="tooltip"]').tooltip();
                    }
                });
    $('#table_info tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var td = $(this).closest('td');
        if ( row.child.isShown() ) {
            row.child.hide();
            td.html(`<button type="button" class="btn-info btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-plus"></i></button>`)
            // tr.removeClass('shown');
        }else {
            row.child( format(row.data()) ).show();

            td.html(`<button type="button" class="btn-danger btn" style="font-size: 12px;padding: 2px 5px;"><i class="fa fa-minus"></i></button>`)
            // tr.addClass('shown');
        }
    } );

    function format ( row ) {
        var mapa = "";
        return `<table style="width: 100%;" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td style="width: 20%;text-align: right;padding: 10px 10px;">Mensaje:</td>
            <td style="text-align: left;padding: 10px 10px;">${row.mensaje}</td>
          </tr>
          <tr>
            <td style="width: 20%;text-align: right;padding: 10px 10px;">Ubicación Propiedad:</td>
            <td style="text-align: left;padding: 10px 10px;"><a href="https://google.cl/maps/place/${row.longitud},${row.latitud}" target="_black"><i class="fa fa-map-marker"
            style="font-size: 2.5rem;color: #f71b1b;"></i></a></td>
          </tr>
        </table>`;
    }
});

$('#content-tabla').on('click','.btn_responder',function () {
    $('#itmSolicitud').val($(this).data('key'));
    $('#modal_responder').modal('show');
});

$('.btn_proceso').click(function () {
  var validacion = ValidarFormularios('#formProceso');
  if (validacion[0] == true) {
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
            Swal.fire({
              title: 'Plataforma',
              text:response.Mesagge,
              icon:'success',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#3085d6'
            });
            
            $('#modal_responder').modal('hide');
            location.reload();
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
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar'
    });
  }
});

$('#content-tabla').on('click','.btn_alquiler',function () {
    $('#itmSolicitudContrato').val($(this).data('key'));
    $('#modal_alquilar').modal('show');
});

$('#content-tabla').on('click','.btn_alquiler_terminar',function () {
  Swal.fire({
    title: 'Alquilar',
    text:'Una vez el arrendador acepte la notificación, la propiedad estará en un estado de alquilado',
    width:'50rem',
    showCancelButton: true,
    confirmButtonText: 'Enviar',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return fetch(`/enviar-notificacion-alquiler`,{
        method: "post",
        body:JSON.stringify({itmContrato:$(this).data('key')}),
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
          title: 'Enviado!',
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
});

$('.btn_proceso_contrato').click(function () {
  var validacion = ValidarFormularios('#formContrato');
  if (validacion[0] == true) {
    $('#formContrato').submit();
    Swal.fire({
      title: 'Plataforma',
      text:'PDF Creado Corectamente',
      icon:'success',
      confirmButtonText: 'Actualizar',
      confirmButtonColor: '#3085d6'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    });
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
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar'
    });
  }
});
