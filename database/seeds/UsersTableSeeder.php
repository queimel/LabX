<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

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

        $admin = new User;
        $admin->name = "Usuario Admin";
        $admin->email = "admin@labx.cl";
        $admin->password = bcrypt('12345678');
        $admin->save();

        $admin->assignRole($adminRole);


        $supervisor = new User;
        $supervisor->name = "Usuario Supervisor";
        $supervisor->email = "supervisor@labx.cl";
        $supervisor->password = bcrypt('12345678');
        $supervisor->save();

        $supervisor->assignRole($supervisorRole);

        $operativo = new User;
        $operativo->name = "Usuario Operativo";
        $operativo->email = "operativo@labx.cl";
        $operativo->password = bcrypt('12345678');
        $operativo->save();

        $operativo->assignRole($operativeRole);

    }
}
