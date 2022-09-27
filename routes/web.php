<?php

use App\Http\Middleware\AuthRuta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Negocio\VistaController;
use App\Http\Controllers\Admin\VistaAppController;
use App\Http\Controllers\Negocio\ProcesoController;
use App\Http\Controllers\Bot\ConversacionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [VistaController::class,'Inicio'])
        ->name('web.inicio');

Route::get('/detalle-propiedad/{codigo?}',[VistaController::class,'DetallePropiedad'])
       ->name('web.detalle-propiedad');

Route::get('/contactar',[VistaController::class,'Contactar'])
        ->name('web.contactar');

Route::get('/registro/arrendador',[VistaController::class,'RegistroArrendador'])
        ->name('web.arrendador');

Route::post('/registrar/arrendador',[ProcesoController::class,'RegistrarArrendador'])
        ->name('web.registrar.arrendador');

Route::get('/iniciarsesion',[AuthController::class,'IniciarSesionVista'])
        ->name('web.iniciarsesion');

Route::post('/iniciarsesion/get',[AuthController::class,'IniciarSesionProceso'])
        ->name('web.iniciarsesionproceso');

Route::post('/buscar-publicacion',[ProcesoController::class,'BuscarPublicacion'])
->name('web.buscarpublicacion');

Route::middleware([AuthRuta::class])->group(function () {
    Route::get('/app', [VistaAppController::class,'Inicio'])->name('app.inicio');
    Route::get('/realizar-publicacion',[VistaAppController::class,'RealizarPublicacion'])->name('app.realizarpublicacion');
    Route::get('/visitas-solicitud',[VistaAppController::class,'VisitaSolicitud'])->name('app.visitasolicitud');
    Route::get('/respuesta-solicitud',[VistaAppController::class,'RespuestaSolicitudVista'])->name('app.visitarespuesta');

    Route::post('/publicacion/listar',[VistaAppController::class,'ListarPublicacion'])->name('app.listarpublicacion');
    Route::post('/realizar-publicacion/proceso',[VistaAppController::class,'ProcesoPublicacion'])->name('app.realizarpublicacionproceso');
    Route::post('/solitud/proceso',[VistaAppController::class,'ProcesoSolicitud'])->name('app.solicitudproceso');
    Route::post('/visita-solicitud/listar',[VistaAppController::class,'ListarVisitaSolicitud'])->name('app.visitsolicitud');
    Route::post('/subirGaleria',[VistaAppController::class,'SubirGaleria'])->name('app.subirgaleria');
    Route::post('/respuesta-solicitus',[VistaAppController::class,'RespuestaSolicitud'])->name('app.respuestasolicitud');

    Route::post('/listar-respuesta',[VistaAppController::class,'ListarRespuesta'])->name('app.listarrespuesta');

    Route::post('/generar-contrato',[VistaAppController::class,'GenerarContrato'])->name('app.generarcontrato');
    Route::post('/enviar-notificacion-alquiler',[VistaAppController::class,'EnviarNotificacionAlquiler'])->name('app.enviarnotificacion');
    Route::post('/aceptar-alquiler',[VistaAppController::class,'AceptarAlquiler'])->name('app.aceptaralquiler');

    Route::post('/cerrar_sesion',[AuthController::class,'CerrarSesion'])->name('app.cerrarsesion');

    Route::post('/cambiarpassword',[AuthController::class,'CambiarPassword'])->name('app.cambiarpassword');

    Route::post('/plubicacion-propiedad/get',[VistaAppController::class,'PublicacionPropiedadGet'])
                        ->name('app.publicacionpropiedadget');
});

Route::match(['get', 'post'], 'botman', [ConversacionController::class, 'handle']);