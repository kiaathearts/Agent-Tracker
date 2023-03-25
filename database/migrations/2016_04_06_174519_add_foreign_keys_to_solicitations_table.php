<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSolicitationsTable extends Migration
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
           $table->foreign('agent_id')->references('id')->on('agents');
           $table->foreign('term_id')->references('id')->on('terms');
           $table->foreign('requirement_id')->references('id')->on('requirements');
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
            $table->dropForeign('solicitations_agent_id_foreign');
            $table->dropForeign('solicitations_term_id_foreign');
            $table->dropForeign('solicitations_requirement_id_foreign');
        });
    }
}
