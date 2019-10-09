<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    public function Tecnicos()
    {
        return $this->belongsToMany('App\Tecnico');
    }
}
