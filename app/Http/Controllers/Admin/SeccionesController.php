<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id, $id_sucursal, $id_seccion)
    {
        $seccion = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', $id_seccion)->first();
        $comuna = Comuna::find($seccion->id_comuna);
        $provincia = Provincia::find($comuna->id_provincia);
        $region = Region::find($provincia->id_region);

        $regiones = Region::all();

        $provinciasSeleccionadas = Provincia::where('id_region', $region->id)->get();
        $comunasSeleccionadas = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.secciones.edit', compact('sucursal', 'regiones', 'region', 'provinciasSeleccionadas', 'comuna', 'provincia', 'comunasSeleccionadas'));
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
