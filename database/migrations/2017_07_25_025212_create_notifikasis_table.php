<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->increments('id_notifikasi');
            $table->integer('id_detil')->unsigned();
            $table->boolean('flag');
            $table->timestamps();
        });

        Schema::table('notifikasis', function (Blueprint $table) {
            $table->foreign('id_detil')
                ->references('id_detil')
                ->on('detil_kontraks')
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
        Schema::dropIfExists('notifikasis');
    }
}