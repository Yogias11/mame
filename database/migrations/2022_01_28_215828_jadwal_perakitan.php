<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalPerakitan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_perakitan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_bppb')->nullable();
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('gdg_barang_jadi');
            $table->integer('jumlah');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('m_status');
            $table->unsignedBigInteger('state');
            $table->foreign('state')->references('id')->on('m_state');
            $table->integer('konfirmasi')->default(0);
            $table->string('warna')->nullable();
            $table->unsignedBigInteger('status_tf');
            $table->foreign('status_tf')->references('id')->on('m_state');
            $table->unsignedBigInteger('filled_by');
            $table->foreign('filled_by')->references('id')->on('users');
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
        Schema::dropIfExists('jadwal_perakitan');
    }
}
