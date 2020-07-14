<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_changed_at', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['profile'];
 
    public function profile()
    {
      return $this->morphTo();
    }

    public function esTecnico()
    {
        return $this->profile_type == 'App\Tecnico';
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }
        return $query->where('id', auth()->id());
    }

    public function registroEstados()
    {
        return $this->hasMany('App\RegistroEstado');
    }

    public function historicoContrasena()
    {
        return $this->hasMany('App\HistoricoContrasena');
    }

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new CustomResetPasswordNotification($token));
    }

}
