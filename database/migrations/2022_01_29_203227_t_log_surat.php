<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TLogSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_log_surat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanan');
            $table->unsignedBigInteger('transfer_by')->nullable();
            $table->foreign('transfer_by')->references('id')->on('users');
            $table->unsignedBigInteger('check_by')->nullable();
            $table->foreign('check_by')->references('id')->on('users');
            $table->unsignedBigInteger('terima_by')->nullable();
            $table->foreign('terima_by')->references('id')->on('users');
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
        Schema::dropIfExists('t_log_surat');
    }
}
