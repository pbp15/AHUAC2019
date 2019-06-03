<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{
    
    public function index()
    {
        $oficinas = Oficina::all();
        return $oficinas;
    }


    public function store(Request $request)
    {
        $oficina = new Oficina();
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->division = $request->division;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();

    }

 
  
    public function update(Request $request, $id)
    {
        $oficina = Oficina::findOrFail($request->id);
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->division = $request->division;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();
    }


}
