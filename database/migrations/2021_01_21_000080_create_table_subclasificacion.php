<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSubclasificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subclasificacion', function (Blueprint $table) {
            $table->id('id_subclasificacion');
            $table->string('nombre_subclasificacion');
            $table->unsignedBigInteger('id_clasificacion');
            $table->foreign('id_clasificacion')->references('id_clasificacion')->on('clasificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subclasificacion');
    }
}
