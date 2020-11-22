<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $fillable = [
        'id', 'id_equipo_mantenimiento', 'id_tecnico_mantenimiento', 'fecha_mantenimiento', 'status'
    ];

    protected $guarded = [];

    public function equipo()
    {
        return $this->belongsTo('App\Equipo', 'id_equipo_mantenimiento');
    }

    public function tecnico()
    {
        return $this->belongsTo('App\Tecnico', 'id_tecnico_mantenimiento');
    }

    public function logs()
    {
        return $this->hasMany('App\LogMantenimiento', 'id_mantenimiento');
    }
}
