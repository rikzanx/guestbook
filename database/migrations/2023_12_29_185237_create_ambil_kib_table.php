<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbilKibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambil_kib', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan');
            $table->integer('jumlah');
            $table->string('foto_kib');
            $table->string('nama_pengambil');
            $table->string('kib_pengambil');
            $table->string('hp_pengambil');
            $table->string('tanda_tangan');
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
        Schema::dropIfExists('ambil_kib');
    }
}
