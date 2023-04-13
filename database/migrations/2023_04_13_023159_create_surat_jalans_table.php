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
            $table->string('nomor_surat');
            $table->string("nama");
            $table->string("nik");
            $table->string("departemen");
            $table->string("dari");
            $table->string("tujuan");
            $table->string("no_mb");
            $table->string("barang");
            $table->string("foto_suratjalan");
            $table->string("pos_izin");
            $table->string("lainnya")->nullable();
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
