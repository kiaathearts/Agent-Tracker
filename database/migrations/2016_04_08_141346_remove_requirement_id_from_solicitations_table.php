<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRequirementIdFromSolicitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('solicitations', function($table){
            $table->dropForeign('solicitations_requirement_id_foreign');
            $table->dropColumn(array('requirement_id'));
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
        Schema::table('solicitations', function($table){
            $table->integer('requirement_id')->unsigned();
            $table->foreign('requirement_id')->references('id')->on('requirements');
        });
    }
}
