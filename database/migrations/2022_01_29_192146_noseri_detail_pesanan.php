<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoseriDetailPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noseri_detail_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('detail_pesanan_produk_id')->nullable();
            $table->foreign('detail_pesanan_produk_id')->references('id')->on('detail_pesanan_produk');
            $table->unsignedBigInteger('t_tfbj_noseri_id')->nullable();
            $table->foreign('t_tfbj_noseri_id')->references('id')->on('t_gbj_noseri');
            $table->string('status')->nullable();
            $table->date('tgl_uji')->nullable();
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
        Schema::dropIfExists('noseri_detail_pesanan');
    }
}
