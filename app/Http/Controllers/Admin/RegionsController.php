<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provincia;
use App\Region;

class RegionsController extends Controller
{
    public function GetProvinciasPorRegiones($id){
       return Region::find($id)->provincias;
    }

    public function GetComunasPorProvincia($id){
        return Provincia::find($id)->comunas;
     }
}
