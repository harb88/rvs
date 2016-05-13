<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateToTblVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_villages', function (Blueprint $table) {
            //add state column
            $table->integer('v_state')
                ->unsigned()
                ->nullable();

            $table->foreign('v_state')
                ->references('st_id')->on('ref_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_villages', function (Blueprint $table) {
            //
        });
    }
}
