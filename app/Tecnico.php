<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = [
        'supervisor_id', 'nombre_tecnico', 'apellido_tecnico', 'run_tecnico'
    ];

    public function user() 
    { 
      return $this->morphOne('App\User', 'profile');
    }

    public function telefonos()
    {
        return $this->hasMany('App\Telefono', 'id_tecnico');
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
