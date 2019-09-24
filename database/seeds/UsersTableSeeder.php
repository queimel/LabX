<?php

use Illuminate\Database\Seeder;
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
        User::truncate();

        $user = new User;
        $user->name = "Cristian";
        $user->email = "ccampos.aviles@gmail.com";
        $user->password = bcrypt('12345678');
        $user->save();


        $user = new User;
        $user->name = "Jorge";
        $user->email = "jorge.saezr@usach.cl";
        $user->password = bcrypt('12345678');
        $user->save();

        $user = new User;
        $user->name = "Juan Pablo";
        $user->email = "jptorrealbat@gmail.com";
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
