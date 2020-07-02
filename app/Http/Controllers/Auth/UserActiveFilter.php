<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserActiveFilter extends Controller
{
    public function blocked()
    {
        return view('auth.passwords.notAuthorized');
    }
}
