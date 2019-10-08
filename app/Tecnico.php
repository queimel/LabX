<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    public function Telefonos()
    {
        return $this->belongsToMany('App\Telefono');
    }

    public function Mantenimientos()
    {
        return $this->hasMany('App\Mantenimiento');
    }

}
