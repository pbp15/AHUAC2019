<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Regexpediente;

class RegexpedienteController extends Controller
{
    public function index(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $regexpedientes = Regexpediente::join('expedientes','regexpedientes.idexpediente','=','expedientes.id')
            ->join('personas','regexpedientes.idsolicitante','=','personas.id')
            ->join('oficinas','regexpedientes.idoficina','=','oficinas.id')
            ->select('regexpedientes.id','regexpedientes.fecha_tramite','regexpedientes.estado_tramite',
            'expedientes.codigo_expediente','personas.nombre','oficinas.unidad_organica')
            ->orderBy('regexpedientes.id', 'desc')->paginate(3);
        }
        else{
            $regexpedientes = Regexpediente::join('expedientes','regexpedientes.idexpediente','=','expedientes.id')
            ->join('personas','regexpedientes.idsolicitante','=','personas.id')
            ->join('oficinas','regexpedientes.idoficina','=','oficinas.id')
            ->select('regexpedientes.id','regexpedientes.fecha_tramite','regexpedientes.estado_tramite',
            'expedientes.codigo_expediente','personas.nombre','oficinas.unidad_organica')
            ->orderBy('regexpedientes.id', 'desc')->paginate(3)          
            ->where('regexpedientes.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('regexpedientes.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $regexpedientes->total(),
                'current_page' => $regexpedientes->currentPage(),
                'per_page'     => $regexpedientes->perPage(),
                'last_page'    => $regexpedientes->lastPage(),
                'from'         => $regexpedientes->firstItem(),
                'to'           => $regexpedientes->lastItem(),
            ],
            'regexpedientes' => $regexpedientes
        ];
    }



    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
            $mytime = Carbon::now('America/Lima');

            $regexpediente = new Regexpediente();
            $regexpediente->idexpediente = $request->idexpediente;
            $regexpediente->idsolicitante = $request->idsolicitante;
            $regexpediente->idoficina = $request->idoficina;
            $regexpediente->fecha_tramite = $mytime->toDateString();
            $regexpediente->estado_tramite ='Registrado';
            $regexpediente->save();        

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function pdf(Request $request,$id){

    
        $regexpediente = Regexpediente::join('expedientes','regexpedientes.idexpediente','=','expedientes.id')
        ->join('personas','regexpedientes.idsolicitante','=','personas.id')
        ->join('oficinas','regexpedientes.idoficina','=','oficinas.id')
        ->select('regexpedientes.id','regexpedientes.fecha_tramite','regexpedientes.estado_tramite',
        'expedientes.codigo_expediente','expedientes.asunto_tramite','expedientes.prioridad',
        'expedientes.observaciones','personas.nombre','personas.tipo_documento',
        'personas.num_documento','oficinas.unidad_organica','oficinas.division','oficinas.responsable')
        ->where('regexpedientes.id','=',$id)
        ->orderBy('regexpedientes.id', 'desc')->take(1)->get();

         $numregistro=Regexpediente::select('idsolicitante')->where('id',$id)->get();

         
        $pdf = \PDF::loadView('pdf.regexpediente',['regexpediente'=>$regexpediente ]);
        return $pdf->stream('regexpediente-'.$numregistro[0]->idsolicitante.'.pdf');

  

    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regexpediente = Regexpediente::findOrFail($request->id);
        $regexpediente->estado_tramite = 'Anulado';
        $regexpediente->save();
    }
}

   

