<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarSidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_sids', function (Blueprint $table) {
            $table->string('sid', 50);
            $table->primary('sid');
            $table->string('id_perusahaan', 7)->index();
            $table->string('nipnas', 50)->index();
            $table->string('alamat_sid', 150);
            $table->integer('id_imes')->unsigned();
            $table->timestamps();
        });
        

        Schema::table('daftar_sids', function($table){
            $table->foreign('id_perusahaan')
                ->references('id_perusahaan')
                ->on('anak_perusahaans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('nipnas')
                ->references('nipnas')
                ->on('pelanggans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_imes')
                ->references('id_imes')
                ->on('layanan_imes')
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
        Schema::dropIfExists('daftar_sids');
    }
}
