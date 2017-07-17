<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnakPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anak_perusahaans', function (Blueprint $table) {
        $table->string('id_perusahaan',7);
        $table->primary('id_perusahaan');
        $table->string('nama_perusahaan',150);
        $table->string('tlp_perusahaan',20);
        $table->string('email_perusahaan',100);
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
        Schema::dropIfExists('anak_perusahaans');
    }
}
