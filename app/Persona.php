<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{


    protected $fillable = ['nombre','tipo_documento','num_documento','direccion','distrito','provincia','edad','estado_civil'];



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



