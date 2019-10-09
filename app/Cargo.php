<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public function encargados()
    {
        return $this->belongsToMany('App\Encargado');
    }
}
