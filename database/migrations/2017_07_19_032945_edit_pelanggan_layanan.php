<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPelangganLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detil_kontraks', function(Blueprint $table) {
            $table->dropForeign('detil_kontraks_nipnas_foreign');
        });

        Schema::table('pelanggans', function(Blueprint $table) {
            $table->string('nipnas', 10)->change();
        });

        Schema::table('detil_kontraks', function(Blueprint $table) {
            $table->string('nipnas', 10)->change();
        });
       
       Schema::table('detil_kontraks', function(Blueprint $table) {
            $table->foreign('nipnas')
                ->references('nipnas')
                ->on('pelanggans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
       });

        Schema::table('layanans', function(Blueprint $table) {
            $table->dropColumn('deskripsi');
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
