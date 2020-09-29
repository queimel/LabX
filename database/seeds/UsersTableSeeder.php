<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
use App\RegistroEstado;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin']);
        $supervisorRole = Role::create(['name' => 'Supervisor']);
        $tecnicoRole = Role::create(['name' => 'Tecnico']);
        $encargadoRole = Role::create(['name' => 'Encargado']);

        $viewUsersPermission = Permission::create(['name'=>'View users']);
        $createUsersPermission = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $adminRole->givePermissionTo('View users', 'Create users', 'Update users', 'Delete users');
        $supervisorRole->givePermissionTo('View users', 'Create users', 'Update users');
        $tecnicoRole->givePermissionTo('View users');
        $encargadoRole->givePermissionTo('View users');

        $admin = new User;
        $admin->name = "Usuario Admin";
        $admin->email = "ccampos.aviles@gmail.com";
        $admin->password = '12345678';
        $admin->active = true;
        $admin->password_changed_at = Carbon::create('2019-10-01');
        $admin->save();
        $admin->assignRole($adminRole);
        $adminState = new RegistroEstado;
        $adminState->fecha_estado = Carbon::now();
        $adminState->estado = true;
        $admin->registroEstados()->save($adminState);


        $supervisor = new User;
        $supervisor->name = "Usuario Supervisor";
        $supervisor->email = "supervisor@labx.cl";
        $supervisor->password = '12345678';
        $supervisor->active = true;
        $supervisor->save();
        $supervisor->assignRole($supervisorRole);
        $supervisorState = new RegistroEstado;
        $supervisorState->fecha_estado = Carbon::now();
        $supervisorState->estado = true;
        $supervisor->registroEstados()->save($supervisorState);


        $encargado = new User;
        $encargado->name = "Usuario Encargado";
        $encargado->email = "encargado@labx.cl";
        $encargado->password = '12345678';
        $encargado->active = true;
        $encargado->save();
        $encargado->assignRole($encargadoRole);
        $encargadoState = new RegistroEstado;
        $encargadoState->fecha_estado = Carbon::now();
        $encargadoState->estado = true;
        $encargado->registroEstados()->save($encargadoState);

    }
}
