<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $fillable = [
        'id_marca_modelo', 'nombre_modelo', 'descripcion_modelo', 'frecuencia_modelo'
    ];

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
