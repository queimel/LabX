<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Equipo;
use App\Cliente;
use App\Tecnico;
use App\Mantenimiento;
use Carbon\Carbon;

class MantenimientosClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cliente = auth()->user()->profile->cliente;
        $equipos = Equipo::where('id_cliente_equipo', $cliente->id)->get();

        $mantenimientos = collect();

        foreach ($equipos as $equipo) {
            foreach ($equipo->mantenimientos as $mantenimiento) {
                $mantenimientos->push($mantenimiento);
            }
        }

        return view('admin.mantenimientos-cliente.index', compact('mantenimientos'));
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
        return view('admin.mantenimientos-cliente.show', compact('mantenimiento'));
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
