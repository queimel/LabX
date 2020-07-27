<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Provincia;
use App\Region;
use App\Cliente;
use App\Comuna;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\SeccionesRequest;

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
    public function create($id)
    {
        $sucursal = Cliente::find($id);
        $regiones = Region::all();
        return view('admin.secciones.create', compact( 'sucursal', 'regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SucursalesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionesRequest $request)
    {
        // validar formulario
        $data = $request->validated();

        $seccion = Cliente::create($data);

        $seccion->save();

        return redirect()->route('admin.clientes.edit', $seccion->parent->parent)->withFlash("La sección {$seccion->nombre_cliente} ha sido creada");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seccion = Cliente::find($id);
        return view('admin.secciones.destroy', compact('seccion'));
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
    public function update(SeccionesRequest $request, $id)
    {
        $seccion = Cliente::find($id);

        $data = $request->validated();

        $seccion->update($data);
        return redirect()->route('admin.clientes.edit', $seccion->parent->parent)->withFlash("La sección {$seccion->nombre_cliente} ha sido editada");
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
        return redirect()->route('admin.clientes.edit', $seccion->parent->parent)->withFlash('Sección eliminada con exito');
    }
}
