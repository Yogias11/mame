<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Akses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_akses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roles_id');
            $table->foreign('roles_id')->references('id')->on('divisi');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('s_menu');
            $table->unsignedBigInteger('submenu_id');
            $table->foreign('submenu_id')->references('id')->on('s_submenu');
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
        Schema::dropIfExists('s_akses');
    }
}
