<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    public function modelo()
    {
        return $this->belongsTo('App\Modelo');
    }
}
