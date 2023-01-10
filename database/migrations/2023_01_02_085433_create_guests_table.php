<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_badan_usaha');
            $table->string('lokasi_pekerjaan');
            $table->string('departemen');
            $table->string('jenis_pekerjaan');
            $table->integer('jumlah_personil');
            $table->string('ktp')->nullable();
            $table->string('kib')->nullable();
            $table->string('surat_kesehatan')->nullable();
            $table->string('lainnya')->nullable();
            $table->string("foto_lembar_depan");
            $table->string("nama_safety_upload");
            $table->string('no_hp');
            $table->string('verifikasi')->default('Belum Terferivikasi');
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
        Schema::dropIfExists('guests');
    }
}
