<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function comuna()
    {
        return $this->belongsTo('App\Comuna');
    }

    public function equipos()
    {
        return $this->hasMany('App\Equipo');
    }

    public function encargados()
    {
        return $this->hasMany('App\Encargado');
    }
}
