<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use App\Comuna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provincia;
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

        $ultimoRegistro = DB::table('clientes')->where('id', $data['id'])->latest('id_sucursal')->first();

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
    public function show($id, $id_sucursal)
    {
        $cliente = Cliente::find($id);
        $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $secciones = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', '<>',0)->get();

        return view('admin.sucursales.show', compact('cliente', 'sucursal', 'secciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_sucursal)
    {
        $sucursal = Cliente::where('id', $id)->where('id_sucursal', $id_sucursal)->where('id_seccion', 0)->first();
        $comuna = Comuna::find($sucursal->id_comuna);
        $provincia = Provincia::find($comuna->id_provincia);
        $region = Region::find($provincia->id_region);

        $regiones = Region::all();

        $provinciasSeleccionadas = Provincia::where('id_region', $region->id)->get();
        $comunasSeleccionadas = Comuna::where('id_provincia', $provincia->id)->get();

        return view('admin.sucursales.edit', compact('sucursal', 'regiones', 'region', 'provinciasSeleccionadas', 'comuna', 'provincia', 'comunasSeleccionadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_sucursal)
    {
        $cliente = Cliente::find($id);
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

        $updateSucursal = DB::update('UPDATE `clientes` SET `nombre_cliente` = ?, `descripcion_cliente`=  ?, `direccion_cliente`= ?, `id_comuna` = ? WHERE `id`= ? AND id_sucursal= ? AND id_seccion= 0' , [$nombre_cliente,  $descripcion_cliente,$direccion_cliente, $id_comuna, $id, $id_sucursal ]);

        if($updateSucursal){
            return redirect()->route('admin.clientes.show', $cliente)->withFlash('La sucursal ha sido modificada');
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
    public function destroy($id, $id_sucursal)
    {
        $cliente = Cliente::find($id);
        $deleteSucursal = DB::delete('DELETE from `clientes` WHERE `id`=? AND `id_sucursal`=? AND id_seccion= 0',[$id, $id_sucursal]);
        if($deleteSucursal){
            return redirect()->route('admin.clientes.show', $cliente)->withFlash('La sucursal ha sido eliminada');
        }
    }
}
