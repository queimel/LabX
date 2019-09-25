<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $usuarios = User::all();

        // cuando llegue a la url /usuarios, retorna la vista correspondiente
        return view('admin.listadoUsuarios', compact('usuarios'));
    }
}
