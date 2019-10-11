<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('telefonos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_telefono');
            $table->timestamps();
        });

        Schema::create('tecnicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_tecnico');
            $table->string('Apellidos_encargado');
            $table->timestamps();
        });

        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_equipo_mantenimiento');
            $table->unsignedBigInteger('id_tecnico_mantenimiento');
            $table->foreign('id_equipo_mantenimiento')->references('id')->on('equipos');
            $table->foreign('id_tecnico_mantenimiento')->references('id')->on('tecnicos');
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

        Schema::dropIfExists('mantenimientos');
        Schema::dropIfExists('tecnico_telefono');
        Schema::dropIfExists('tecnicos');
        Schema::dropIfExists('telefonos');
    }
}
