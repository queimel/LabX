<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Equipo;
use App\Repuesto;
use App\Modelo;
use App\Marca;

class RepuestosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repuestos = Repuesto::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        return view('admin.repuestos.index', compact('repuestos','marcas','modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repuestos = Repuesto::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        return view('admin.repuestos.create', compact('repuestos','marcas','modelos'));
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
            'id_modelo' => 'required',
            'nombre_repuesto' => ['required', 'string', 'max:191'],
            'nivel_repuesto' => ['required', 'string', 'max:191'],
        ]);

        $repuestos = Repuesto::create($data);

        $repuestos->save();

        return redirect()->route('admin.repuestos.index')->withFlash('El repuesto ha sido creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repuesto = Repuesto::find($id);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        return view('admin.repuestos.show', compact('repuesto','marcas','modelos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repuesto = Repuesto::find($id);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        return view('admin.repuestos.edit', compact('repuesto','marcas','modelos'));
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
        $repuesto = Repuesto::find($id);
        // validar formulario
        $data = $request->validate([
            'nombre_repuesto' => ['required', 'string', 'max:191'],
            'nivel_repuesto' => ['required', 'string', 'max:191'],
        ]);

        $repuesto->update($data);

        return redirect()->route('admin.repuestos.index')->withFlash("El repuesto {$repuesto->nombre_repuesto} ha sido modificado.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repuesto = Repuesto::find($id);
        $repuesto->delete();
        return redirect()->route('admin.repuestos.index')->withFlash("El repuesto {$repuesto->nombre_repuesto} ha sido eliminado.");
    }
}
