<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Sucursal;
use App\Seccion;
use App\Encargado;

class EncargadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::All();
        $encargados = Encargado::All();
        return view('admin.encargados.index', compact('encargados','cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::where('parent_id', NULL)->get();
        return view('admin.encargados.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_cliente_encargado' => 'required',
            'nombre_encargado' => ['required', 'string', 'max:191'],
            'apellidos_encargado' => ['required', 'string', 'max:191'],
        ]);

        $encargados = Encargado::create($data);

        $encargados->save();

        return redirect()->route('admin.encargados.index')->withFlash('El encargado ha sido creado y asignado exitosamente');
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
        $clientes = Cliente::where('parent_id', NULL)->get();
        $encargado = Encargado::Find($id);
        return view('admin.encargados.edit', compact('encargado','clientes'));
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
        $encargado = Encargado::find($id);
        // validar formulario
        $data = $request->validate([
            'nombre_encargado' => ['required', 'string', 'max:191'],
            'apellidos_encargado' => ['required', 'string', 'max:191'],
        ]);

        $encargado->update($data);

        return redirect()->route('admin.encargados.index')->withFlash("El encargado {$encargado->nombre_encargado} {$encargado->apellidos_encargado} ha sido modificado.");
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

    public function GetSucursalCliente($id){
        return Cliente::where('parent_id', $id)->get();
    }


    public function GetSeccionCliente($id){
        return Cliente::where('parent_id', $id)->get();
    }
}
