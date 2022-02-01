<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ekatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekatalog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->unsignedBigInteger('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->unsignedBigInteger('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanan');
            $table->string('no_paket')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('instansi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('satuan')->nullable();
            $table->date('tgl_kontrak')->nullable();
            $table->date('tgl_buat')->nullable();
            $table->string('ket')->nullable();
            $table->string('status')->nullable();
            $table->string('log')->nullable();
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
        Schema::dropIfExists('ekatalog');
    }
}
