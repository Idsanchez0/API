<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTipoMembresiaTableProfesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesionales', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_membresia');
            //$table->foreign('id_membresia')->references('id_membresia')->on('membresias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesionales', function (Blueprint $table) {
            $table->dropColumn('id_membresia');
            //
        });
    }
}
