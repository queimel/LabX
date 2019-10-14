<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function comunas()
    {
        return $this->hasMany('App\Comuna', 'id_provincia');
    }

    public function region()
    {
        return $this->belongsTo('App\Region', 'id_region');
    }
}
