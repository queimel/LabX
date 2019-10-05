<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroEstado extends Model
{
    protected $fillable = ['fecha_estado', 'estado'];
}
