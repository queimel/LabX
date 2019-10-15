<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tecnico;

class TecnicosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnicos = Tecnico::all();
        return view('admin.tecnicos.index', compact('tecnicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisores = Tecnico::where('supervisor_id', NULL)->get();
        return view('admin.tecnicos.create', compact('supervisores'));
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
        $data = $request->validate(
            [
                'nombre_tecnico' => ['required', 'string', 'max:255'],
                'apellido_tecnico' => ['required', 'string', 'max:255'],
                'run_tecnico' => ['required', 'cl_rut', 'unique:tecnicos'],
                'telefono_tecnico' => 'required'
            ],
            [
                'run_tecnico.required' => 'Debes ingresar un RUN',
                'run_tecnico.unique' => 'Este RUN ya ha sido ingresado para otro técnico',
                'run_tecnico.cl_rut' => 'RUN no válido'
            ]
        );

        $tecnico = Tecnico::create($data);
        $tecnico->save();
        $tecnico->telefonos()->attach($data['telefono_tecnico']);

        return redirect()->route('admin.tecnicos.index')->withFlash("El técnico {$tecnico->nombre_tecnico} {$tecnico->apellido_tecnico} ha sido creado.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tecnico = Tecnico::find($id);
        return view('admin.tecnicos.show', compact('tecnico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tecnico = Tecnico::find($id);
        $supervisores = Tecnico::where('supervisor_id', NULL)->get();
        return view('admin.tecnicos.edit', compact('supervisores', 'tecnico'));
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
        $tecnico = Tecnico::find($id);
        // validar formulario
        $data = $request->validate([
            'nombre_tecnico' => ['required', 'string', 'max:255'],
            'apellido_tecnico' => ['required', 'string', 'max:255'],
            'run_tecnico' => ['required', 'cl_rut', 'unique:tecnicos']
        ],
        [
            'run_tecnico.required' => 'Debes ingresar un RUN',
            'run_tecnico.unique' => 'Este RUN ya ha sido ingresado para otro técnico',
            'run_tecnico.cl_rut' => 'RUN no válido'
        ]
    );
        $tecnico->update($data);
        return redirect()->route('admin.tecnicos.index')->withFlash("El técnico {$tecnico->nombre_tecnico} {$tecnico->apellido_tecnico} ha sido editado.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tecnico = Tecnico::find($id);
        $tecnico->delete();
        return redirect()->route('admin.tecnicos.index')->withFlash("El técnico {$tecnico->nombre_tecnico} {$tecnico->apellido_tecnico} ha sido eliminado.");
    }
}
