<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $fillable = [
        'numero_telefono'
    ];
    public function tecnicos()
    {
        return $this->belongsToMany('App\Tecnico', 'tecnico_telefono', 'id_telefono', 'id_tecnico' );
    }
}
