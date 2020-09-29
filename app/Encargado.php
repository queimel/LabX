<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $fillable = [
        'id', 'id_cliente_encargado', 'nombre_encargado', 'apellidos_encargado'
    ];

    public function user() 
    { 
      return $this->morphOne('App\User', 'profile');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'id_cliente_encargado');
    }

}
