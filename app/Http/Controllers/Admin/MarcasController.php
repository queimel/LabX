<?php

namespace App\Http\Controllers\admin;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marca;

use App\Http\Requests\MarcasRequest;

class MarcasController extends Controller
{
    /**
     * ruta: admin/equipos/marcas
     * muestra una lista con todas las marcas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select a todas las marcas
        $marcas = Marca::all();
        // redirecciona a la vista index de marcas, pasando las marcas para que puedan ser impresas en la vista
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * ruta: admin/equipos/marcas/create
     * Muestra el formulario para crear una nueva marca.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select a todos los paises
        $paises = Country::all();
        // redirecciona a la vista con el formulario pasandole los paises para que puedan ser impresos en la vista
        return view('admin.marcas.create', compact('paises'));
    }

    /**
     * ruta: admin/equipos/marcas
     * Aca se apunta con el formulario de crear, una vez aqui guarda la marca nueva en la BDDD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcasRequest $request)
    {
        // valida datos del formulario (llega por medio de la variable request)
        $data = $request->validated();

        // crea una instancia del modelo Marca (un nuevo objeto de la clase Marca) con los datos del form
        $marca = Marca::create($data);

        // hace el insert en la BBDD
        $marca->save();

        // Si todo sale bien redirecciona al index de marcas con un mensaje de exito
        return redirect()->route('admin.marcas.index')->withFlash('La marca ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // SELECT a la marca con el id
        $marca = Marca::find($id);
        $modelos = $marca->modelos;

        // redirecciona a la vista con el detalle de la marca, pasandole la marca y los modelos de esta, para que puedan ser impresos en la vista
        return view('admin.marcas.show', compact('marca', 'modelos'));
    }

    /**
     * RUTA: admin/equipos/marcas/{marca}/edit
     * Muestra el formulario para editar una marca.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // SELECT a la marca con el id
        $marca = Marca::find($id);
        //SELECT a todos los paises
        $paises = Country::all();

        // redirecciona a la vista con el formulario, pasandole los paises y la marca que corresponda, para que puedan ser impresos en la vista
        return view('admin.marcas.edit', compact('marca', 'paises'));
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
        // SELECT a la marca con el $id
        $marca = Marca::find($id);

        // valida datos del formulario
        $data = $request->validate([
            'nombre_marca' => ['required', 'string', 'max:255'],
            'origen_marca' => 'required'
        ]);

        // UPDATE a la marca correspondiente
        $marca->update($data);

        // Si todo sale bien redirecciona al index de marcas con un mensaje de exito
        return redirect()->route('admin.marcas.index')->withFlash("La marca {$marca->nombre_marca} ha sido editada");
    }

    /**
     * RUTA: admin.marcas.destroy
     * Elimina una marca de la BBDD.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // SELECT a la marca con el $id
        $marca = Marca::find($id);

        // Elimina modelos que tengan esta marca (en tabla modelos)
        $marca->modelos()->where('id_marca_modelo', $id)->delete();
        // DELETE a la marca
        $marca->delete();

        // Si todo sale bien redirecciona al index de marcas con un mensaje de exito
        return redirect()->route('admin.marcas.index')->withFlash("La marca {$marca->nombre_marca} ha sido eliminada");
    }
}
