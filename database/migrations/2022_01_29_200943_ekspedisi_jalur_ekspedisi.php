<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EkspedisiJalurEkspedisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekspedisi_jalur_ekspedisi', function (Blueprint $table) {
            $table->unsignedBigInteger('ekspedisi_id');
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisi');
            $table->unsignedBigInteger('jalur_ekspedisi_id');
            $table->foreign('jalur_ekspedisi_id')->references('id')->on('jalur_ekspedisi');
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
        Schema::dropIfExists('ekspedisi_jalur_ekspedisi');
    }
}
