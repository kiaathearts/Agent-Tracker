<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgenttypeForeignKeyToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('agents', function($table){
        	$table->integer('agenttype_id')->unsigned()->change();
        	$table->foreign('agenttype_id')->references('id')->on('agenttypes');
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
        Schema::table('agents', function($table){
        	$table->dropForeign('agents_agenttype_id_foreign');
        });
    }
}
