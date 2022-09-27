<?php

namespace App\Http\Controllers\Negocio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VistaController extends Controller
{

    public function Inicio(REQUEST $request)
    {
        $NuevaPropiedades = DB::table('pt_propiedad as pr')
            ->where('pr.estado','!=','ANU');
        if ($request->query('buscar') != null) {
            $NuevaPropiedades = $NuevaPropiedades
                ->where( function($query) use ($request){
                    $query->orWhere('pr.descripcion','LIKE','%'.$request->query('buscar').'%')
                    ->orWhere(DB::raw('(SELECT pro.nombre FROM pt_ubigeo_provincia as pro WHERE pro.id_provincia = pr.provincia)'),'LIKE','%'.$request->query('buscar').'%')
                    ->orWhere(DB::raw('(SELECT dp.nombre FROM pt_ubigeo_departamento as dp WHERE dp.id_departamento = pr.departamento)'),'LIKE','%'.$request->query('buscar').'%')
                    ->orWhere(DB::raw('(SELECT dis.nombre FROM pt_ubigeo_distrito as dis WHERE dis.id_distrito = pr.distrito)'),'LIKE','%'.$request->query('buscar').'%')
                    ->orWhere('pr.informacion','LIKE','%'.$request->query('buscar').'%');
                });                 
        }
        $NuevaPropiedades = $NuevaPropiedades->orderBy('publicacion_fecha', 'DESC');
        if ($request->query('buscar') != null) {
            $NuevaPropiedades= $NuevaPropiedades->get();
        }else{
            $NuevaPropiedades= $NuevaPropiedades->paginate(9);
        }
        // dd($NuevaPropiedades);
        return view('web.inicio')
                    ->with('NuevaPropiedad',$NuevaPropiedades)
                    ->with('Buscar',$request->query('buscar'));
    }

    public function DetallePropiedad(REQUEST $request,$codigo)
    {
        $DetallePropiedad = DB::table('pt_propiedad as pr')
                            ->select(DB::raw('*,
                            (SELECT dp.nombre FROM pt_ubigeo_departamento as dp WHERE dp.id_departamento = pr.departamento) Departamento,
                            (SELECT pro.nombre FROM pt_ubigeo_provincia as pro WHERE pro.id_provincia = pr.provincia) Provincia,
                            (SELECT dis.nombre FROM pt_ubigeo_distrito as dis WHERE dis.id_distrito = pr.distrito) Distrito,
                            pr.descripcion as DescripcionPropiedad,pr.id_propiedad as idPropiedad'))
                            ->leftjoin('pt_galeria as ga','ga.id_propiedad','=','pr.id_propiedad')
                            ->leftjoin('pt_caracteristica as ca','ca.id_propiedad','=','pr.id_propiedad')
                            ->where('pr.id_propiedad','=',$codigo)
                            ->get();
        // dd($DetallePropiedad);
        $Caracteristicar = array();
        $Galeria = array();
        foreach ($DetallePropiedad as $key => $value) {
            $posCaract = array_search($value->id_caracteristica,array_column($Caracteristicar,'id_caracteristica'));
            $posGaleria = array_search($value->id_galeria,array_column($Galeria,'id_galeria'));
            if($posCaract === false){
                array_push($Caracteristicar,$value);
            }
            if($posGaleria === false){
                array_push($Galeria,$value);
            }
        }
        $DetallePropiedad = count($DetallePropiedad) > 0 ? $DetallePropiedad[0] : null;
        // dd($Galeria);
        // dd($DetallePropiedad);
        return view('web.detallePropiedad')
                    ->with('Caracteristicas',$Caracteristicar)
                    ->with('Galeria',$Galeria)
                    ->with('Propiedad',$DetallePropiedad);
    }

    public function Contactar(REQUEST $request)
    {
        return view('web.contactar');
    }

    public function RegistroArrendador(REQUEST $request)
    {
        return view('web.arrendador.registro');
    }
}
