<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Oficina;

class OficinaController extends Controller
{
    
    public function index(Request $request)
    {

        //se agregara una estructura condicional para la ruta
        //el paginate es cuanto registro quiero q se vea por pagina
        if(!$request->ajax()) return redirect('/');
        
        $buscar = $request->buscarO;
        $criterio = $request->criterioO;

        if($buscar==''){
            $oficinas= Oficina::orderBy('id','desc')->paginate(2);

        }
        else{
            $oficinas = Oficina::where($criterio, 'like','%',$buscar .'%')->orderBy('id','desc')->paginate(2);
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


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $oficina = new Oficina();
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->division = $request->division;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();

    }

 
  
    public function update(Request $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $oficina = Oficina::findOrFail($request->id);
        $oficina ->unidad_organica = $request->unidad_organica;
        $oficina ->division = $request->division;
        $oficina ->responsable = $request->responsable;
        $oficina ->save();
    }


}
