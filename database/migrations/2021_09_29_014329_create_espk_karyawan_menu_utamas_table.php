<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspkKaryawanMenuUtamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espk_karyawan_menu_utamas', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id')->nullable();
            $table->integer('menu_utama_id')->nullable();
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
        Schema::dropIfExists('espk_karyawan_menu_utamas');
    }
}
