<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ChangePasswordController extends Controller
{
    public function change()
    {
        return view('auth.passwords.change');
    }

    public function postChange(PasswordChangeRequest $request)
    {
        // Checking current password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }

        $request->user()->update([
            'password' => $request->password,
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
         return redirect()->route('dashboard');
    }
}
