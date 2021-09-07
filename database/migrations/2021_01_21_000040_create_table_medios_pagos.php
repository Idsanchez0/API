<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMediosPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medios_pagos', function (Blueprint $table) {
            $table->id('id_medio_pago');
            $table->string('nombre_pago', 500);
            $table->string('banco', 500)->nullable();
            $table->string('marca', 150)->nullable();
            $table->string('token', 150)->nullable();
            $table->date('fecha_caducidad')->nullable();
            $table->unsignedInteger('activo')->default(1);
            $table->unsignedBigInteger('id_cliente');
            //$table->foreign('id_cliente')->references('id_cliente')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medios_pagos');
    }
}
