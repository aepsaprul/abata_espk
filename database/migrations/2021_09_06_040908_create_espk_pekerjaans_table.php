<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspkPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espk_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->integer('cabang_pemesan_id')->nullable();
            $table->integer('cabang_pelaksana_id')->nullable();
            $table->integer('pelanggan_id')->nullable();
            $table->integer('pegawai_penerima_pesanan_id')->nullable();
            $table->integer('pegawai_desain_id')->nullable();
            $table->integer('cabang_cetak_id')->nullable();
            $table->integer('cabang_finishing_id')->nullable();
            $table->string('nama_pesanan', 50)->nullable();
            $table->integer('nomor_nota')->nullable();
            $table->date('tanggal_pesanan')->nullable();
            $table->date('rencana_jadi')->nullable();
            $table->string('jenis_pesanan', 30)->nullable();
            $table->string('jumlah', 30)->nullable();
            $table->string('ukuran', 30)->nullable();
            $table->string('jenis_kertas', 30)->nullable();
            $table->string('warna', 30)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('file')->nullable();
            $table->integer('status_id')->nullable();
            $table->dateTimeTz('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('espk_pekerjaans');
    }
}
