<?php

use Illuminate\Database\Seeder;

class TecnicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $tecnicos = [
            [NULL,'Jorge','Vega', '15473785-5'],
            [NULL,'Felipe','Silva', '16126331-1'],
            [2,'Diego','Ormazabal', '17085772-0'],
            [1,'Cynthia','Ferrari', '17086224-4'],
            [1,'Paulo','Cornejo', '11111111-1'],
        ];

        $tecnicos = array_map(function ($tecnicos) use ($now) {
            return [
                'supervisor_id' => $tecnicos[0],
                'nombre_tecnico' => $tecnicos[1],
                'apellido_tecnico' => $tecnicos[2],
                'run_tecnico' => $tecnicos[3]
            ];
        }, $tecnicos);
        \DB::table('tecnicos')->insert($tecnicos);
    }
}
