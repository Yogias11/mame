<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoseriLogistik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noseri_logistik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('detail_logistik_id')->nullable();
            $table->foreign('detail_logistik_id')->references('id')->on('detail_logistik');
            $table->unsignedBigInteger('noseri_detail_pesanan_id')->nullable();
            $table->foreign('noseri_detail_pesanan_id')->references('id')->on('noseri_detail_pesanan');
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
        Schema::dropIfExists('noseri_logistik');
    }
}
