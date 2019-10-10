<?php

use Illuminate\Database\Seeder;

class ModelosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $modelos = [
            [2,'BX41TF','Sin descripción',1000],
            [1,'GelDoc','Sin descripción',1000],
            [1,'MyCycler','Sin descripción',1000],
            [1,'Transblot Turbo','Sin descripción',1000],
            [2,'BX41','Sin descripción',1000],
            [3,'GS-15R','Sin descripción',1000],
            [3,'ACT-8','Sin descripción',1000],
            [3,'ACT DIFF','Sin descripción',1000],
            [3,'LH 500','Sin descripción',1000],
            [4,'SELECTRA PRO M','Sin descripción',1000],
            [1,'CENTRIFUGA 12S ','Sin descripción',1000],
            [1,'CENTRIFUGA 24S','Sin descripción',1000],
            [1,'INCUBADOR 37IIS ','Sin descripción',1000],
            [5,'AX 4030','Sin descripción',1000],
            [1,'VARIANT  II','Sin descripción',1000],
            [3,'HMX','Sin descripción',1000],
            [6,'URODIPCHECK 400E','Sin descripción',1000],
            [3,'ACCESS','Sin descripción',1000],
            [1,'VARIANT  T ','Sin descripción',1000],
            [3,'GENS','Sin descripción',1000],
            [7,'AUTOCOMPACT','Sin descripción',1000],
            [3,'AU 680','Sin descripción',1000],
            [6,'XL 200','Sin descripción',1000],
            [5,'AE 4020','Sin descripción',1000],
            [8,'ICHEM VELOCITY','Sin descripción',1000],
            [8,'IQ 200 SPRINT','Sin descripción',1000],
        ];

        $modelos = array_map(function ($modelos) use ($now) {
            return [
                'id_marca_modelo' => $modelos[0],
                'nombre_modelo' => $modelos[1],
                'descripcion_modelo' => $modelos[2],
                'frecuencia_modelo' => $modelos[3],
            ];
        }, $modelos);
        \DB::table('modelos')->insert($modelos);
    }
}
