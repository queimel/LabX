<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function provincias()
    {
        return $this->hasMany('App\Provincia', 'id_region');
    }

}
