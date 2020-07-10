<?php

use Illuminate\Database\Seeder;
use App\Tecnico;
use App\User;
use App\Telefono;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;

class TecnicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // $tecnico1 = new User;
        // $tecnico1->name = "Usuario tecnico1";
        // $tecnico1->email = "ccampos.aviles@gmail.com";
        // $tecnico1->password = '12345678';
        // $tecnico1->active = true;
        // $tecnico1->password_changed_at = Carbon::create('2019-10-01');
        // $tecnico1->save();

        // $tecnico1->assignRole($tecnico1Role);

        // $tecnico1State = new RegistroEstado;
        // $tecnico1State->fecha_estado = Carbon::now();
        // $tecnico1State->estado = true;

        // $tecnico1->registroEstados()->save($tecnico1State);

        $tecnicoRole = Role::find(3);

        $tecnico0 = Tecnico::create(['supervisor_id'=>NULL,'run_tecnico'=>'1111111-1']);
        $tecnico0User = User::create(['name'=>'Jorge Vega', 'email'=>'tecnico@labx.cl', 'password'=>'12345678', 'active'=>true]);
        $tecnico0User->assignRole($tecnicoRole);
        $tecnico0->user()->save($tecnico0User);
        $tecnico0->telefonos()->create(['numero_telefono'=>'+56984784138']);
        $tecnico0User->registroEstados()->create(['fecha_estado' => Carbon::now(), 'estado' => true]);

        $tecnico1 = Tecnico::create(['supervisor_id'=>NULL,'run_tecnico'=>'15473785-5']);
        $tecnico1User = User::create(['name'=>'Jorge Vega', 'email'=>'jorgevega@labx.cl', 'password'=>'12345678', 'active'=>true]);
        $tecnico1User->assignRole($tecnicoRole);
        $tecnico1->user()->save($tecnico1User);
        $tecnico1->telefonos()->create(['numero_telefono'=>'+56984784132']);
        $tecnico1User->registroEstados()->create(['fecha_estado' => Carbon::now(), 'estado' => true]);

        $tecnico2 = Tecnico::create(['supervisor_id'=>NULL,'run_tecnico'=>'16126331-1']);
        $tecnico2User = User::create(['name'=>'Felipe Silva', 'email'=>'felipesilva@labx.cl', 'password'=>'12345678', 'active'=>true]);
        $tecnico2User->assignRole($tecnicoRole);
        $tecnico2->user()->save($tecnico2User);
        $tecnico2->telefonos()->create(['numero_telefono'=>'+56957105136']);
        $tecnico2User->registroEstados()->create(['fecha_estado' => Carbon::now(), 'estado' => true]);

        $tecnico3 = Tecnico::create(['supervisor_id'=>NULL,'run_tecnico'=>'17085772-0']);
        $tecnico3User = User::create(['name'=>'Diego Ormazabal', 'email'=>'tecnico3@labx.cl', 'password'=>'12345678', 'active'=>true]);
        $tecnico3User->assignRole($tecnicoRole);
        $tecnico3->user()->save($tecnico3User);
        $tecnico3->telefonos()->create(['numero_telefono'=>'+56941532321']);
        $tecnico3User->registroEstados()->create(['fecha_estado' => Carbon::now(), 'estado' => true]);


        // $tecnicos = [
        //     [NULL,'Jorge','Vega', '15473785-5'],
        //     [NULL,'Felipe','Silva', '16126331-1'],
        //     [2,'Diego','Ormazabal', '17085772-0'],
        //     [1,'Cynthia','Ferrari', '17086224-4'],
        //     [1,'Paulo','Cornejo', '11111111-1'],
        // ];

        // $tecnicos = array_map(function ($tecnicos) use ($now) {
        //     return [
        //         'supervisor_id' => $tecnicos[0],
        //         'nombre_tecnico' => $tecnicos[1],
        //         'apellido_tecnico' => $tecnicos[2],
        //         'run_tecnico' => $tecnicos[3]
        //     ];
        // }, $tecnicos);
        // \DB::table('tecnicos')->insert($tecnicos);


        // $telefonos = [
        //     ['+56984784132', 1],
        //     ['+56957105136', 2],
        //     ['+56941532321', 3],
        //     ['+56938019703', 4],
        //     ['+56941809650', 5]
        // ];

        // $telefonos = array_map(function($telefonos) use($now){
        //     return [
        //         'numero_telefono' => $telefonos[0],
        //         'id_tecnico' => $telefonos[1]
        //     ];
        // }, $telefonos);
        // \DB::table('telefonos')->insert($telefonos);

        // // Get all the roles attaching up to 3 random roles to each user
        // $telefonos = App\Telefono::all();

        // // Populate the pivot table
        // App\Tecnico::all()->each(function ($tecnico) use ($telefonos) {
        //     $tecnico->telefonos()->attach(
        //         $telefonos->random(rand(1, 2))->pluck('id')->toArray()
        //     );
        //     //$tecnico->telefonos()->saveMany($telefonos);
        // });

    }
}
