<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    public function marca()
    {
        return $this->belongsTo('App\Marca', 'id_marca_modelo');
    }

    public function repuestos()
    {
        return $this->hasMany('App\Repuesto');
    }

    public function equipos()
    {
        return $this->hasMany('App\Equipo', 'id_modelo_equipo');
    }
}
