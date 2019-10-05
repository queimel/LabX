<?php

namespace App\Http\Controllers\admin;

use App\Events\UsuarioCreado;
use App\User;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateUserRequest;

use App\Http\Controllers\Controller;
use App\RegistroEstado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::allowed()->get();

        // cuando llegue a la url /usuarios, retorna la vista correspondiente
        return view('admin.users.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);
        // validar formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles' => 'required'
        ]);

        // Generar una contraseña

        $data['password'] = Str::random(8);

        // setear estado por defecto a active

        $data['active'] = 1;

        // Crear el usuario

        $user = User::create($data);

        // Asignar roles
        $user->assignRole($request->roles);
        // Enviar email
        UsuarioCreado::dispatch($user, $data['password'] );

        // registrar Activacion
        $activationData = [
            'fecha_estado' => Carbon::now(),
            'estado' => 1
        ];

        $user->registroEstados()->create($activationData);

        // Regresamos al usuario

        return redirect()->route('admin.usuarios.index')->withFlash('El usuario ha sido creado');

    }

    /**
     * Muestra el usuario especifico.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $this->authorize('view', $user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);



        $data = $request->validated();
        $data['active'] = $data['active'] == 'true' ? 1 : 0;

        $user->update($data);
        $user->syncRoles($request->roles);


        // registrar Activacion
        $activationData = [
            'fecha_estado' => Carbon::now(),
            'estado' => $data['active']
        ];

        $user->registroEstados()->create($activationData);

        return back()->withFlash('Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('admin.usuarios.index')->withFlash('Usuario eliminado');
    }
}
