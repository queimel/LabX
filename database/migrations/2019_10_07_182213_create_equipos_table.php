<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('iso');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('marcas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_marca');
            $table->string('origen_marca');
            $table->timestamps();
        });

        Schema::create('modelos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_marca_modelo');
            $table->string('nombre_modelo');
            $table->text('descripcion_modelo')->nullable();
            $table->integer('frecuencia_modelo');
            $table->foreign('id_marca_modelo')->references('id')->on('marcas');
            $table->timestamps();
        });

        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_modelo_equipo');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_sucursal');
            $table->unsignedBigInteger('id_seccion');
            $table->string('num_serie_equipo');
            $table->date('fecha_fabricacion_equipo');
            $table->integer('test_equipo');
            $table->date('fecha_ultima_mantencion_equipo');
            $table->foreign('id_modelo_equipo')->references('id')->on('modelos');
            $table->foreign(['id_cliente','id_sucursal','id_seccion'])->references(['id','id_sucursal','id_seccion'])->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('modelos');
        Schema::dropIfExists('marcas');

    }
}
