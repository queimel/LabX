<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Provincia;
use App\Region;
use App\Cliente;
use App\Comuna;
use Illuminate\Support\Facades\DB;

class SeccionesController extends Controller
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
    public function create()
    {
        $clientes = Cliente::where('id_sucursal', 0)->where('id_seccion', 0)->get();

        // $cliente = Cliente::find($id);
        // $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $regiones = Region::all();

        return view('admin.secciones.create', compact('clientes','sucursal', 'regiones'));
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
            'id_sucursal' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $id_cliente = $data['id'];
        $id_sucursal = $data['id_sucursal'];

        $ultimoRegistro = DB::table('clientes')->where('id', $id_cliente )->where('id_sucursal', $id_sucursal)->latest('id_seccion')->first();

        $data['id_seccion'] = $ultimoRegistro->id_seccion + 1;

        $seccion = Cliente::create($data);


        $seccion->save();

        return redirect()->route('admin.sucursales.show', ['cliente'=>$id_cliente,'sucursal'=>$id_sucursal])->withFlash('La seccion ha sido creada');
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
    public function edit($id, $id_sucursal, $id_seccion)
    {
        $cliente = Cliente::find($id);
        $seccion = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', $id_seccion)->first();
        $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $comuna = Comuna::find($seccion->id_comuna);
        $provincia = Provincia::find($comuna->id_provincia);
        $region = Region::find($provincia->id_region);


        $regiones = Region::all();

        $provinciasSeleccionadas = Provincia::where('id_region', $region->id)->get();
        $comunasSeleccionadas = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.secciones.edit', compact('cliente','sucursal', 'seccion', 'regiones', 'region', 'provinciasSeleccionadas', 'comuna', 'provincia', 'comunasSeleccionadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_sucursal, $id_seccion)
    {
        $cliente = Cliente::find($id);
        $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $data = $request->validate([
            'id' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $nombre_cliente = $data['nombre_cliente'];
        $descripcion_cliente = $data['descripcion_cliente'];
        $direccion_cliente = $data['direccion_cliente'];
        $id_comuna = $data['id_comuna'];

        $updateSucursal = DB::update('UPDATE `clientes` SET `nombre_cliente` = ?, `descripcion_cliente`=  ?, `direccion_cliente`= ?, `id_comuna` = ? WHERE `id`= ? AND id_sucursal= ? AND id_seccion= ?' , [$nombre_cliente,  $descripcion_cliente,$direccion_cliente, $id_comuna, $id, $id_sucursal, $id_seccion ]);

        if($updateSucursal){
            return redirect()->route('admin.sucursales.show', ['cliente'=>$cliente->id,'sucursal'=>$sucursal->id_sucursal])->withFlash('La seccion ha sido modificada');
        }else {
            echo 'falla la wea';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_sucursal, $id_seccion)
    {
        $cliente = Cliente::find($id);
        $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $deleteSeccion = DB::delete('DELETE from `clientes` WHERE `id`=? AND `id_sucursal`=? AND id_seccion= ?',[$id, $id_sucursal, $id_seccion]);
        if($deleteSeccion){
            return redirect()->route('admin.sucursales.show', ['cliente'=>$cliente->id,'sucursal'=>$sucursal->id_sucursal])->withFlash('La seccion ha sido eliminada');
        }
    }
}
