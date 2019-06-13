<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'usuario', 'password','condicion','idrol'
    ];
     public $timestamps =false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ // hideen para decir q password es un campo oculto
        'password', 'remember_token',
    ];
    
    public function rol(){
     return $this->belongsTo('App\Rol');
    }

    //un usuario le pertenece a un rol
    //
    //
    //

    public function persona(){

         return $this->belongsTo('App\Persona');

    }
    // un usuario le pertenece a un persona 
    //LA TABLA USER ES LA MENOR
    //POR LO TANTO en el modelo USER CONTIENE AL BELONGSTO HACIENDO REFERENCIA 
    //A LA TABLA PERSONA




}
