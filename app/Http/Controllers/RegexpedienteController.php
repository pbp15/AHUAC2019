<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regexpediente;

class RegexpedienteController extends Controller
{
    public function index()
    {
        $regexpedientes = Regexpediente::all();
        return $regexpedientes;
    }


    public function store(Request $request)
    {
        $regexpediente = new Regexpediente();
        $regexpediente->nombre = $request->nombre;
        $regexpediente->tipo_documento = $request->tipo_documento;
        $regexpediente->num_documento = $request->num_documento;
        $regexpediente->direccion = $request->direccion;
        $regexpediente->distrito = $request->distrito;
        $regexpediente->provincia = $request->provincia;
        $regexpediente->edad = $request->edad;        
        $regexpediente->estado_civil = $request->estado_civil;
        $regexpediente->save();

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
