<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{


    // public function sucursales()
    // {
    //     return $this->hasMany(__CLASS__, 'id_sucursal');
    // }

    // public function secciones()
    // {
    //     return $this->hasMany(__CLASS__, 'id_seccion');
    // }

    // 'nombre_cliente' => ['required', 'string', 'max:255'],
    // 'rut_cliente' => ['required', 'cl_rut'],
    // 'descripcion_cliente' => 'string',
    // 'direccion_cliente' => ['required', 'string', 'max:255'],
    // 'region_cliente' => 'required',
    // 'provincia_cliente' => 'required',
    // 'comuna_cliente' => 'required'

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
