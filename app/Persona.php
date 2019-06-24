<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{


    protected $fillable = ['nombre','tipo_documento','num_documento','direccion','telefono','email'];

    public function solicitante()
    {
        return $this->hasOne('App\Solicitante');
    }


 public function user(){
     return $this->hasOne('App\User');
     //LA TABLA PERSONA ES MAYOR HACIENDO REFERENCIA
     //EN EL MODELO PERSONA CON EL HASONE AL MODELO USER
     //
     //
     //
     //
 }
}



