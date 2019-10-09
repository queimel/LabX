<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'id_comuna');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }
}
