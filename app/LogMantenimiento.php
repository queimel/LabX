<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogMantenimiento extends Model
{
    protected $fillable = [
        'id_mantenimiento', 'fecha_log', 'notas'
    ];

    protected $guarded = [];

    public function mantenimiento()
    {
        return $this->belongsTo('App\Mantenimiento', 'id_mantenimiento');
    }
}
