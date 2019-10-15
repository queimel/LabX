<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo;
use App\Marca;
use App\Equipo;
use Carbon\Carbon;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $equipos = Equipo::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        return view('admin.equipos.index', compact('equipos','marcas','modelos'));
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
            'num_serie_equipo' => ['required', 'unique:equipos'],
            'fecha_fabricacion_equipo' => ['required', 'date'],
        ]);


        $data['test_equipo'] = 0;
        $data['fecha_ultima_mantencion_equipo'] = Carbon::now();
        $data['fecha_fabricacion_equipo'] = Carbon::parse($data['fecha_fabricacion_equipo']);

        $equipo = Equipo::create($data);

        $equipo->save();

        return redirect()->route('admin.equipos.index')->withFlash('El equipo ha sido creado e ingresado a bodega');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo = Equipo::find($id);

        return view('admin.equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marcas = Marca::all();
        $equipo = Equipo::find($id);
        $modelosMarca = Modelo::where('id_marca_modelo', $equipo->modelo->marca->id)->get();
        return view('admin.equipos.edit', compact('marcas', 'equipo', 'modelosMarca'));
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
        $equipo = Equipo::find($id);
        // validar formulario
        $data = $request->validate([
            'id_modelo_equipo' => 'required',
            'num_serie_equipo' => ['required', 'unique:equipos'],
            'fecha_fabricacion_equipo' => ['required', 'date'],
        ]);


        $data['test_equipo'] = 0;
        $data['fecha_ultima_mantencion_equipo'] = Carbon::now();
        $data['fecha_fabricacion_equipo'] = Carbon::parse($data['fecha_fabricacion_equipo']);

        $equipo->update($data);

        return redirect()->route('admin.equipos.index')->withFlash("El equipo {$equipo->nombre_equipo} ha sido modificado.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        $equipo->delete();
        return redirect()->route('admin.equipos.index')->withFlash("El equipo {$equipo->nombre_equipo} ha sido eliminado.");

    }

    public function GetModeloPorEquipo($id_equipo){

        // return Modelo::find($id_marca_modelo)->modelos;
        return Equipo::where('id', $id_equipo)->get();

    }

    public function GetModeloPorMarca($id_marca_modelo){

        // return Modelo::find($id_marca_modelo)->modelos;
        return Modelo::where('id_marca_modelo', $id_marca_modelo)->get();

    }
}