<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logistik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ekspedisi_id')->nullable();
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisi');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('m_state');
            $table->string('nosurat')->nullable();
            $table->string('noresi')->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->string('nama_pengirim')->nullable();
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
        Schema::dropIfExists('logistik');
    }
}
