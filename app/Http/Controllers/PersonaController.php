<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return $personas;
    }


    public function store(Request $request)
    {
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
