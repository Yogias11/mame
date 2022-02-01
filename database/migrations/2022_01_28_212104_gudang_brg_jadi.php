<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GudangBrgJadi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gdg_barang_jadi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->integer('stok')->nullable()->default(0);
            $table->unsignedBigInteger('satuan_id');
            $table->foreign('satuan_id')->references('id')->on('m_satuan');
            $table->string('gambar')->nullable();
            $table->integer('dim_p')->nullable();
            $table->integer('dim_l')->nullable();
            $table->integer('dim_t')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('gdg_barang_jadi');
    }
}
