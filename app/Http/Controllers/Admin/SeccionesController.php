<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Provincia;
use App\Region;
use App\Cliente;
use App\Comuna;
use Illuminate\Support\Facades\DB;

class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'parent_id' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $seccion = Cliente::create($data);

        $seccion->save();

        return redirect()->route('admin.sucursales.show', $seccion->parent)->withFlash("La sección {$seccion->nombre_cliente} ha sido creada");
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
        $seccion = Cliente::find($id);
        $provincia = Provincia::find($seccion->comuna->id_provincia);
        $regiones = Region::all();

        $provinciasdeRegion = Provincia::where('id_region', $provincia->region->id)->get();

        $comunasdeProvincia = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.secciones.edit', compact('seccion', 'regiones', 'provinciasdeRegion', 'provincia', 'comunasdeProvincia'));
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
        $seccion = Cliente::find($id);

        $data = $request->validate([
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $seccion->update($data);
        return redirect()->route('admin.sucursales.show', $seccion->parent )->withFlash("la seccion {$seccion->nombre_cliente} ha sido modificada con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seccion = Cliente::find($id);
        $seccion->delete();
        return redirect()->route('admin.sucursales.show', $seccion->parent)->withFlash('Sección eliminada con exito');
    }
}
