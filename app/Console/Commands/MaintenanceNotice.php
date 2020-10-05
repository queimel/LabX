<?php

namespace App\Console\Commands;

use App\Mail\SendMaintenanceNotice;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;

use App\Mantenimiento;

use Carbon\Carbon;

class MaintenanceNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo avisando de una proxima mantencion de equipos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $mantenimientos = Mantenimiento::all();

        foreach ($mantenimientos as $mantenimiento) {
            $dia_mantencion = Carbon::parse($mantenimiento->fecha_mantenimiento);

            if( Carbon::now() <= $dia_mantencion->subDays(7)){
                $mail = $mantenimiento->equipo->cliente->encargados->first()->user->email;
                $modelo = $mantenimiento->equipo->modelo->nombre_modelo;
                $marca = $mantenimiento->equipo->modelo->marca->nombre_marca;

                try{
                    Mail::to($mail)->send(new SendMaintenanceNotice($dia_mantencion, $modelo, $marca ));
                    Log::info('mail enviado');
                } catch (\Exception $e) {
                    Log::error($e);
                }                
            }
        }
        
    }
}
