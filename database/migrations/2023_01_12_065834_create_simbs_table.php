<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simbs', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("nik");
            $table->string("departemen");
            $table->string("dari");
            $table->string("tujuan");
            $table->string("no_mb");
            $table->string("barang");
            $table->string("foto_simb");
            $table->string("pos_izin");
            $table->string("lainnya")->nullable();
            $table->string("verifikasi")->default('Belum Terferivikasi');
            $table->string('nomor_surat');
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
        Schema::dropIfExists('simbs');
    }
}
