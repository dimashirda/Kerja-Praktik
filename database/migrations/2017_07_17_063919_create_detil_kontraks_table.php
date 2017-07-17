<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetilKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_kontraks', function (Blueprint $table) {
            $table->increments('id_detil');
            //$table->primary('id_detil');
            $table->string('id_am',10)->index();
            $table->string('nipnas',100)->index();
            $table->string('id_perusahaan',7)->index();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->float('slg',4,2);
            $table->string('nama_dokumen',250);
            $table->timestamps();
        });
        Schema::table('detil_kontraks',function($table){
            $table->foreign('id_am')
                ->references('id_am')
                ->on('account_managers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            $table->foreign('nipnas')
                ->references('nipnas')
                ->on('pelanggans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        

            $table->foreign('id_perusahaan')
                ->references('id_perusahaan')
                ->on('anak_perusahaans')
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
        Schema::dropIfExists('detil_kontraks');
    }
}
