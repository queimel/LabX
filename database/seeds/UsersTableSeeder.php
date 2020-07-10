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

        $viewUsersPermission = Permission::create(['name'=>'View users']);
        $createUsersPermission = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $adminRole->givePermissionTo('View users', 'Create users', 'Update users', 'Delete users');
        $supervisorRole->givePermissionTo('View users', 'Create users', 'Update users');
        $tecnicoRole->givePermissionTo('View users');

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

        // $operativo = new User;
        // $operativo->name = "Usuario Operativo";
        // $operativo->email = "operativo@labx.cl";
        // $operativo->password = '12345678';
        // $operativo->active = false;
        // $operativo->save();

        // $operativo->assignRole($operativeRole);

        // $operativoState = new RegistroEstado;
        // $operativoState->fecha_estado = Carbon::now();
        // $operativoState->estado = false;

        // $operativo->registroEstados()->save($operativoState);

        // $barrita1 = new User;
        // $barrita1->name = "José Barra Briones";
        // $barrita1->email = "jose.barra@correoaiep.cl";
        // $barrita1->password = 'xcRORTuK';
        // $barrita1->active = true;
        // $barrita1->password_changed_at = Carbon::now();
        // $barrita1->save();
        // $barrita1->assignRole($adminRole);
        // $barrita1State = new RegistroEstado;
        // $barrita1State->fecha_estado = Carbon::now();
        // $barrita1State->estado = true;
        // $barrita1->registroEstados()->save($adminState);

        // $barrita2 = new User;
        // $barrita2->name = "Profesor José Barra";
        // $barrita2->email = "jobebarra@gmail.com";
        // $barrita2->password = 'SZRHCmb2';
        // $barrita2->active = true;
        // $barrita2->password_changed_at = Carbon::now();
        // $barrita2->save();
        // $barrita2->assignRole($adminRole);
        // $barrita2State = new RegistroEstado;
        // $barrita2State->fecha_estado = Carbon::now();
        // $barrita2State->estado = true;
        // $barrita2->registroEstados()->save($adminState);

    }
}
