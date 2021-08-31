<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspkMenuSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espk_menu_subs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu', 30)->nullable();
            $table->string('link', 100)->nullable();
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
        Schema::dropIfExists('espk_menu_subs');
    }
}
