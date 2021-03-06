<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(UsersTableSeeder::class);
        $this->call(ComunaRegionProvinciaSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(ModelosSeeder::class);
        $this->call(TecnicosSeeder::class);
        $this->call(RepuestosSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }


}
