<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento');
    }
}
