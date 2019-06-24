<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regexpediente extends Model
{
    protected $fillable = ['idexpediente','idsolicitante','idoficina'
,'estado_tramite','fecha_tramite'];



public function solicitante()
{
    return $this->belongsTo('App\Solicitante');
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