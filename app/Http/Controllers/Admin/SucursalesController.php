<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use App\Comuna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provincia;
use App\Region;
use Illuminate\Support\Facades\DB;

class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.sucursales.index')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cliente = Cliente::find($id);
        $regiones = Region::all();
        return view('admin.sucursales.create', compact('cliente', 'regiones'));
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

        $sucursal = Cliente::create($data);

        $sucursal->save();

        return redirect()->route('admin.clientes.show', $sucursal->parent)->withFlash('La sucursal ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sucursal = Cliente::find($id);
        $regiones = Region::all();
        return view('admin.sucursales.show', compact('sucursal', 'regiones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sucursal = Cliente::find($id);
        $provincia = Provincia::find($sucursal->comuna->id_provincia);
        $regiones = Region::all();

        $provinciasdeRegion = Provincia::where('id_region', $provincia->region->id)->get();

        $comunasdeProvincia = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.sucursales.edit', compact('sucursal', 'regiones', 'provinciasdeRegion', 'provincia', 'comunasdeProvincia'));
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
        $sucursal = Cliente::find($id);

        $data = $request->validate([
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $sucursal->update($data);
        return redirect()->route('admin.clientes.show', $sucursal->parent )->withFlash("la sucursal {$sucursal->nombre_cliente} ha sido modificada con éxito.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Cliente::find($id);
        $sucursal->delete();
        return redirect()->route('admin.clientes.show', $sucursal->parent)->withFlash('Sucursal eliminada con exito');
    }
}
