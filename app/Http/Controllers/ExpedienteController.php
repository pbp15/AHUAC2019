<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expediente;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::all();
        return $expedientes;
    }


    public function store(Request $request)
    {
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
