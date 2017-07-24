<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelanggans', function(Blueprint $table){
            $table->string('tlp_pelanggan')->nullable()->change();
            $table->string('email_pelanggan')->nullable()->change();
        });
        Schema::table('account_managers', function(Blueprint $table){
            $table->string('tlp_am')->nullable()->change();
            $table->string('email_am')->nullable()->change();
        });
        Schema::table('anak_perusahaans', function(Blueprint $table){
            $table->string('tlp_perusahaan')->nullable()->change();
            $table->string('email_perusahaan')->nullable()->change();
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
