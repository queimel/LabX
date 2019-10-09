<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function comunas()
    {
        return $this->hasMany('App\Comuna', 'id_provincia');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Region');
    }
}
