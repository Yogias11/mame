<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailLogistik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_logistik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('logistik_id')->nullable();
            $table->foreign('logistik_id')->references('id')->on('logistik');
            $table->unsignedBigInteger('detail_pesanan_produk_id')->nullable();
            $table->foreign('detail_pesanan_produk_id')->references('id')->on('detail_pesanan_produk');
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
        Schema::dropIfExists('detail_logistik');
    }
}
