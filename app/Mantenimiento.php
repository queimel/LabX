<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    public function equipo()
    {
        return $this->belongsTo('App\Equipo');
    }

    public function Tecnico()
    {
        return $this->belongsTo('App\Tecnico');
    }
}
