<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsToPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('peliculas', function (Blueprint $table) {
        $table->unsignedBigInteger('visitas')->default(0);
    });
}

public function down()
{
    Schema::table('peliculas', function (Blueprint $table) {
        $table->dropColumn('visitas');
    });
}

}
