<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $oficinas = Oficina::orderBy('id', 'desc')
            ->paginate(3);
        }
        else{
            $oficinas = Oficina::where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $oficinas->total(),
                'current_page' => $oficinas->currentPage(),
                'per_page'     => $oficinas->perPage(),
                'last_page'    => $oficinas->lastPage(),
                'from'         => $oficinas->firstItem(),
                'to'           => $oficinas->lastItem(),
            ],
            'oficinas' => $oficinas
        ];
    }

    public function selectOficina(Request $request){
        if (!$request->ajax()) return redirect('/');
 
         $filtro = $request->filtro;     
         $oficinas = Oficina::where('unidad_organica', 'like', '%'. $filtro . '%')
         ->orWhere('responsable', 'like', '%'. $filtro . '%')
         ->select('id','unidad_organica','responsable')
         ->orderBy('unidad_organica', 'asc')->get();
 
         return ['oficinas' => $oficinas];
 
     }




    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficina = new Oficina();
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();

    }


 
  
    public function update(Request $request, $id)
    {

        if (!$request->ajax()) return redirect('/');
        $oficina = Oficina::findOrFail($request->id);
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();
    }

    public function destroy( $id)
    {

        if (!$request->ajax()) return redirect('/');
        $oficina = Oficina::findOrFail($request->id);
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();
    }





}
