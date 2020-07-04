<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo;
use App\Marca;
use App\Equipo;
use App\Tecnico;
use App\Mantenimiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $data_equipo = $request->validate([
            'marca_equipo' => 'required',
            'id_modelo_equipo' => 'required',
            'num_serie_equipo' => ['required', 'unique:equipos'],
            'fecha_fabricacion_equipo' => ['required', 'date'],
        ]);


        $data_equipo['test_equipo'] = 0;
        $data_equipo['fecha_ultima_mantencion_equipo'] = Carbon::now();
        $data_equipo['fecha_fabricacion_equipo'] = Carbon::parse($data_equipo['fecha_fabricacion_equipo']);

        $equipo = Equipo::create($data_equipo);
        $equipo->save();

        // Obtener modelo equipo y la frecuencia de mantencion equipo
        $modelo_equipo = Modelo::find($data_equipo['id_modelo_equipo']);

        // Obtener un tecnico random
        $tecnico = Tecnico::inRandomOrder()->first();
        
        // Calcular la fecha de mantenimiento
        $fecha_mantenimiento = $data_equipo['fecha_ultima_mantencion_equipo']->addDays($modelo_equipo->frecuencia_modelo / 24);
       
        // crear registro en tabla mantenciones
        $mantenimiento = Mantenimiento::create([
            'id_equipo_mantenimiento' =>$equipo->id, 
            'id_tecnico_mantenimiento' => $tecnico->id, 
            'fecha_mantenimiento' => $fecha_mantenimiento
        ]);

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
        // buscar equipo especifico
        $equipo = Equipo::find($id);

        // Buscar todos los mantenimientos futuros de equipo
        $mantenimientos = Mantenimiento::where('id_equipo_mantenimiento', $equipo->id)->get();

        //Obtener fecha primer mantenimiento para setear inicio calendario
        $primer_mantenimiento = Mantenimiento::where('id_equipo_mantenimiento', $equipo->id)->first();
        $fecha_primer_mantenimiento = Carbon::parse($primer_mantenimiento->fecha_mantenimiento)->format('Y-m-d');

        return view('admin.equipos.show', compact('equipo', 'mantenimientos', 'fecha_primer_mantenimiento'));
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
        
        // obtener todos los clientes (casas matrices) para impresion en vista
        $casas_matrices = Cliente::whereNull('parent_id')->get();

        // seccion real que tiene asignada equipo
        $seccion = $equipo->cliente;

        return view('admin.equipos.edit', compact('marcas', 'equipo', 'modelosMarca', 'casas_matrices', 'seccion'));
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
            'marca_equipo' => 'required',
            'id_modelo_equipo' => 'required',
            'num_serie_equipo' => ['required'],
            'fecha_fabricacion_equipo' => ['required', 'date'],
            'id_cliente_equipo' => 'required'
        ]);

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

        return Equipo::where('id', $id_equipo)->get();

    }

    public function GetModeloPorMarca($id_marca_modelo){

        return Modelo::where('id_marca_modelo', $id_marca_modelo)->get();

    }

    public function GetEquiposPorCLiente($id_cliente){

        $equipos = Equipo::where('id_cliente_equipo', $id_cliente)->get();

        $modelos = $equipos->each(function ($equipo, $key) {
            return [$equipo->modelo, $equipo->modelo->marca];
        });
        return $modelos;

    }
}
