<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUnitRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_unitRecords', function (Blueprint $table) {
            //id
            $table->increments('ur_id');

            //unit
            $table->integer('ur_unit')
                ->unsigned()
                ->nullable();
            $table->foreign('ur_unit')
                ->references('u_id')->on('tbl_units');

            //type
            $table->integer('ur_type')
                ->unsigned();
            $table->foreign('ur_type')
                ->references('t_id')->on('ref_types');

            //status
            $table->integer('ur_status')
                ->unsigned();
            $table->foreign('ur_status')
                ->references('s_id')->on('ref_status');

            //matter
            $table->integer('ur_matter')->unsigned()->nullable();

            //timestamps
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
        Schema::drop('tbl_unitRecords');
    }
}
