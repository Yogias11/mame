<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TGk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_in')->nullable();
            $table->date('date_out')->nullable();
            $table->unsignedBigInteger('dari')->nullable();
            $table->foreign('dari')->references('id')->on('users');
            $table->unsignedBigInteger('ke')->nullable();
            $table->foreign('ke')->references('id')->on('users');
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('t_gk');
    }
}
