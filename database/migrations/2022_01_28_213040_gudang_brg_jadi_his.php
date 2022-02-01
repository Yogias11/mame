<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GudangBrgJadiHis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gdg_barang_jadi_his', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gdg_brg_jadi_id');
            $table->foreign('gdg_brg_jadi_id')->references('id')->on('gdg_barang_jadi');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->integer('stok')->nullable()->default(0);
            $table->unsignedBigInteger('satuan_id');
            $table->foreign('satuan_id')->references('id')->on('m_satuan');
            $table->unsignedBigInteger('dari')->nullable();
            $table->foreign('dari')->references('id')->on('users');
            $table->unsignedBigInteger('ke')->nullable();
            $table->foreign('ke')->references('id')->on('users');
            $table->string('status')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->string('tujuan')->nullable();
            $table->enum('jenis', ['MASUK', 'KELUAR'])->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        //
    }
}
