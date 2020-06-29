<?php

namespace App\Http\Controllers\admin;

use App\Cliente;
use App\Comuna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provincia;
use App\Region;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::where('parent_id', NULL)->get();
        return view('admin.clients.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = Region::all();
        return view('admin.clients.create', compact('regiones'));
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
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        // Genera una nueva instancia de la clase cliente, pasandole los datos validados
        $cliente = Cliente::create($data);

        // INSERT en tabla cliente, com parent_id NULL
        $cliente->save();

        return redirect()->route('admin.clientes.index')->withFlash('El cliente ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        $regiones = Region::all();
        return view('admin.clients.show', compact('cliente', 'regiones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $provincia = Provincia::find($cliente->comuna->id_provincia);
        $regiones = Region::all();

        $provinciasdeRegion = Provincia::where('id_region', $provincia->region->id)->get();

        $comunasdeProvincia = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.clients.edit', compact('cliente', 'regiones', 'provinciasdeRegion', 'provincia', 'comunasdeProvincia'));
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
        $cliente = Cliente::find($id);

        $data = $request->validate([
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $cliente->update($data);
        return redirect()->route('admin.clientes.index')->withFlash("El cliente {$cliente->nombre_cliente} ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('admin.clientes.index')->withFlash('Cliente eliminado');

    }

    public function getCliente($id_cliente){
        return Cliente::find($id_cliente);
    }

    public function getSucursalesPorCliente($id_cliente){
        return Cliente::with('children')->where('parent_id',$id_cliente)->get();
    }
}
