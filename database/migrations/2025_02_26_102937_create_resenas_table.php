<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('resenas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelicula_id')->constrained()->onDelete('cascade'); // Relación con películas
        $table->string('usuario');
        $table->text('contenido');
        $table->integer('puntuacion')->min(1)->max(5);
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
        Schema::dropIfExists('resenas');
    }
}
