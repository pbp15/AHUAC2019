<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Persona;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
      //se agregara una estructura condicional para la ruta
      if(!$request->ajax()) return redirect('/');

      $buscar = $request->buscarP;
      $criterio = $request->criterioP;

      if($buscar==''){
          $personas= Persona::orderBy('id','desc')->paginate(2);

      }
      else{
          $personas = Persona::where($criterio, 'like','%',$buscar .'%')->orderBy('id','desc')->paginate(2);
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


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->distrito = $request->distrito;
        $persona->provincia = $request->provincia;
        $persona->edad = $request->edad;        
        $persona->estado_civil = $request->estado_civil;
        $persona->save();

    }

 
  
    public function update(Request $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->estado_civil = $request->estado_civil;
        $persona->save();
    }

}
