<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('img_background');
            $table->string('name');
            $table->float('IMDb')->default(0);
            $table->integer('so_danh_gia')->default(0);
            $table->integer('nam_sx');
            $table->string('mota');
            $table->integer('luot_xem')->default(0);
            $table->string('quoc_gia');
            $table->string('link_trailer')->nullable();
            $table->boolean('flag_delete')->default('1');
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
        Schema::dropIfExists('film');
    }
}
