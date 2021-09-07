<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->foreignId('pais_id')->constrained();
            $table->foreignId('ciudad_id')->constrained();
            $table->string('telefono', 100)->unique();
            $table->string('correo', 255)->unique();
            $table->string('clave', 200);
            $table->enum('estado', ['ACTIVO', 'INACTIVO', 'SUSPENDIDO', 'PENDIENTE'])->default('PENDIENTE');
            $table->string('recupera_clave', 255)->nullable();
            $table->string('verificar_id');
            $table->timestamp('correo_verificado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
