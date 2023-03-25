<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitationIdToRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requirements', function($table){
            $table->integer('solicitation_id')->unsigned();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
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
        Schena::table('requirements', function($table){
            $table->dropForeign('requirements_solicitiation_id_foreign');
            $table->dropColumn(array('solicitation_id'));
        });
    }
}
