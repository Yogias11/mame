<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('so')->nullable();
            $table->string('no_po')->nullable();
            $table->string('tgl_po')->nullable();
            $table->string('no_do')->nullable();
            $table->string('tgl_do')->nullable();
            $table->string('ket')->nullable();
            $table->unsignedBigInteger('status_cek')->nullable();
            $table->foreign('status_cek')->references('id')->on('m_status');
            $table->unsignedBigInteger('log_id');
            $table->foreign('log_id')->references('id')->on('m_state');
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
        Schema::dropIfExists('pesanan');
    }
}
