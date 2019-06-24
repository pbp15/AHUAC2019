<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'solicitantes';
    protected $fillable = [
        'id', 'procedencia','edad','estado_civil'
    ];

    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    //UN PROVEEDOR PERTENECE A UNA PERSONA
}
