<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'id', 'parent_id', 'nombre_cliente', 'rut_cliente', 'descripcion_cliente', 'direccion_cliente', 'id_comuna'
    ];

    public function comuna()
    {
        return $this->belongsTo('App\Comuna', 'id_comuna');
    }

    public function equipos()
    {
        return $this->hasMany('App\Equipo', 'id_cliente_equipo');
    }

    public function encargados()
    {
        return $this->hasMany('App\Encargado', 'id_cliente_encargado');
    }

    public function parent()
    {
        return $this->belongsTo(Cliente::class, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Cliente::class, 'parent_id');
    }
}
