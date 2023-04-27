<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSuratJalans2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('surat_jalans');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
