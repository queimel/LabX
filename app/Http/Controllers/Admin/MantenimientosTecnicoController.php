<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Equipo;
use App\Cliente;
use App\Tecnico;
use App\Mantenimiento;
use App\LogMantenimiento;
use Carbon\Carbon;
use App\Http\Requests\MantenimientosRequest;

class MantenimientosTecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tecnico = auth()->user()->profile;
        $mantenimientos = Mantenimiento::where('id_tecnico_mantenimiento', $tecnico->id)->get();
        return view('admin.mantenimientos-tecnico.index', compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clienteId)
    {

        $cliente = Cliente::find($clienteId);
        $equipos = Equipo::where('id_cliente_equipo', $cliente->id)->get();

        // vista
        return view('admin.mantenimientos-cliente.create', compact('equipos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener un tecnico random
        $tecnico = Tecnico::inRandomOrder()->first();

        // "id_equipo_mantenimiento" => "1"
        // "fecha_mantenimiento" => "2020-10-09"

        // validar formulario
        $data = $request->validate([
            'id_equipo_mantenimiento' => 'required',
            'fecha_mantenimiento' => ['required', 'date']
        ],
        [
            'id_equipo_mantenimiento.required' => 'Debe seleccionar un equipo',
            'fecha_mantenimiento.required' => 'Debe ingresar una fecha'
        ]
        );

        $data['id_tecnico_mantenimiento'] = $tecnico->id;

        $mantenimiento = Mantenimiento::create($data);
        $mantenimiento->save();

        $log = LogMantenimiento::create(['id_mantenimiento' => $mantenimiento->id, 'fecha_log'=> Carbon::now(), 'notas' => 'Creación y asignamiento']);
        $mantenimiento->logs()->save($log);

        return redirect()->route('admin.mantenimientos-cliente.index')->withFlash("El mantenimiento ha sido creado correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        return view('admin.mantenimientos-tecnico.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        // $fecha_mantenimiento = Carbon::parse($mantenimiento->fecha_mantenimiento);
        // $mantenimiento->fecha_mantenimiento = $fecha_mantenimiento->format('d-m-Y');


        // Fecha mantenimiento formateada
        $fecha_mantenimiento = Carbon::create($mantenimiento->fecha_mantenimiento)->format('Y-m-d');
        return view('admin.mantenimientos-tecnico.edit', compact('mantenimiento', 'fecha_mantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MantenimientosRequest $request, $id)
    {
        $mantenimiento = Mantenimiento::find($id);


        // validar formulario
        $data = $request->validated();

        $mantenimiento->update($data);
        $log = LogMantenimiento::create(['id_mantenimiento' => $mantenimiento->id, 'fecha_log'=> Carbon::now(), 'notas' => $data['log_mantenimiento']]);
        $mantenimiento->logs()->save($log);

        return redirect()->route('admin.mantenimientos-tecnico.index')->withFlash("El mantenimiento ha sido modificado correctamente.");
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
