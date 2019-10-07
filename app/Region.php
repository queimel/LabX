<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }
}
