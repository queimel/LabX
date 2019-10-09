<?php

namespace App\Http\Controllers\admin;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $clientes = Cliente::where('id_sucursal', 0)->where('id_seccion', 0)->get();
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

           // $data['direccion_cliente'] = $data['direccion_cliente'].$data['comuna_cliente'];
           $ultimoRegistro = DB::table('clientes')->latest()->first();

           $data['id'] = $ultimoRegistro->id + 1;
           $data['id_sucursal'] = 0;
           $data['id_seccion'] = 0;

           $cliente = Cliente::create($data);


           $cliente->save();

            return redirect()->route('admin.clientes.create')->withFlash('El rol ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.clients.show');
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
