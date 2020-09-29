<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

    protected $fillable = [
        'id_modelo_equipo', 'id_cliente_equipo', 'num_serie_equipo', 'fecha_fabricacion_equipo', 'test_equipo', 'fecha_ultima_mantencion_equipo'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'id_cliente_equipo');
    }

    public function modelo()
    {
        return $this->belongsTo('App\Modelo', 'id_modelo_equipo');
    }

    public function mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento', 'id_equipo_mantenimiento');
    }
}
