<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailPesananProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('detail_pesanan_id');
            $table->foreign('detail_pesanan_id')->references('id')->on('detail_pesanan');
            $table->unsignedBigInteger('gudang_barang_jadi_id');
            $table->foreign('gudang_barang_jadi_id')->references('id')->on('gdg_barang_jadi');
            $table->unsignedBigInteger('status_cek')->nullable();
            $table->foreign('status_cek')->references('id')->on('m_status');
            $table->unsignedBigInteger('checked_by')->nullable();
            $table->foreign('checked_by')->references('id')->on('users');
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
        Schema::dropIfExists('detail_pesanan_produk');
    }
}
