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

use Illuminate\Validation\ValidationException;

use App\Telefono;
use App\Tecnico;

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


        if (!empty($request->input('run_tecnico'))) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'roles' => 'required',
                'telefonos_tecnico.*' => array(
                    'required',
                    'regex:/^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/'
                ),
                'run_tecnico' => 'required|cl_rut'
            ]);

        }else{
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'roles' => 'required'
            ]);
        }

        



        // Generar una contraseña

        $data['password'] = Str::random(8);

        // setear estado por defecto a active

        $data['active'] = 1;

        // Crear el usuario

        $user = User::create($data);
       
        // Asignar roles
        $user->assignRole($request->roles);


        // si es tecnico, crear row de tecnico
        if (!empty($request->input('run_tecnico'))) {
            $tecnico = Tecnico::create(['supervisor_id' => NULL, 'run_tecnico' => $data['run_tecnico']]);
            $tecnico->user()->save($user);

            $telefonos = $data['telefonos_tecnico'];
 
            foreach ($telefonos as $telefono){
                $tecnico->telefonos()->create(['numero_telefono'=> $telefono, 'id_tecnico' => $tecnico->id]);
            }
        }

        // Enviar email
        // UsuarioCreado::dispatch($user, $data['password'] );

        // registrar Activacion
        $activationData = [
            'fecha_estado' => Carbon::now(),
            'estado' => 1
        ];

        $user->registroEstados()->create($activationData);

        // registrar en historico contraseña
        $historicoContrasena = [
            'user_id' => $user->id,
            'password' => $data['password']
        ];

        $user->historicoContrasena()->create($historicoContrasena);

        // Regresamos al index
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

        if( $request->filled('password')){
            //Chequea historico contraseña
            $passwordHistories = $user->historicoContrasena()->take(config('PASSWORD_HISTORY_NUM'))->get();
            foreach($passwordHistories as $passwordHistory){
                echo $passwordHistory->password;
                if (Hash::check($data['password'], $passwordHistory->password)) {
                    // la contraseña coincide
                    $validator = validator([], []); // Empty data and rules fields
                    $validator->errors()->add('password', 'Esta contraseña ya fue usada anteriormente. Por favor ingresa otra password');
                    throw new ValidationException($validator);
                }
            }
        }

        $user->update($data);

        // Si user es tecnico
        if($user->esTecnico()){
            // update tecnico
            $user->profile->update(['run_tecnico' => $data['run_tecnico']]);

            // update telefonos tecnico
            $telefonosRequest = collect($data['telefonos_tecnico']);
            $telefonosRequestId = $data['telefonos_tecnico_id'];
    
            $telefonos = $telefonosRequest->map(function ($telefono, $key) use($telefonosRequestId){
                return ['id' => $telefonosRequestId[$key], 'telefono' => $telefono];
            });
    
            foreach ($telefonos as $telefono){
                $telefonoUp = Telefono::updateOrCreate(
                    ['id' => $telefono['id']],
                    ['id_tecnico' => $user->profile->id, 'numero_telefono' => $telefono['telefono']]
                );
            }
        }

        $user->syncRoles($request->roles);


        // registrar Activacion
        $activationData = [
            'fecha_estado' => Carbon::now(),
            'estado' => $data['active']
        ];

        $user->registroEstados()->create($activationData);


        if( $request->filled('password')){

            // registrar en historico contraseña
            $historicoContrasena = [
                'user_id' => $user->id,
                'password' => $user->password
            ];

            $user->historicoContrasena()->create($historicoContrasena);
        }


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
        $user->registroEstados()->where('user_id', $id)->delete();
        $user->historicoContrasena()->where('user_id', $id)->delete();

        if($user->esTecnico()){
            $user->profile->telefonos()->delete();
            $user->profile->delete();
        }

        $user->delete();

        return redirect()->route('admin.usuarios.index')->withFlash('Usuario eliminado');
    }
}
