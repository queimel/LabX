<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function comunas()
    {
        return $this->hasMany('App\Comunas');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Region');
    }
}
