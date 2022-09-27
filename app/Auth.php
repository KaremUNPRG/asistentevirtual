<?php
namespace App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Auth
{
  public static function Push($data = '',REQUEST $request)
  {
    if (!empty($data)) {
      $request->session()->put('auth', Crypt::encryptString(json_encode($data)));
      //dd(Crypt::encryptString(json_encode($data)));
      // session('auth', Crypt::encryptString(json_encode($data)));
    }
  }

  public static function Get()
  {
    try {
      return json_decode(Crypt::decryptString(session('auth')));
    } catch (\Exception $e) {
      return null;
    }

  }

  public static function Info($tabla = 'pt_propietario',$columna = 'id_usuario')
  {
    try {
      $data = DB::table($tabla)->where($columna,'=',self::Get()->id_usuario)->first();
      return $data;
    } catch (\Exception $e) {
      return null;
    }

  }
}
