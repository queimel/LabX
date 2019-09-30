<?php

namespace App\Listeners;

use App\Events\UsuarioCreado;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesLogin;

class EnviarCredencialesLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsuarioCreado  $event
     * @return void
     */
    public function handle(UsuarioCreado $event)
    {
        Mail::to($event->user)->queue(
            new CredencialesLogin($event->user, $event->password)
        );
    }
}
