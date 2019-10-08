<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_region');
            $table->string('nombre_region');
            $table->timestamps();
        });

        Schema::create('ciudads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_region');
            $table->string('nombre_ciudad');
            $table->foreign('id_region')->references('id')->on('regions');
            $table->timestamps();
        });

        Schema::create('comunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ciudad');
            $table->string('nombre_comuna');
            $table->foreign('id_ciudad')->references('id')->on('ciudads');
            $table->timestamps();
        });



        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_sucursal')->nullable();
            $table->unsignedBigInteger('id_seccion')->nullable();
            $table->string('rut_cliente');
            $table->string('nombre_cliente');
            $table->text('descripcion_cliente')->nullable();
            $table->text('direccion_cliente');
            $table->unsignedBigInteger('id_comuna');
            $table->foreign('id_comuna')->references('id')->on('comunas');
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
        Schema::dropIfExists('clientes');
    }
}
