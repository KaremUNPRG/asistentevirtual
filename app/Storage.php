<?php
namespace App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Storage
{
  public static $Path_Default = 'almacenamiento/';
  public static function Put($archivo,$contenido,$carpeta = null)
  {
    $archivo = self::$Path_Default.$carpeta.$archivo;
    try {
        file_put_contents($archivo,$contenido);
        return $archivo;
    } catch (\Exception $e) {
        return 500;
    }
  }

  public static function Mkdir($path)
  {
    $path = self::$Path_Default.$path;
    try {
      if (!file_exists($path)) {
          mkdir($path, 0777, true);
          return 200;
      }
      return 400;
    } catch (\Exception $e) {
      return 500;
    }

  }
}
