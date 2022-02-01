<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OutgoingPesananPart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoing_pesanan_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('detail_pesanan_part_id')->nullable();
            $table->foreign('detail_pesanan_part_id')->references('id')->on('detail_pesanan_part');
            $table->unsignedBigInteger('detail_logistik_part_id')->nullable();
            $table->foreign('detail_logistik_part_id')->references('id')->on('detail_logistik_part');
            $table->date('tgl_uji')->nullable();
            $table->integer('jumlah_ok')->nullable();
            $table->integer('jumlah_nok')->nullable();
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
        Schema::dropIfExists('outgoing_pesanan_part');
    }
}
