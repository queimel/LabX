<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoContrasena extends Model
{
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo('App\User');
    }
}
