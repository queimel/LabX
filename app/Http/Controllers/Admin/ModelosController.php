<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Modelo;

use App\Http\Requests\ModelosRequest;

class ModelosController extends Controller
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
    public function create($id_marca)
    {
        $marca = Marca::find($id_marca);
        return view('admin.modelos.create', compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelosRequest $request)
    {

        $data = $request->validated();
        $modelo = Modelo::create($data);
        $modelo->save();
        $marca = Marca::find($data['id_marca_modelo']);

        return redirect()->route('admin.marcas.edit', $marca)->withFlash("El modelo {$modelo->nombre_modelo} ha sido creado con exito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = Modelo::find($id);
        return view('admin.modelos.destroy', compact('modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::find($id);
        $marcas = Marca::all();

        return view('admin.modelos.edit', compact('modelo', 'marcas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelosRequest $request, $id)
    {
        $modelo = Modelo::find($id);
        $marca = $modelo->marca;

        $data = $request->validated();

        $modelo->update($data);

        return redirect()->route('admin.marcas.edit', $marca)->withFlash("El modelo {$modelo->nombre_modelo} ha sido editado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = Modelo::find($id);

        $modelo->delete();

        return redirect()->route('admin.marcas.edit', $modelo->marca)->withFlash("El modelo {$modelo->nombre_modelo} ha sido eliminado");
    }
}
