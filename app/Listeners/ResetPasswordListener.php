<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use App\HistoricoContrasena;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;

class ResetPasswordListener
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
     * @param  PasswordReset  $passwordReset
     * @return void
     */
    public function handle(PasswordReset $passwordReset)
    {


        //Chequea historico contraseña
        $passwordHistories = $passwordReset->user->historicoContrasena()->take(config('PASSWORD_HISTORY_NUM'))->get();
        foreach($passwordHistories as $passwordHistory){
            echo $passwordHistory->password;
            if (Hash::check($passwordReset->user->password, $passwordHistory->password)) {
                // la contraseña coincide
                $validator = validator([], []); // Empty data and rules fields
                $validator->errors()->add('password', 'Esta contraseña ya fue usada anteriormente. Por favor ingresa otra password');
                throw new ValidationException($validator);
            }
        }

        $historicoContrasena = [
            'user_id' => $passwordReset->user->id,
            'password' => $passwordReset->user->password
        ];

        $passwordReset->user->historicoContrasena()->create($historicoContrasena);
    }
}
