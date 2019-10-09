<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function cargos()
    {
        return $this->belongsToMany('App\Cargos');
    }
}
