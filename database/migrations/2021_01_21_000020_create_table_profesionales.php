<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_identificacion_id');
            $table->unsignedBigInteger('user_id');
            $table->string('identificacion', 100)->unique();
            $table->string('nombre', 500);
            $table->string('apellido', 500);
            $table->string('correo', 255);
            $table->string('telefono_casa', 15)->nullable();
            $table->string('telefono_celular', 15)->nullable();
            $table->string('foto', 500)->nullable();
            $table->date('socio_desde');
            $table->date('fecha_nacimiento');
            $table->string('estado_civil', 50)->nullable();
            $table->string('genero', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('profesionales');
    }
}
