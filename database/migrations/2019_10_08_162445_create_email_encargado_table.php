<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailEncargadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_encargado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_encargado');
            $table->unsignedBigInteger('id_email');
            $table->foreign('id_encargado')->references('id')->on('encargados');
            $table->foreign('id_email')->references('id')->on('emails');
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
        Schema::dropIfExists('email_encargado');
    }
}
