<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGkNoseri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gk_noseri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gk_detail_id');
            $table->foreign('gk_detail_id')->references('id')->on('t_gk_detail');
            $table->unsignedBigInteger('noseri_id')->nullable();
            $table->foreign('noseri_id')->references('id')->on('noseri_gk');
            $table->string('remark')->nullable();
            $table->string('tk_kerusakan')->nullable();
            $table->string('perbaikan')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('m_status');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('m_state');
            $table->enum('jenis', ['keluar','masuk'])->nullable();
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
        Schema::dropIfExists('t_gk_noseri');
    }
}
