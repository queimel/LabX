<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'id' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $ultimoRegistro = DB::table('clientes')->latest()->first();

        $data['id_sucursal'] = $ultimoRegistro->id_sucursal + 1;
        $data['id_seccion'] = 0;

        $sucursal = Cliente::create($data);

        $cliente = Cliente::find($request->id);


        $sucursal->save();

        return redirect()->route('admin.clientes.show', $cliente)->withFlash('La sucursal ha sido creada');
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
        //
        $sucursal = Cliente::find($id);
        $comuna = Comuna::find($cliente->id_comuna);
        $provincia = Provincia::find($comuna->id_provincia);
        $region = Region::find($provincia->id_region);

        $regiones = Region::all();

        $provinciasSeleccionadas = Provincia::where('id_region', $region->id)->get();
        $comunasSeleccionadas = Comuna::where('id', $provincia->id)->get();



        return view('admin.clients.edit', compact('cliente', 'regiones', 'region', 'provinciasSeleccionadas', 'comuna', 'provincia', 'comunasSeleccionadas'));
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
