<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{

    protected $fillable = [
        'id_modelo', 'nombre_repuesto', 'nivel_repuesto'
    ];

    public function modelo()
    {
        return $this->belongsTo('App\Modelo','id_modelo');
    }
}
