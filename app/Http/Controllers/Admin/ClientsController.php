<?php

namespace App\Http\Controllers\admin;

use App\Cliente;
use App\Comuna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provincia;
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
           $ultimoRegistro = DB::table('clientes')->latest('id')->first();

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
        $cliente = Cliente::find($id);
        $sucursales = Cliente::where('id', $id)->where('id_sucursal','<>', 0)->where('id_seccion', 0)->get();

        return view('admin.clients.show', compact('cliente', 'sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
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

        $data = $request->validate([
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ]);

        $nombre_cliente = $data['nombre_cliente'];
        $rut_cliente = $data['rut_cliente'];
        $descripcion_cliente = $data['descripcion_cliente'];
        $direccion_cliente = $data['direccion_cliente'];
        $id_comuna = $data['id_comuna'];

        $updateCliente = DB::update('UPDATE `clientes` SET `nombre_cliente` = ?, `rut_cliente` = ?, `descripcion_cliente`=  ?, `direccion_cliente`= ?, `id_comuna` = ? WHERE `id`= ? AND id_sucursal= 0 AND id_seccion= 0' , [$nombre_cliente, $rut_cliente, $descripcion_cliente,$direccion_cliente, $id_comuna, $id ]);

        if($updateCliente){
            return redirect()->route('admin.clientes.index')->withFlash('El cliente ha sido modificado');
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
    public function destroy($id)
    {
        // buscar todos los clientes (clientes sucursales y secciones) con el $id cliente y eliminarlos
        //$clientes = Cliente::where('id',$id)->delete();
        $deleteCliente = DB::delete('DELETE from `clientes` WHERE `id`=?',[$id]);
        if($deleteCliente){
            return redirect()->route('admin.clientes.index')->withFlash('Cliente eliminado');
        }

    }

    public function getCliente($id_cliente){
        return Cliente::find($id_cliente);
    }

    public function getSucursalesPorCliente($id_cliente){
        return Cliente::where('id', $id_cliente)->where('id_sucursal','<>', 0)->where('id_seccion', 0)->get();
    }
}
