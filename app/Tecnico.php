<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = [
        'supervisor_id', 'nombre_tecnico', 'apellido_tecnico', 'run_tecnico'
    ];

    public function Telefonos()
    {
        return $this->belongsToMany('App\Telefono');
    }

    public function Mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento');
    }

    public function supervisor()
    {
        return $this->belongsTo(Tecnico::class, 'supervisor_id');
    }

    public function tecnicos()
    {
        return $this->hasMany(Tecnico::class, 'supervisor_id');
    }

}
