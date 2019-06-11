<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regexpediente extends Model
{
    protected $fillable = ['idexpediente','idpersona','idoficina'
,'estado_tramite','fecha_tramite'];



public function persona()
{
    return $this->belongsTo('App\Persona');
}
public function expediente()
{
    return $this->belongsTo('App\Expediente');
}

public function oficina()
{
    return $this->belongsTo('App\Oficina');
}

}