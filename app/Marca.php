<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{


    protected $fillable = [
        'nombre_marca', 'origen_marca'
    ];

    public function modelos()
    {
        return $this->hasMany('App\Modelo', 'id_marca_modelo');
    }

    public function pais()
    {
        return $this->belongsTo('App\Country', 'origen_marca');
    }

    public function equipos()
    {
        return $this->hasManyThrough('App\Equipo', 'App\Modelo');
    }
}
