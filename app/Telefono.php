<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $fillable = [
        'numero_telefono', 'id_tecnico'
    ];
    public function tecnico()
    {
        return $this->belongsTo('App\Tecnico', 'id_tecnico');
    }
}
