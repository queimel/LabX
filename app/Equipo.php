<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

    protected $fillable = [
        'id_modelo_equipo', 'id_cliente', 'id_sucursal', 'id_seccion', 'num_serie_equipo', 'fecha_fabricacion_equipo', 'test_equipo', 'fecha_ultima_mantencion_equipo'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function modelo()
    {
        return $this->belongsTo('App\Modelo', 'id_modelo_equipo');
    }

    public function mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento');
    }
}
