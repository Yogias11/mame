<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KomentarJadwalPerakitan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar_jadwal_perakitan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal_permintaan')->nullable();
            $table->date('tanggal_hasil')->nullable();
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('m_status');
            $table->unsignedBigInteger('state');
            $table->foreign('state')->references('id')->on('m_state');
            $table->string('hasil')->nullable();
            $table->string('komentar')->nullable();
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
        Schema::dropIfExists('komentar_jadwal_perakitan');
    }
}
