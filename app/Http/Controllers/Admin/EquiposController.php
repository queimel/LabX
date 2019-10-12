<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo;
use App\Marca;
use App\Equipo;
use Illuminate\Support\Carbon;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function GetModeloPorMarca($id_marca_modelo){

        // return Modelo::find($id_marca_modelo)->modelos;
        return Modelo::where('id_marca_modelo', $id_marca_modelo)->get();

    }

    public function index()
    {
        $equipos = Equipo::all();
        return view('admin.equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $marcas = Marca::all();
         return view('admin.equipos.create', compact('marcas'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar formulario
        $data = $request->validate([
            'id_modelo_equipo' => 'required',
            'num_serie_equipo' => 'required',
            'fecha_fabricacion_equipo' => ['required', 'date'],
        ]);

        $data['id_cliente'] = 10;
        $data['id_sucursal'] = 1;
        $data['id_seccion'] = 1;
        $data['test_equipo'] = 0;
        $data['fecha_ultima_mantencion_equipo'] = Carbon::now();
        $data['fecha_fabricacion_equipo'] = Carbon::parse($data['fecha_fabricacion_equipo']);
        //dd($data);

        $equipo = Equipo::create($data);


       $equipo->save();

        return redirect()->route('admin.equipos.create')->withFlash('El equipo ha sido creado e ingresado a bodega');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
