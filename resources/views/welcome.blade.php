@extends('admin.layout.master')
@section('title','Respuesta')
@section('content')
    <div style="display: flex;flex-wrap: wrap">
        <div class="col-md-4">
            <div class="card" style="box-shadow: 3px 3px 2px 4px #96a5a9;background: #0c7087;color: #fff;    position: relative;"> 
                <div style="font-size: 2rem;padding: 30px 10px;">
                    <i class="fa fa-camera"></i>
                    <span>Publicaciones</span>
                </div>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #074958;"></span>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #074958;"></span>
                <div style="font-size: 15rem;text-align: center">
                    {{$CantidadPub}}
                </div>
            </div>
        </div>
        <div class="col-md-4">    
            <div class="card" style="box-shadow: 3px 3px 2px 4px #96a5a9;background: #c22056;color: #fff;    position: relative;"> 
                <div style="font-size: 2rem;padding: 30px 10px;">
                    <i class="fa fa-edit"></i>
                    <span>Alquiler</span>
                </div>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #991843;"></span>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #991843;"></span>
                <div style="font-size: 15rem;text-align: center">
                    {{$CantidadAlq}}
                </div>
            </div>
        </div>
        <div class="col-md-4">    
            <div class="card" style="box-shadow: 3px 3px 2px 4px #96a5a9;background: #0b9ea3;color: #fff;    position: relative;"> 
                <div style="font-size: 2rem;padding: 30px 10px;">
                    <i class="fa fa-edit"></i>
                    <span>Solicitudes</span>
                </div>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #076e72;"></span>
                <span style="position: absolute;width: 100%;left: 0;height: 3px;background: #076e72;"></span>
                <div style="font-size: 15rem;text-align: center">
                    {{$CantidadSol}}
                </div>
            </div>
        </div>
    </div>
@endsection
