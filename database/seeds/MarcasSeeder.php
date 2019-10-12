<?php

use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $marcas = [
            ['BIO RAD', 4],
            ['OLYMPUS',4],
            ['BECKMANCOULTER',180],
            ['ELITECH',75],
            ['ARKRAY',75],
            ['ERBA',4],
            ['MECHATRONICS',75],
            ['IRIS',4],
        ];

        $marcas = array_map(function ($marcas) use ($now) {
            return [
                'nombre_marca' => $marcas[0],
                'origen_marca' => $marcas[1],
            ];
        }, $marcas);
        \DB::table('marcas')->insert($marcas);

    }
}
