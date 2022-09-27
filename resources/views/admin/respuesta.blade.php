@extends('admin.layout.master')
@section('title','Respuesta')
@section('style')
  <link rel="stylesheet" href="{{asset('lib/datatables/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('lib/sweetalert2/dist/sweetalert2.min.css')}}">
  <style>
    .swal2-title{
        font-size: 4rem;
        text-transform: uppercase!important;
    }
    .swal2-html-container{
        font-size: 1.7rem;
        text-transform: initial;
    }
    .swal2-actions button{
        font-size: 2rem!important;
        color: white!important;
    }
    .swal2-icon-content{
        text-transform: initial!important;
    }
</style>
  <style media="screen">
    .card-main{
      padding: 10px;
      box-shadow: 1px 6px 10px 1px #9d9d9d;
      background: #fff;
      /* border: 0.1px solid #9d9d9d; */
      border: 1px solid rgb(124, 152, 167)!important;
      border-radius: 10px;
      margin: 0.4rem 0rem;
    }
    .uploader{
      align-items: center;
      background-color: #fff;
      display: flex;
      height: 200px;
      justify-content: center;
      border: 3px solid #1cb9aa;
      outline-offset: 5px;
      position: relative;
      width: 100%;
    }
    .uploader img{
      left: 0;
      right: 0;
      bottom: 0;
      height: 100%;
      opacity: 0;
      max-height: 100%;
      max-width: 100%;
      position: absolute;
      top: 0;
      transition: all 300ms ease-in;
      z-index: 100;
      width: 100%;
    }
    .loaded-active{
      opacity: 1!important;
    }
    .uploader i{
      font-size: 5rem;
      color: grey;
    }
    .uploader input{
      display: none;
    }
  </style>
@endsection
{{--
  @section('controles')
  <button type="button" class="button_control btn_nueva_publicacion" name="button"><i class="fa fa-plus"></i> Nueva Publicación</button>
@endsection
--}}
@section('content')
<div class="row">
  <div style="background: #f7f7f7;padding: 1rem;margin: 0px -7px;margin-top: -10px;box-shadow: 1px 3px 2px 0px #b3c1c5;display: flex;flex-wrap: wrap;">
    <div style="padding-right: 20px;">
      <button type="button" class="button_control button_small btn_control_secondary"><i class="fa fa-spinner"></i></button>
      <span style="font-weight: bold;">Esperando Contrato</span>
    </div>
    <div style="padding-right: 20px;">
      <button type="button" class="button_control button_small btn_control_info"><i class="fa fa-eye"></i></button>
      <span style="font-weight: bold;">Ver Contrato</span>
    </div>
    <div style="padding-right: 20px;">
      <button type="button" class="button_control button_small btn_control_danger"><i class="fa fa-trash"></i></button>
      <span style="font-weight: bold;">No acepto</span>
    </div>
    <div style="padding-right: 20px;">
      <button type="button" class="button_control button_small btn_control_success "><i class="fa fa-check"></i></button>
      <span style="font-weight: bold;">Confirmar Alquiler</span>
    </div>
    <div style="padding-right: 20px;">
      <button type="button" class="button_control button_small btn_control_success"><i class="fa fa-thumbs-up"></i></button>
      <span style="font-weight: bold;">Alquilado</span>
    </div>
    <div>
      <button type="button" class="button_control button_small btn_control_warning"><i class="fa fa-spinner"></i></button>
      <span style="font-weight: bold;">Esperando Notificación Alquiler</span>
    </div>
  </div> 
  <div class="col-xs-12" id="content-tabla" style="    margin-top: 20px;">
    <table id="table_info" class="table table-striped jambo_table bulk_action" style="width:100%">
    </table>
  </div>
</div>
<div class="modal fade" id="modal_responder" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment"></i> Responder</h4>
      </div>
      <div class="modal-body">
        <form class="" id="formProceso" action="{{route('app.respuestasolicitud')}}" method="post">
          @csrf
          <input type="hidden" name="itmSolicitud" id="itmSolicitud" value="">
          <div class="d-flex">
            <div class="col-md-12">
              <input type="checkbox" class="input_control" id="itmAceptar" name="itmAceptar" value="SI">
              <label for="itmAceptar">Aceptar Demostración</label>
            </div>
            <div class="col-md-12">
              <textarea name="itmRespuesta" placeholder="Dejar Respuesta....." class="form-control" rows="8" cols="80"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="button_control btn_control-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
          <button type="button" class="button_control btn_proceso"> <i class="fa fa-save"></i> Responder</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_alquiler" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment"></i> Alquilar</h4>
      </div>
      <div class="modal-body">
        <form class="" id="formProceso" action="{{route('app.respuestasolicitud')}}" method="post">
          @csrf
          <input type="hidden" name="itmSolicitud" id="itmSolicitud" value="">
          <div class="d-flex">
            <div class="col-md-12">
              <input type="checkbox" class="input_control" id="itmAceptar" name="itmAceptar" value="SI">
              <label for="itmAceptar">Aceptar Demostración</label>
            </div>
            <div class="col-md-12">
              <textarea name="itmRespuesta" placeholder="Dejar Respuesta....." class="form-control" rows="8" cols="80"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="button_control btn_control-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
          <button type="button" class="button_control btn_proceso"> <i class="fa fa-save"></i> Responder</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script src="{{asset('lib/datatables/jszip.min.js')}}"></script>
  <script src="{{asset('lib/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('lib/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('lib/datatables/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('lib/datatables/buttons.html5.min.js')}}"></script>

  <script src="{{asset('lib/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <script src="{{asset('backend/asset/js/respuesta.js')}}?t={{time()}}" charset="utf-8"></script>
@endsection
