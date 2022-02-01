<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoseriGk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noseri_gk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('m_gk_id');
            $table->foreign('m_gk_id')->references('id')->on('m_gk');
            $table->unsignedBigInteger('dari')->nullable();
            $table->foreign('dari')->references('id')->on('users');
            $table->unsignedBigInteger('ke')->nullable();
            $table->foreign('ke')->references('id')->on('users');
            $table->string('noseri')->unique('noseri_gk_unix');
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->foreign('layout_id')->references('id')->on('m_layout');
            $table->enum('jenis', ['MASUK', 'KELUAR']);
            $table->integer('is_ready')->nullable();
            $table->integer('used_by')->nullable();
            $table->integer('is_aktif')->nullable();
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
