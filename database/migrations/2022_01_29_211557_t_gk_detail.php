<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGkDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gk_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gk_id');
            $table->foreign('gk_id')->references('id')->on('t_gk');
            $table->unsignedBigInteger('gbj_id')->nullable();
            $table->foreign('gbj_id')->references('id')->on('gdg_barang_jadi');
            $table->unsignedBigInteger('sparepart_id')->nullable();
            $table->foreign('sparepart_id')->references('id')->on('m_gs');
            $table->integer('qty_spr')->nullable();
            $table->integer('qty_unit')->nullable();
            $table->integer('is_draft')->nullable();
            $table->integer('is_keluar')->nullable();
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
        Schema::dropIfExists('t_gk_detail');
    }
}
