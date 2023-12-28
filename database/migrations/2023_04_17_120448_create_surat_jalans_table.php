<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('bentuk');
            $table->string('dari');
            $table->string('tujuan');
            $table->string('nomor_po');
            $table->string('nama_penanggung_jawab');
            $table->string('nomor');
            $table->time("waktu_masuk");
            $table->time("waktu_keluar");
            $table->string("verifikasi")->default('Belum Terferivikasi');
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
        Schema::dropIfExists('surat_jalans');
    }
}
