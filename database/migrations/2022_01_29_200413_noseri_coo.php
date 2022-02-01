<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoseriCoo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noseri_coo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('noseri_logistik_id')->nullable();
            $table->foreign('noseri_logistik_id')->references('id')->on('noseri_logistik');
            $table->string('ket')->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('noseri_coo');
    }
}
