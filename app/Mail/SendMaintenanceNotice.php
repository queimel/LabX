<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendMaintenanceNotice extends Mailable
{
    use Queueable, SerializesModels;

    public $modelo;
    public $marca;
    public $dia_mantencion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dia_mantencion, $modelo, $marca)
    {
        $this->dia_mantencion = $dia_mantencion;
        $this->modelo = $modelo;
        $this->marca = $marca;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.maintenance-notice')->subject('Aviso de mantenimiento');
    }
}
