<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrabajos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id('id_trabajo');
            $table->string('nombre_trabajo', 255);
            $table->string('descripcion_trabajo', 255);
            $table->date('fecha_inicio_trabajo');
            $table->time('hora_inicio_trabajo');
            $table->date('fecha_fin_trabajo');
            $table->time('hora_fin_trabajo');
            $table->string('calle_principal', 500);
            $table->string('numero', 50);
            $table->string('calle_secundaria', 500);
            $table->string('ciudad', 255);
            $table->string('provincia', 255);
            $table->string('pais', 255);
            $table->decimal('valor_trabajo', $precision = 10, $scale = 2);
            $table->decimal('saldo_trabajo', $precision = 10, $scale = 2);
            $table->unsignedBigInteger('id_producto');
            //$table->foreign('id_producto')->references('id_producto')->on('productos');
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
        Schema::dropIfExists('trabajos');
    }
}
