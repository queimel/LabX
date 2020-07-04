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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->string('nombre_tecnico');
            $table->string('apellido_tecnico');
            $table->string('run_tecnico')->unique();
            $table->foreign('supervisor_id')->references('id')->on('tecnicos')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('telefonos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_telefono');
            $table->unsignedBigInteger('id_tecnico');
            $table->foreign('id_tecnico')->references('id')->on('tecnicos')->onDelete('cascade');
            $table->timestamps();
        });



        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_equipo_mantenimiento');
            $table->unsignedBigInteger('id_tecnico_mantenimiento');
            $table->foreign('id_equipo_mantenimiento')->references('id')->on('equipos');
            $table->foreign('id_tecnico_mantenimiento')->references('id')->on('tecnicos');
            $table->timestamp('fecha_mantenimiento');
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
