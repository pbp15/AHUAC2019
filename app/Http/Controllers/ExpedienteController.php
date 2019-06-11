<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Expediente;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {

        //se agregara una estructura condicional para la ruta
       if(!$request->ajax()) return redirect('/');
       
       $buscar = $request->buscarExp;
       $criterio = $request->criterioExp;

       if($buscar==''){
           $expedientes= Expediente::orderBy('id','desc')->paginate(2);

       }
       else{
           $expedientes = Expediente::where($criterio, 'like','%',$buscar .'%')->orderBy('id','desc')->paginate(2);
       }


        return [
            'pagination' => [
                'total'        => $expedientes->total(),
                'current_page' => $expedientes->currentPage(),
                'per_page'     => $expedientes->perPage(),
                'last_page'    => $expedientes->lastPage(),
                'from'         => $expedientes->firstItem(),
                'to'           => $expedientes->lastItem(),
            ],
            'expedientes' => $expedientes
      
        ];
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $expediente = new Expediente();
        $expediente ->codigo_expediente = $request->codigo_expediente;
        $expediente ->tipo_documento = $request->tipo_documento;
        $expediente ->cabecera_documento = $request->cabecera_documento;
        $expediente ->asunto_tramite = $request->asunto_tramite;
        $expediente ->nro_folio = $request->nro_folio;
        $expediente ->prioridad = $request->prioridad;
        $expediente ->fecha = $request->fecha;
        $expediente ->observaciones = $request->observaciones;
        $expediente ->save();

    }

 
  
    public function update(Request $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $expediente = Expediente::findOrFail($request->id);
        $expediente ->codigo_expediente = $request->codigo_expediente;
        $expediente ->tipo_documento = $request->tipo_documento;
        $expediente ->cabecera_documento = $request->cabecera_documento;
        $expediente ->asunto_tramite = $request->asunto_tramite;
        $expediente ->nro_folio = $request->nro_folio;
        $expediente ->prioridad = $request->prioridad;
        $expediente ->fecha = $request->fecha;
        $expediente ->observaciones = $request->observaciones;
        $expediente ->save();
    }

}
