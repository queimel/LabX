<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoEncargadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_encargado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_encargado');
            $table->foreign('id_cargo')->references('id')->on('cargos');
            $table->foreign('id_encargado')->references('id')->on('encargados');
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
        Schema::dropIfExists('cargo_encargado');
    }
}
