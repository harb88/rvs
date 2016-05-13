<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_units', function (Blueprint $table) {
            //id
            $table->increments('u_id');

            //unit number
            $table->integer('u_number')
                ->unsigned()
                ->nullable();

            //village
            $table->integer('u_village')
                ->unsigned()
                ->nullable();
            $table->foreign('u_village')
                ->references('v_id')->on('tbl_villages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_units');
    }
}
