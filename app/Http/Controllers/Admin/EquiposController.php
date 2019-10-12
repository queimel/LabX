<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo;
use App\Marca;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function GetModeloPorMarca($id_marca){

        return Modelo::find($id_marca)->modelos;

    }

    public function index()
    {
        return view('admin.equipos.index');
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
        $data = $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'num_serie' => 'required',
            'fecha_fabricacion' => ['required', 'date'],
        ]);

       $data['id'] = $ultimoRegistro->id + 1;
       $data['id_sucursal'] = 0;
       $data['id_seccion'] = 0;

       $cliente = Cliente::create($data);


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
