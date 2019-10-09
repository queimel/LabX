<?php

use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $clientes = [
            [1, 0, 0, 'Centro Nacional de Conservacion y Restauracion', '60905000-4', 'Recoleta 683', 92, 'Cliente'],
            [1, 0, 1, 'Microscopia', '60905000-4', 'Recoleta 683', 92, 'Seccion'],
        ];

        $clientes = array_map(function ($cliente) use ($now) {
            return [
                'id' =>$cliente[0],
                'id_sucursal' => $cliente[1],
                'id_seccion' => $cliente[2],
                'nombre_cliente' => $cliente[3],
                'rut_cliente' => $cliente[4],
                'direccion_cliente' => $cliente[5],
                'id_comuna' => $cliente[6],
                'descripcion_cliente' => $cliente[7],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $clientes);
        \DB::table('clientes')->insert($clientes);

    }
}
