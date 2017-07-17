<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_kontraks', function (Blueprint $table) {
            $table->increments('id_layanan_kontrak');
            //$table->primary('id_layanan_kontrak');
            $table->integer('id_detil')->unsigned();
            $table->integer('id_layanan')->unsigned();
            $table->timestamps();
        });
        Schema::table('layanan_kontraks',function(Blueprint $table){
            $table->foreign('id_detil')
                ->references('id_detil')
                ->on('detil_kontraks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_layanan')
                ->references('id_layanan')
                ->on('layanans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanan_kontraks');
    }
}
