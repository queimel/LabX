<?php

use Illuminate\Database\Seeder;

class MarcasSeed extends Seeder
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
            ['BIO RAD','MEXICO'],
            ['OLYMPUS','CHILE'],
            ['BECKMANCOULTER','PERU'],
            ['ELITECH','ARGENTINA'],
            ['ARKRAY','BOLIVIA'],
            ['ERBA','URUGUAY'],
            ['MECHATRONICS','PARAGUAY'],
            ['IRIS','VENEZUELA'],
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
