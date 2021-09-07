<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id('id_direccion');
            $table->string('calle_principal',500);
            $table->string('calle_secundaria',500);
            $table->string('sector',255)->nullable();
            $table->string('numero',10);
            $table->integer('activo')->default(1);
            $table->string('tipo_direccion',255);
            $table->unsignedBigInteger('id_profesional');
            $table->foreign('id_profesional')->references('id')->on('profesionales');
            $table->unsignedBigInteger('id_ciudad');
            $table->foreign('id_ciudad')->references('id_ciudad')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
