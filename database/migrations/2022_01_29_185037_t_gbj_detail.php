<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGbjDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gbj_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('t_gbj_id');
            $table->foreign('t_gbj_id')->references('id')->on('t_gbj');
            $table->unsignedBigInteger('detail_pesanan_produk_id');
            $table->foreign('detail_pesanan_produk_id')->references('id')->on('detail_pesanan_produk');
            $table->unsignedBigInteger('gdg_brg_jadi_id');
            $table->foreign('gdg_brg_jadi_id')->references('id')->on('gdg_barang_jadi');
            $table->integer('qty')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('m_status');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('m_state');
            $table->enum('jenis', ['keluar','masuk'])->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('t_gbj_detail');
    }
}
