<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kib', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kib');
            $table->string('no_ktp');
            $table->string('nama');
            $table->string('perusahaan');
            $table->string('alamat');
            $table->date('tgl_terbit');
            $table->date('masa_berlaku');
            $table->text('kontrak_kerja');
            $table->string('area_kerja');
            $table->integer('status')->comment("0 Belum Diambil ; 1 Sudah Diambil")->default(0);
            $table->text("keterangan")->nullable();
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
        Schema::dropIfExists('kib');
    }
}
