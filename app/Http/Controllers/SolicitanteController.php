<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Solicitante;
use App\Persona;

class SolicitanteController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Solicitante::join('personas','solicitantes.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento',
            'personas.num_documento','personas.direccion','solicitantes.procedencia','solicitantes.edad','solicitantes.estado_civil')
            ->orderBy('personas.id', 'desc')->paginate(3);
        

        }
        else{
            $personas = Solicitante::join('personas','solicitantes.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento',
            'personas.num_documento','personas.direccion','solicitantes.procedencia','solicitantes.edad','solicitantes.estado_civil')           
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }


    public function selectSolicitante(Request $request){
      if (!$request->ajax()) return redirect('/');
       
         $filtro = $request->filtro;
         $solicitantes = Solicitante::join('personas','solicitantes.id','=','personas.id')
         ->where('personas.nombre', 'like', '%'. $filtro . '%')
         ->orWhere('personas.num_documento', 'like', '%'. $filtro . '%')
         ->select('personas.id','personas.nombre','personas.num_documento')
         ->orderBy('personas.nombre', 'asc')->get();
 
         return ['solicitantes' => $solicitantes];


 
     }
 

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->save();

            $solicitante = new Solicitante();
            $solicitante->procedencia = $request->procedencia;
            $solicitante->edad = $request->edad;
            $solicitante->estado_civil = $request->estado_civil;
            $solicitante->id = $persona->id;
            $solicitante->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }

  
  
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $solicitante = Solicitante::findOrFail($request->id);

            $persona = Persona::findOrFail($solicitante->id);

            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->save();

            
            $solicitante->procedencia = $request->procedencia;
            $solicitante->edad = $request->edad;
            $solicitante->estado_civil = $request->estado_civil;
            $solicitante->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
}
