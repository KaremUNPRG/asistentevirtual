<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Auth;

class AuthController extends Controller
{
    public static $Response = [
      'Meta'    => [
              'Debug'         => '',
              'Error_Type'    => '',
              'Code'          => -1,
              'Error_Message' => ''
            ],
      'Data'    => [],
      'Mesagge' => '',
      'Status'  => 'Success'
    ];
    public static $Code   = 200;
    public static $Header = [];

    public function __construct()
    {
      self::$Response['Meta']['Debug'] = config('app.debug');
    }

    public function IniciarSesionVista(REQUEST $request)
    {
      return view('auth.iniciarSesion');
    }

    public function IniciarSesionProceso(REQUEST $request)
    {
      try {
        $correoUser = DB::table('pt_usuario')->where('correo','=',$request->input('itmCorreo'))->first();
        if (!empty($correoUser)) {
          if (Hash::check($request->input('itmPassword'),$correoUser->password)) {
            Auth::Push($correoUser,$request);
            // $request->session()->put('auth', json_encode($correoUser));
            self::$Response['Mesagge'] = 'Usuario correcto';
            self::$Response['Data'] = [
              'Usuario' => json_encode($correoUser),
              'Url'     => '/app'
            ];
          }else{
            self::$Response['Status'] = 'Error';
            self::$Response['Meta']['Error_Type'] = 'Correo &/o Contraseña inválida';
            self::$Response['Meta']['Error_Message'] = 'La contraseña es incorrecta';
            self::$Response['Meta']['Code'] = 400;
          }
        }else{
          self::$Response['Status'] = 'Error';
          self::$Response['Meta']['Error_Type'] = 'Correo &/o Contraseña invalidad';
          self::$Response['Meta']['Error_Message'] = 'El correo no existe en nuestro servidor';
          self::$Response['Meta']['Code'] = 400;
        }
      } catch (\Exception $e) {
        self::$Response['Status'] = 'Error';
        self::$Response['Meta']['Error_Type'] = 'Server';
        self::$Response['Meta']['Error_Message'] = 'Error en el servicio';
        self::$Response['Meta']['Code'] = 500;
        if (self::$Response['Meta']['Debug']) {
          self::$Response['Meta']['Error_Tecnico'] = $e->getMessage();
        }
      }

      return response()->json(self::$Response,200,[]);
      dd($request);
    }

    public function CerrarSesion(REQUEST $request)
    {
      $request->session()->flush();
      return redirect("/");
    }

    public function CambiarPassword(REQUEST $request)
    {
      try {
        $correoUser = DB::table('pt_usuario')->where('id_usuario','=',Auth::Get()->id_usuario) 
                    ->update(['password' => Hash::make($request->itmPassword)]);
        self::$Response['Mesagge'] = 'Usuario correcto';
        
      } catch (\Exception $e) {
        self::$Response['Status'] = 'Error';
        self::$Response['Meta']['Error_Type'] = 'Server';
        self::$Response['Meta']['Error_Message'] = 'Error en el servicio';
        self::$Response['Meta']['Code'] = 500;
        if (self::$Response['Meta']['Debug']) {
          self::$Response['Meta']['Error_Tecnico'] = $e->getMessage();
        }
      }

      return response()->json(self::$Response,200,[]);
      
    }
}
