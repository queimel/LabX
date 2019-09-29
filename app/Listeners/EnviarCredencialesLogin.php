<?php

namespace App\Listeners;

use App\Events\UsuarioCreado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
