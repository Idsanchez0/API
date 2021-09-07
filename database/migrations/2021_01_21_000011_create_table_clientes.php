<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->unsignedBigInteger('tipo_identificacion_id');
            $table->string('identificacion', 100)->unique();
            $table->string('nombre_cliente', 500);
            $table->string('apellido_cliente', 500);
            $table->string('telefono_casa', 15)->nullable();
            $table->string('telefono_celular', 15)->nullable();
            $table->string('correo', 500);
            $table->date('fecha_nacimiento');
            $table->string('estado_civil', 50)->nullable();
            $table->string('genero', 20)->nullable();
            $table->integer('activo')->default(1);
            $table->foreign('tipo_identificacion_id')->references('id')->on('tipo_identificacions');
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
