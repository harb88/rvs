<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVillages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_villages', function (Blueprint $table) {
            //id
            $table->increments('v_id');
            
            //village name
            $table->string('v_name');
            
            //village address
            $table->string('v_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_villages');
    }
}
