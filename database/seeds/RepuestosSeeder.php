<?php

use Illuminate\Database\Seeder;

class RepuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $repuestos = [
            [1,'FILTER',1],
            [2,'BLOWER BRUSH',1],
            [3,'FILTER SET A',1],
            [4,'CAP SEAL 3MM x 2PC',2],
            [5,'CAPSEAL 12MM x 2PC',2],
            [6,'SILICONE TUBE',2],
            [7,'TEFLON TUBE',3],
            [8,'TYGON TUBE',3],
            [9,'TROP BOTTLE SET WITH COPS',3],
            [10,'SILICONE TUBE',4],
            [11,'ORING',4],
            [12,'WHITE PLATE',4],
            [13,'PUMP ASSEMPLY 3',4],
            [14,'PUMP ASSEMPLY 12',1],
            [15,'DRIVER PWA',1],
            [16,'PI PWA (LIGHT ANGLE)',1],
            [17,'NOZZLE RELAY 2 PWA',2],
            [18,'VALVE WIRE',2],
            [19,'VALVE WIR 2',2],
            [20,'VALVE WIR 3',3],
            [21,'AIR PUMP WIR',3],
            [22,'MOTOR WIRING S1',3],
            [23,'MOTOR WIRING S2',4],
            [24,'MOTOR WIRING S3',4],
            [25,'PI PWA',4],
            [26,'SCREW SHAFT WITH PE-NUT',4],
            [1,'PUMP WIKING',1],
            [2,'TEST STRIP REACTION ASSEMBLY',1],
            [3,'Test Strip Carrier Assembly(23-03647)',1],
            [4,'OPTICAL BLOCK ASSEMBLY',2],
            [5,'Nozzle Drive assembly',2],
            [6,'SGBSE ASSEMBLY',2],
            [7,'WASHING SOLITION PUMPS',3],
            [8,'SAMPLING PUMP',3],
            [9,'ORING',3],
            [10,'Sampler Sub-CPU PCB',4],
            [11,'PI PRINTER CIRCUIT BOARD',4],
            [12,'SILICONE TUBE',4],
            [13,'SILICONE TUBE',4],
            [14,'SILICONE TUBE',1],
            [15,'SILICONE TUBE',1],
            [16,'SILICONE TUBE',1],
            [17,'SAMPLING LEVEL ADJ.(74-12633A)',2],
            [18,'PICH VALVE',2],
            [19,'ULTRA SPRING 2 LONG E618',2],
            [20,'ULTRA SPRING 1 SHORT E649',3],
            [21,'NEW FEEDER DISK ASSEMBLY',3],
            [22,'NEW FEEDER ENCODER PCB',3],
            [23,'NEW FEEDER MOTOR ASSEMBLY',4],
            [24,'PICH VALVE',4],
            [25,'MAIN PWA (VS. 1.15 AE-4020)',4],
            [26,'F-ROM FOR AX-4030 (V1.14)',4],

        ];

        $repuestos = array_map(function ($repuestos) use ($now) {
            return [
                'id_modelo' => $repuestos[0],
                'nombre_repuesto' => $repuestos[1],
                'nivel_repuesto' => $repuestos[2],
            ];
        }, $repuestos);
        \DB::table('repuestos')->insert($repuestos);
    }
}
