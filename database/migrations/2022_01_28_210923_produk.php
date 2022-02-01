<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('m_produk');
            $table->unsignedBigInteger('kelompok_produk_id');
            $table->foreign('kelompok_produk_id')->references('id')->on('kelompok_produk');
            $table->string('kode')->nullable();
            $table->string('merk')->nullable();
            $table->string('nama')->nullable();
            $table->string('nama_coo')->nullable();
            $table->string('coo')->nullable();
            $table->string('no_akd')->nullable();
            $table->string('ket')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('produk');
    }
}
