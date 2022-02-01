<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGbjNoseri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gbj_noseri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('t_gbj_detail_id')->nullable();
            $table->foreign('t_gbj_detail_id')->references('id')->on('t_gbj_detail');
            $table->unsignedBigInteger('noseri_id')->nullable();
            $table->foreign('noseri_id')->references('id')->on('noseri_barang_jadi');
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->foreign('layout_id')->references('id')->on('m_layout');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('m_status');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('m_state');
            $table->enum('jenis', ['keluar','masuk'])->nullable();
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
        Schema::dropIfExists('t_gbj_noseri');
    }
}
