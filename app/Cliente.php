<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'id', 'id_sucursal', 'id_seccion', 'nombre_cliente', 'rut_cliente', 'descripcion_cliente', 'direccion_cliente', 'id_comuna'
    ];

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
