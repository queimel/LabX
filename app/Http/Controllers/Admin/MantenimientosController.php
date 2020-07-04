<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mantenimiento;
use App\Cliente;
use App\Tecnico;
use Carbon\Carbon;

class MantenimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select a todas las marcas
        $mantenimientos = Mantenimiento::all();
        // redirecciona a la vista index de marcas, pasando las marcas para que puedan ser impresas en la vista
        return view('admin.mantenimientos.index', compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener todos las secciones CON EQUIPOS
        $secciones = Cliente::has('equipos')->get();
        // obtener todos los tecnicos
        $tecnicos = Tecnico::all();

        // vista
        return view('admin.mantenimientos.create', compact('secciones', 'tecnicos'));
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
                'id_tecnico_mantenimiento' => 'required',
                'id_equipo_mantenimiento' => 'required',
                'fecha_mantenimiento' => ['required', 'date']
            ],
            [
                'id_tecnico_mantenimiento.required' => 'Debe seleccionar un tecnico',
                'fecha_mantenimiento.required' => 'Debe ingresar una fecha'
            ]
        );

        $mantenimiento = Mantenimiento::create($data);
        $mantenimiento->save();

        return redirect()->route('admin.mantenimientos.index')->withFlash("El mantenimiento ha sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // select mantenimiento
        $mantenimiento = Mantenimiento::find($id);
        // redirecciona a la vista show de mantenimiento, pasando el mantenimiento para que puedan ser impreso en la vista
        return view('admin.mantenimientos.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtener el mantenimiento especifico
        $mantenimiento = Mantenimiento::find($id);

        //obtener todos los clientes y sus sucursales
        $casas_matrices = Cliente::all();

        // cliente actual
        $cliente_mantenimiento = $mantenimiento->equipo->cliente;

        // Fecha mantenimiento formateada
        $fecha_mantenimiento = Carbon::create($mantenimiento->fecha_mantenimiento)->format('Y-m-d');

        // todos los tecnicos
        $tecnicos = Tecnico::all();

        return view('admin.mantenimientos.edit', compact('mantenimiento', 'casas_matrices', 'cliente_mantenimiento', 'fecha_mantenimiento', 'tecnicos'));
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
        $mantenimiento = Mantenimiento::find($id);

            // validar formulario
        $data = $request->validate([
                'id_tecnico_mantenimiento' => 'required',
                'fecha_mantenimiento' => ['required', 'date']
            ],
            [
                'id_tecnico_mantenimiento.required' => 'Debe seleccionar un tecnico',
                'fecha_mantenimiento.required' => 'Debe ingresar una fecha'
            ]
        );

        $mantenimiento->update($data);

        return redirect()->route('admin.mantenimientos.index')->withFlash("El mantenimiento ha sido modificado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        $mantenimiento->delete();
        return redirect()->route('admin.mantenimientos.index')->withFlash("El mantenimiento ha sido eliminado.");   
    }
}
