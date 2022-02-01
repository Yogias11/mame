<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGkHis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_gk_his', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('m_gk_id');
            $table->foreign('m_gk_id')->references('id')->on('m_gk');
            $table->unsignedBigInteger('gbj_id')->nullable();
            $table->foreign('gbj_id')->references('id')->on('gdg_barang_jadi');
            $table->unsignedBigInteger('sparepart_id')->nullable();
            $table->foreign('sparepart_id')->references('id')->on('m_gs');
            $table->integer('stok')->default(0);
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
        Schema::dropIfExists('m_gk_his');
    }
}
