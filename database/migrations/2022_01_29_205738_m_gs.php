<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MGs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_gs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sparepart_id');
            $table->foreign('sparepart_id')->references('id')->on('m_sparepart');
            $table->string('nama');
            $table->string('deskripsi')->nullable();
            $table->integer('stok')->default(0);
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->foreign('layout_id')->references('id')->on('m_layout');
            $table->string('gambar')->nullable();
            $table->integer('dim_p')->nullable();
            $table->integer('dim_l')->nullable();
            $table->integer('dim_t')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('m_gs');
    }
}
