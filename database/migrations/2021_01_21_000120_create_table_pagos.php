<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->decimal('valor', $precision = 10, $scale = 2);
            $table->date('fecha_pago');
            $table->date('fecha_proceso');
            $table->date('fecha_aprobacion');
            $table->string('aprovacion_id', 255);
            $table->string('referencia_id', 255);
            $table->unsignedBigInteger('id_trabajo');
            $table->foreign('id_trabajo')->references('id_trabajo')->on('trabajos');
            $table->unsignedBigInteger('id_medio_pago');
            $table->foreign('id_medio_pago')->references('id_medio_pago')->on('medios_pagos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
