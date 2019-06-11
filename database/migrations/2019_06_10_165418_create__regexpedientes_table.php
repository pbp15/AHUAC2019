<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegexpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_regexpedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idexpediente')->unsigned();
            $table->foreign('idexpediente')->references('id')->on('expedientes');
            $table->integer('idpersona')->unsigned();
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->integer('idoficina')->unsigned();
            $table->foreign('idoficina')->references('id')->on('oficinas');
            $table->string('estado_tramite', 20);
            $table->dateTime('fecha_tramite');
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
        Schema::dropIfExists('_regexpedientes');
    }
}
