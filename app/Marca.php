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
        return $this->hasMany('App\Modelo');
    }

    public function pais()
    {
        return $this->belongsTo('App\Country', 'origen_marca');
    }
}
