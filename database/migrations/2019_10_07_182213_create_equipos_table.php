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
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_modelo_equipo');
            $table->unsignedBigInteger('id_cliente_equipo');
            $table->string('num_serie_equipo');
            $table->timestamp('fecha_fabricacion_equipo');
            $table->integer('test_equipo');
            $table->timestamp('fecha_ultima_mantencion_equipo');
            $table->foreign('id_cliente_equipo')->references('id')->on('clientes');
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
        Schema::dropIfExists('equipos');
    }
}
