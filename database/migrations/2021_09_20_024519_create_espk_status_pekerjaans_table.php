<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspkStatusPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espk_status_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->integer('pekerjaan_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('pegawai_id')->nullable();
            $table->dateTime('waktu')->nullable();
            $table->string('status_keterangan', 100)->nullable();
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
        Schema::dropIfExists('espk_status_pekerjaans');
    }
}
