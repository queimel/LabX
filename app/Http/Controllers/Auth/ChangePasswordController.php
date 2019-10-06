<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function change()
    {
        $expired = false;
        return view('auth.passwords.change', compact('expired'));
    }

    public function postChange(PasswordChangeRequest $request)
    {
        // Checking current password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            $validator = validator([], []); // Empty data and rules fields
            $validator->errors()->add('current_password', 'La contraseña actual no es correcta');
            throw new ValidationException($validator);
        }

        $data = $request->validated();


        //Chequea historico contraseña
        $passwordHistories = $request->user()->historicoContrasena()->take(config('PASSWORD_HISTORY_NUM'))->get();
        foreach($passwordHistories as $passwordHistory){
            echo $passwordHistory->password;
            if (Hash::check($data['password'], $passwordHistory->password)) {
                // la contraseña coincide
                $validator = validator([], []); // Empty data and rules fields
                $validator->errors()->add('password', 'Esta contraseña ya fue usada anteriormente. Por favor ingresa otra password');
                throw new ValidationException($validator);
            }
        }

        $request->user()->update([
            'password' => $data['password'],
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);

        // registrar en historico contraseña
        $historicoContrasena = [
            'user_id' => $request->user()->id,
            'password' => $request->user()->password
        ];

        $request->user()->historicoContrasena()->create($historicoContrasena);

         return redirect()->route('dashboard');
    }
}
