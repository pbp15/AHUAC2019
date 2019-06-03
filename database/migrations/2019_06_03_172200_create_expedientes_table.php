<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_expediente', 100);
            $table->string('tipo_documento', 70);
            $table->string('cabecera_documento', 100)->nullable();
            $table->string('asunto_tramite', 100);
            $table->integer('nro_folio');
            $table->string('prioridad', 100);
            $table->dateTime('fecha');
            $table->string('observaciones', 100)->nullable();
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
        Schema::dropIfExists('expedientes');
    }
}
