<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Expediente;

class ExpedienteController extends Controller
{
  

    public function index(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $expedientes = Expediente::orderBy('id', 'desc')->paginate(2);
        }
        else{
            $expedientes = Expediente::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(2);
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

    public function selectExpediente(Request $request){
        if (!$request->ajax()) return redirect('/');
 
         $filtro = $request->filtro;     
         $expedientes = Expediente::where('asunto_tramite', 'like', '%'. $filtro . '%')
         ->orWhere('codigo_expediente', 'like', '%'. $filtro . '%')
         ->select('id','asunto_tramite','codigo_expediente')
         ->orderBy('codigo_expediente', 'asc')->get();
 
         return ['expedientes' => $expedientes];
 
     }


    public function listarPdf(){

        $expedientes = Expediente::orderBy('id', 'desc')->get();
        
        $cont= Expediente::count();


        $pdf = \PDF::loadView('pdf.expedientespdf',['expedientes'=>$expedientes,'cont'=>$cont]);
        return $pdf->download('expedientes.pdf');
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $mytime = Carbon::now('America/Lima');

        $expediente = new Expediente();
        $expediente ->codigo_expediente = $request->codigo_expediente;
        $expediente ->tipo_documento = $request->tipo_documento;
        $expediente ->cabecera_documento = $request->cabecera_documento;
        $expediente ->asunto_tramite = $request->asunto_tramite;
        $expediente ->nro_folio = $request->nro_folio;
        $expediente ->prioridad = $request->prioridad;
        $expediente ->fecha = $mytime->toDateString();
        $expediente ->observaciones = $request->observaciones;
        $expediente ->save();

    }


 
  
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $expediente = Expediente::findOrFail($request->id);
        $expediente ->codigo_expediente = $request->codigo_expediente;
        $expediente ->tipo_documento = $request->tipo_documento;
        $expediente ->cabecera_documento = $request->cabecera_documento;
        $expediente ->asunto_tramite = $request->asunto_tramite;
        $expediente ->nro_folio = $request->nro_folio;
        $expediente ->prioridad = $request->prioridad;
        $expediente ->observaciones = $request->observaciones;
        $expediente ->save();
    }

}
