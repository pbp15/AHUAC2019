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
      //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $regexpedientes = Regexpediente::join('expedientes','regexpedientes.idexpediente','=','expedientes.id')
            ->join('personas','regexpedientes.idpersona','=','personas.id')
            ->join('oficinas','regexpedientes.idoficina','=','oficinas.id')
            ->select('regexpedientes.id','regexpedientes.fecha_tramite','regexpedientes.estado_tramite',
            'expedientes.codigo_expediente','personas.nombre','oficinas.unidad_organica')
            ->orderBy('regexpedientes.id', 'desc')->paginate(3);
        }
        else{
            $regexpedientes = Regexpediente::join('expedientes','regexpedientes.idexpediente','=','expedientes.id')
            ->join('personas','regexpedientes.idpersona','=','personas.id')
            ->join('oficinas','regexpedientes.idoficina','=','oficinas.id')
            ->select('regexpedientes.id','regexpedientes.fecha_tramite','regexpedientes.estado_tramite',
            'expedientes.codigo.expediente','personas.nombre','oficinas.unidad_organica')
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
            $regexpediente->idpersona = $request->idpersona;
            $regexpediente->idoficina = $request->idoficina;
            $regexpediente->fecha_tramite = $mytime->toDateString();
            $regexpediente->estado_tramite ='Registrado';
            $regexpediente->save();        

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regexpediente = Regexpediente::findOrFail($request->id);
        $regexpediente->estado_tramite = 'Anulado';
        $regexpediente->save();
    }
}

   

