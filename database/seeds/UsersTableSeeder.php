<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;
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
        $operativeRole = Role::create(['name' => 'Operative']);

        $viewUsersPermission = Permission::create(['name'=>'View users']);
        $createUsersPermission = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $adminRole->givePermissionTo('View users', 'Create users', 'Update users', 'Delete users');
        $supervisorRole->givePermissionTo('View users', 'Create users', 'Update users');
        $operativeRole->givePermissionTo('View users');

        $admin = new User;
        $admin->name = "Usuario Admin";
        $admin->email = "admin@labx.cl";
        $admin->password = '12345678';
        $admin->active = true;
        $admin->save();

        $admin->assignRole($adminRole);


        $supervisor = new User;
        $supervisor->name = "Usuario Supervisor";
        $supervisor->email = "supervisor@labx.cl";
        $supervisor->password = '12345678';
        $supervisor->active = true;
        $supervisor->save();

        $supervisor->assignRole($supervisorRole);

        $operativo = new User;
        $operativo->name = "Usuario Operativo";
        $operativo->email = "operativo@labx.cl";
        $operativo->password = '12345678';
        $operativo->active = true;
        $operativo->save();

        $operativo->assignRole($operativeRole);

    }
}
