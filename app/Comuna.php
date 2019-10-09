<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }
}
