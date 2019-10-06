<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpiredPasswordController extends Controller
{
    public function expired()
    {
        $expired = true;
        return view('auth.passwords.change', compact('expired'));
    }
}
