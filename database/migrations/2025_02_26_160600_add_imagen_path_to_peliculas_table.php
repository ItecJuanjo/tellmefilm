<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenPathToPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('peliculas', function (Blueprint $table) {
        $table->string('imagen_path')->nullable()->after('año'); // Añadir columna después del año
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('peliculas', function (Blueprint $table) {
        $table->dropColumn('imagen_path');
    });
}

}
