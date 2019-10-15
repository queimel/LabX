<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    public function tecnicos()
    {
        return $this->belongsToMany('App\Tecnico', 'tecnico_telefono', 'id_tecnico');
    }
}
