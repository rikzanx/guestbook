<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->string('nama_perusahaan');
            $table->string('tujuan');
            $table->string('foto_ktp');
            $table->string('nomor_kartu')->nullable();
            $table->time("keluar")->nullable();
            $table->string("pos_asal")->nullable();
            $table->string("lainnya")->nullable();
            $table->string('verifikasi')->default('Belum Terferivikasi');
            $table->string('no_hp')->default('0');
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
        Schema::dropIfExists('visitors');
    }
}
