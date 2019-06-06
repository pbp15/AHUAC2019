<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = ['codigo_expediente','tipo_documento','cabecera_documento'
,'asunto_tramite','nro_folio','prioridad','fecha','observaciones'];
}


