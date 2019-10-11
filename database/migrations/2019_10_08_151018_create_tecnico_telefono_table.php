<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicoTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnico_telefono', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tecnico');
            $table->unsignedBigInteger('id_telefono');
            $table->foreign('id_tecnico')->references('id')->on('tecnicos');
            $table->foreign('id_telefono')->references('id')->on('telefonos');
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

    }
}
